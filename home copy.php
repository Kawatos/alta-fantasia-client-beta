<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: bemvindo.php");
    exit;
}
?>
<?php include('header.php'); ?>

<style>
    /* VARIÁVEIS E ESTILOS GERAIS */
    body,
    html {

        /* Evita scroll duplo na página inteira */
    }

    #appLayout {
        height: calc(100vh - 100px);
        /* Altura dinâmica descontando o header */
        background-color: #f0f2f5;
        /* Cor de fundo estilo WhatsApp Web */
    }

    /* SCROLLBAR CUSTOMIZADA (Opcional, deixa mais elegante) */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #adb5bd;
    }

    /* ESTILOS DA LISTA DE CAMPANHAS */
    .campanha-item {
        transition: background-color 0.2s;
        border-radius: 8px;
        margin-bottom: 4px;
        border: none !important;
    }

    .campanha-item:hover,
    .campanha-item.active {
        background-color: #e9ecef;
    }

    .avatar-campanha {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #6f42c1, #0d6efd);
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
    }

    /* ÁREA DO CHAT */
    #chatMensagens {
        background-color: #ffffff;
        /* Fundo branco e limpo */
    }

    #view-campanha {
        max-height: 100%;
        overflow: hidden;
    }


    .chat-bubble {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 6px 12px 4px 12px;
        margin-bottom: 8px;

        max-width: 85%;
        width: fit-content;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .chat-text {
        font-size: 0.9rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: pre-wrap;
        /* Mantém as quebras de linha do usuário */
        max-height: 250px;
        overflow-y: auto;
    }

    .chat-timestamp {
        font-size: 0.65rem;
        color: #999;
        margin-top: 2px;
        align-self: flex-end;
        /* Empurra a hora para o cantinho direito */
    }

    /* MOBILE VIEWS */
    .mobile-view {
        display: flex !important;
    }

    .btn-lixeira {
        background: none;
        border: none;
        color: #dc3545;
        font-size: 0.8rem;
        cursor: pointer;
        opacity: 0.3;
        transition: opacity 0.2s;
        padding: 0;
    }

    .btn-lixeira:hover {
        opacity: 1;
    }

    .ficha-hover:hover {
        background-color: #f8f9fa !important;
        border-color: #ced4da !important;
    }

    @media (max-width: 767.98px) {
        .mobile-view {
            display: none !important;
            width: 100%;
        }

        .mobile-view.active-view {
            display: flex !important;
        }
    }
</style>

<div class="container-fluid pt-2 d-flex flex-column h-100">



    <div class="row flex-grow-1 overflow-hidden bg-white rounded-3 shadow-sm mx-0" id="appLayout">

        <div id="view-sidebar" class="col-12 col-md-4 col-lg-3 border-end d-flex flex-column p-0 mobile-view active-view">

            <div class="p-2 border-bottom bg-light">
                <ul class="nav nav-pills nav-fill gap-1 p-1 bg-white rounded shadow-sm" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-1" id="pills-campanhas-tab" data-bs-toggle="pill" data-bs-target="#pills-campanhas" type="button" role="tab">Campanhas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-1" id="pills-amigos-tab" data-bs-toggle="pill" data-bs-target="#pills-amigos" type="button" role="tab">Amigos</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content flex-grow-1 overflow-auto" id="pills-tabContent">

                <div class="tab-pane fade show active  d-flex flex-column" id="pills-campanhas" role="tabpanel">
                    <div class="p-2 d-flex gap-2 border-bottom">
                        <button class="btn btn-sm btn-success w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modalCriar">+ Nova</button>
                        <button class="btn btn-sm btn-outline-primary w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modalEntrar">Entrar</button>
                    </div>
                    <div id="sidebarCampanhas" class="list-group list-group-flush flex-grow-1 overflow-auto p-2">
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-amigos" role="tabpanel">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted p-4 text-center">
                        <i class="fs-1 mb-2">👥</i>
                        <h6>Sua lista de amigos está vazia.</h6>
                        <small>Em breve você poderá adicionar e gerenciar seus amigos aqui.</small>
                    </div>
                </div>

            </div>
        </div>

        <div id="view-campanha" class="col-12 col-md-8 col-lg-9 p-0 bg-light d-flex flex-column mobile-view">

            <div id="empty-state" class="m-auto text-center text-muted d-none d-md-block">
                <div class="fs-1 mb-3">🎲</div>
                <h5>Selecione uma campanha</h5>
                <p>Escolha uma campanha na lista ao lado para começar a jogar.</p>
            </div>

            <div id="conteudoCampanha" class="d-flex flex-column h-100 d-none">
            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="modalCriar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Criar Campanha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formCriar">
                    <input type="text" name="nome" class="form-control mb-2" placeholder="Nome da campanha" required>
                    <textarea name="descricao" class="form-control mb-3" placeholder="Descrição (opcional)" rows="3"></textarea>
                    <button type="submit" class="btn btn-success w-100 fw-bold">Criar Campanha</button>
                </form>
                <div id="feedbackCriar" class="mt-3 text-center"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEntrar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Entrar em Campanha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEntrar">
                    <input type="text" name="codigo" class="form-control mb-3 text-center fs-5" placeholder="Digite o Código" required>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Entrar</button>
                </form>
                <div id="feedbackEntrar" class="mt-3 text-center"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddFicha">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-bold">Adicionar Personagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="listaMinhasFichas" class="mb-3"></div>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-primary w-100 fw-bold" id="confirmarAddFicha">Adicionar Selecionados</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCampanha" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-bold">Configurações da Campanha</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label class="text-muted small">Nome</label>
                <input type="text" id="editarNomeCampanha" class="form-control mb-2" placeholder="Nome">

                <label class="text-muted small">Descrição</label>
                <textarea id="editarDescricaoCampanha" class="form-control mb-3" placeholder="Descrição"></textarea>

                <div class="mb-4 bg-light p-2 rounded border">
                    <label class="fw-bold small text-primary mb-1">Código de Convite</label>
                    <div class="d-flex gap-2">
                        <input type="text" id="codigoCampanha" class="form-control text-center fw-bold" readonly>
                        <button class="btn btn-primary" id="copiarCodigo">Copiar</button>
                    </div>
                </div>

                <button class="btn btn-success w-100 mb-2 fw-bold" id="salvarCampanha">Salvar alterações</button>
                <button class="btn btn-outline-danger w-100 fw-bold" id="excluirCampanha">Excluir campanha</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        


















        
        // ==========================================
        // 1. VARIÁVEIS GLOBAIS E ESTADOS
        // ==========================================
        let campanhaAtual = null;
        let chatInterval = null;
        let ultimaQuantidadeMensagens = -1;
        let modoEdicao = false; // Declarada aqui para evitar vazamento de escopo
        const usuarioLogado = <?php echo $_SESSION['usuario_id']; ?>;

        // Inicialização
        carregarListaCampanhas();



















        
        // ==========================================
        // 2. EVENTOS (LISTENERS)
        // Agrupamos todos os cliques e submits aqui
        // ==========================================

        // -- Navegação e Views --
        $(document).on('click', '#btnVoltarLista', function() {
            alternarView('sidebar');
            if (chatInterval) clearInterval(chatInterval);
        });

        // -- Campanhas --
        $(document).on('click', '.campanha-item', function(e) {
            e.preventDefault();
            $('.campanha-item').removeClass('active bg-light');
            $(this).addClass('active bg-light');
            campanhaAtual = $(this).data('id');
            carregarCampanha(campanhaAtual);
        });

        $(document).on('click', '#btnConfigCampanha', function() {
            $('#editarNomeCampanha').val(window.campanhaData.nome);
            $('#editarDescricaoCampanha').val(window.campanhaData.descricao);
            $('#codigoCampanha').val(window.campanhaData.codigo_convite);
            new bootstrap.Modal(document.getElementById('modalCampanha')).show();
        });

        $(document).on('click', '#salvarCampanha', function() {
            $.post('backend/editar_campanha.php', {
                campanha_id: campanhaAtual,
                nome: $('#editarNomeCampanha').val(),
                descricao: $('#editarDescricaoCampanha').val()
            }, function(res) {
                if (res.status === 'sucesso') {
                    $('#modalCampanha').modal('hide');
                    carregarListaCampanhas();
                    carregarCampanha(campanhaAtual);
                }
            }, 'json');
        });

        $(document).on('click', '#excluirCampanha', function() {
            if (!confirm('Tem certeza que deseja excluir a campanha?')) return;
            $.post('backend/excluir_campanha.php', {
                campanha_id: campanhaAtual
            }, function(res) {
                if (res.status === 'sucesso') {
                    $('#modalCampanha').modal('hide');
                    sairDaCampanhaVisulmente();
                    carregarListaCampanhas();
                }
            }, 'json');
        });

        $(document).on('click', '#btnSairCampanha', function() {
            if (!confirm('Tem certeza que deseja sair desta campanha? Suas fichas continuarão vinculadas a você, mas não aparecerão mais aqui.')) return;
            $.post('backend/sair_campanha.php', {
                campanha_id: campanhaAtual
            }, function(res) {
                if (res.status === 'sucesso') {
                    sairDaCampanhaVisulmente();
                    carregarListaCampanhas();
                    alert('Você saiu da campanha.');
                } else {
                    alert(res.mensagem || 'Erro ao sair da campanha.');
                }
            }, 'json');
        });

        $(document).on('click', '#copiarCodigo', function() {
            navigator.clipboard.writeText($('#codigoCampanha').val());
            $(this).text('Copiado!').removeClass('btn-primary').addClass('btn-success');
            setTimeout(() => $(this).text('Copiar').removeClass('btn-success').addClass('btn-primary'), 2000);
        });

        // -- Fichas e Jogadores --
        $(document).on('click', '.editar-ficha', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const fichaId = $(this).data('id');
            console.log("1. Botão clicado! ID da ficha:", fichaId);
            try {
                modoEdicao = true;
                console.log("2. Variável modoEdicao setada para true.");
                getDadosFicha(this.dataset.id, this.dataset.tipo);
                console.log("3. Função getDadosFicha chamada com sucesso!");
            } catch (erro) {
                console.error("Deu ruim na hora de chamar a função:", erro);
            }
        });

        $(document).on('click', '.jogador-item', function(e) {
            if ($(e.target).closest('button').length) return; // Ignorar clique nos botões
            const userId = $(this).data('id');
            const container = $('#fichas-user-' + userId);

            if (container.is(':visible')) {
                container.slideUp();
                return;
            }
            container.html('<div class="text-center small text-muted">Carregando...</div>').slideDown();
            carregarFichasUsuario(userId, container);
        });

        $(document).on('click', '.btn-criar-ficha-campanha', criarFichaCampanhaFluxo);

        $(document).on('click', '.remover-ficha', function(e) {
            e.stopPropagation();
            const fichaId = $(this).data('id');
            const container = $(this).closest('.fichas-usuario');
            const userId = container.attr('id').replace('fichas-user-', '');

            if (!confirm('Remover esta ficha da campanha?')) return;
            $.post('backend/remover_ficha_campanha.php', {
                ficha_id: fichaId,
                campanha_id: campanhaAtual
            }, function(res) {
                if (res.status === 'sucesso') carregarFichasUsuario(userId, container);
            }, 'json');
        });

        $(document).on('click', '.remover-jogador', function() {
            if (!confirm('Remover este jogador da campanha?')) return;
            $.post('backend/remover_jogador_campanha.php', {
                usuario_id: $(this).data('id'),
                campanha_id: campanhaAtual
            }, function(res) {
                if (res.status === 'sucesso') carregarCampanha(campanhaAtual);
            }, 'json');
        });

        $(document).on('click', '.btn-add-ficha', abrirModalAdicionarFicha);

        $('#confirmarAddFicha').click(confirmarAdicaoFicha);

        // -- Chat --
        $(document).on('submit', '#formChat', function(e) {
            e.preventDefault();
            const msg = $('#chatInput').val();
            if (!msg.trim()) return;

            $.post('backend/enviar_mensagem.php', {
                mensagem: msg,
                campanha_id: campanhaAtual
            }, function() {
                ultimaQuantidadeMensagens = -1; // Força atualização no próximo tick
            });
            $('#chatInput').val('');
        });

        $(document).on('click', '.btn-lixeira', function() {
            const mensagemId = $(this).data('id');
            if (!confirm('Deseja realmente excluir esta mensagem?')) return;

            $.post('backend/excluir_mensagem.php', {
                mensagem_id: mensagemId,
                campanha_id: campanhaAtual
            }, function(res) {
                if (res.status === 'sucesso') {
                    ultimaQuantidadeMensagens = -1;
                } else {
                    alert(res.mensagem || 'Erro ao excluir mensagem.');
                }
            }, 'json');
        });

        // -- Modais de Criação/Entrada --
        $('#formCriar').on('submit', function(e) {
            e.preventDefault();
            $('#feedbackCriar').html('<div class="text-muted">Criando...</div>');
            $.post('backend/criar_campanha.php', $(this).serialize(), function(res) {
                if (res.status === 'sucesso') {
                    $('#feedbackCriar').html(`<div class="alert alert-success p-2">Criada com sucesso!<br>Código: <b>${res.codigo}</b></div>`);
                    $('#formCriar')[0].reset();
                    carregarListaCampanhas();
                    setTimeout(() => $('#modalCriar').modal('hide'), 2000);
                } else {
                    $('#feedbackCriar').html('<div class="text-danger">' + res.mensagem + '</div>');
                }
            }, 'json');
        });

        $('#formEntrar').on('submit', function(e) {
            e.preventDefault();
            $('#feedbackEntrar').html('<div class="text-muted">Entrando...</div>');
            $.post('backend/entrar_campanha.php', $(this).serialize(), function(res) {
                if (res.status === 'sucesso') {
                    $('#feedbackEntrar').html('<div class="alert alert-success p-2">Entrou na campanha!</div>');
                    $('#formEntrar')[0].reset();
                    carregarListaCampanhas();
                    setTimeout(() => $('#modalEntrar').modal('hide'), 1500);
                } else {
                    $('#feedbackEntrar').html('<div class="text-danger">' + res.mensagem + '</div>');
                }
            }, 'json');
        });




















        
        // ==========================================
        // 3. FUNÇÕES LÓGICAS E DE API
        // ==========================================

        function alternarView(view) {
            if (window.innerWidth >= 768) return;
            $('.mobile-view').removeClass('active-view');
            if (view === 'sidebar') $('#view-sidebar').addClass('active-view');
            else if (view === 'campanha') $('#view-campanha').addClass('active-view');
        }

        function sairDaCampanhaVisulmente() {
            campanhaAtual = null;
            if (chatInterval) clearInterval(chatInterval);
            $('#conteudoCampanha').addClass('d-none').html('');
            $('#empty-state').removeClass('d-none');
            alternarView('sidebar');
        }

        function carregarListaCampanhas() {
            $('#sidebarCampanhas').html('<div class="text-center p-3 text-muted">Carregando...</div>');
            $.get('backend/listar_campanhas.php', function(res) {
                if (res.status !== 'sucesso') return $('#sidebarCampanhas').html('<div class="text-danger p-3">Erro ao carregar campanhas</div>');
                if (res.campanhas.length === 0) return $('#sidebarCampanhas').html('<div class="text-muted text-center p-4">Você não participa de nenhuma campanha.</div>');

                let html = res.campanhas.map(c => templateSidebarCampanha(c)).join('');
                $('#sidebarCampanhas').html(html);
            }, 'json').fail(function() {
                $('#sidebarCampanhas').html('<div class="text-danger p-3">Erro de conexão 4</div>');
            });
        }

        function carregarCampanha(campanhaId) {
            if (!campanhaId) return;

            $('#empty-state').removeClass('d-md-block').addClass('d-none');
            $('#conteudoCampanha').removeClass('d-none').addClass('flex-grow-1').html(templateEsqueletoCampanha());
            alternarView('campanha');

            $.get('backend/buscar_campanha_detalhes.php', {
                campanha_id: campanhaId
            }, function(res) {
                if (res.status !== 'sucesso') return;
                window.campanhaData = res.campanha;

                $('#headerNome').text(res.campanha.nome);
                $('#headerAvatar').text(res.campanha.nome.charAt(0).toUpperCase());

                // Botões de ação do cabeçalho
                if (res.papel === 'mestre') {
                    $('#headerActions').html(`<button class="btn btn-light" id="btnConfigCampanha" title="Configurações">⚙️</button>`);
                } else {
                    $('#headerActions').html(`<button class="btn btn-outline-danger btn-sm fw-bold px-3" id="btnSairCampanha">Sair</button>`);
                }

                // Jogadores
                let htmlJogadores = res.jogadores.map(j => templateJogador(j, res.papel)).join('');
                $('#listaJogadores').html(htmlJogadores);

                carregarChat(campanhaId);
            }, 'json');
        }

        function carregarChat(campanhaId) {
            if (!campanhaId) return;
            if (chatInterval) clearInterval(chatInterval);
            ultimaQuantidadeMensagens = -1;

            chatInterval = setInterval(() => {
                $.get('backend/listar_mensagens.php', {
                    campanha_id: campanhaId
                }, function(res) {
                    if (res.status !== 'sucesso' || res.mensagens.length === ultimaQuantidadeMensagens) return;

                    ultimaQuantidadeMensagens = res.mensagens.length;

                    let html = res.mensagens.map(m => templateMensagem(m, res.usuario_logado, res.papel)).join('');
                    let chatBox = $('#chatMensagens');
                    let isScrolledToBottom = chatBox[0].scrollHeight - chatBox[0].clientHeight <= chatBox[0].scrollTop + 50;

                    chatBox.html(html);
                    if (isScrolledToBottom) chatBox.scrollTop(chatBox[0].scrollHeight);
                }, 'json');
            }, 1000);
        }

        function carregarFichasUsuario(userId, container) {
            $.get('backend/buscar_fichas_usuario.php', {
                usuario_id: userId,
                campanha_id: campanhaAtual
            }, function(res) {
                if (res.status !== 'sucesso') return;
                if (!res.fichas || res.fichas.length === 0) {
                    container.html(`<div class="text-muted small text-center mt-2">Nenhum personagem.</div>`);
                    return;
                }
                let html = res.fichas.map(f => templateFichaUsuario(f, res.usuario_logado, res.papel)).join('');
                container.html(html);
            }, 'json');
        }

        function formatarDataChat(dataString) {
            if (!dataString) return '';
            const dataMsg = new Date(dataString.replace(/-/g, '/'));
            const dataHoje = new Date();
            const hr = String(dataMsg.getHours()).padStart(2, '0');
            const min = String(dataMsg.getMinutes()).padStart(2, '0');

            if (dataMsg.toDateString() === dataHoje.toDateString()) return `${hr}:${min}`;

            const dia = String(dataMsg.getDate()).padStart(2, '0');
            const mes = String(dataMsg.getMonth() + 1).padStart(2, '0');
            return `${dia}/${mes} ${hr}:${min}`;
        }

        // -- Fluxos Complexos Isolados --
        function criarFichaCampanhaFluxo(e) {
            e.preventDefault();
            e.stopPropagation();
            if (typeof Swal === 'undefined') return alert("Erro: SweetAlert2 não está carregado.");

            Swal.fire({
                title: 'Escolha o formato da ficha',
                input: 'select',
                inputOptions: {
                    'bloco': 'Bloco de Notas',
                    'arquivo': 'PDF',
                    'padrao': 'Padrão Alta'
                },
                inputPlaceholder: 'Selecione uma opção',
                showCancelButton: true,
                confirmButtonText: 'Avançar',
                cancelButtonText: 'Cancelar',
                inputValidator: (value) => {
                    if (!value) return 'Você precisa escolher um formato!';
                }
            }).then((formatoResult) => {
                if (!formatoResult.isConfirmed) return;

                Swal.fire({
                    title: 'Nome do personagem',
                    input: 'text',
                    inputPlaceholder: 'Ex: Arthanor',
                    showCancelButton: true,
                    confirmButtonText: 'Criar Ficha',
                    inputValidator: (value) => {
                        if (!value) return 'Você precisa digitar um nome!';
                    }
                }).then((nomeResult) => {
                    if (!nomeResult.isConfirmed) return;

                    fetch('backend/criar_ficha.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                nome_personagem: nomeResult.value,
                                tipo_ficha: formatoResult.value
                            })
                        })
                        .then(resp => resp.json())
                        .then(data => {
                            if (data.status === 'sucesso') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Ficha criada!',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => carregarFichas());
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.mensagem,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                });
            });
        }

        function abrirModalAdicionarFicha() {
            fichasSelecionadas = [];
            $('#modalAddFicha').modal('show');
            $('#listaMinhasFichas').html('<div class="text-center">Carregando seus personagens...</div>');

            $.get('backend/buscar_fichas.php', {
                campanha_id: campanhaAtual
            }, function(fichas) {
                const dadosFichas = typeof fichas === 'string' ? JSON.parse(fichas) : fichas;
                let html = '<div class="list-group">' + dadosFichas.map(f => `
                    <label class="list-group-item d-flex gap-2 align-items-center">
                        <input class="form-check-input flex-shrink-0 check-ficha" type="checkbox" value="${f.id}" ${f.na_campanha ? 'checked disabled' : ''}>
                        <span>${f.nome_personagem} ${f.na_campanha ? '<small class="text-success d-block" style="font-size:0.8rem;">(Já na campanha)</small>' : ''}</span>
                    </label>
                `).join('') + '</div>';
                $('#listaMinhasFichas').html(html);
            });
        }

        function confirmarAdicaoFicha() {
            const ids = $('.check-ficha:checked:not(:disabled)').map(function() {
                return $(this).val();
            }).get();
            if (ids.length === 0) return $('#modalAddFicha').modal('hide');

            $.post('backend/adicionar_fichas_campanha.php', {
                campanha_id: campanhaAtual,
                fichas: ids
            }, function(res) {
                if (res.status === 'sucesso') {
                    $('#modalAddFicha').modal('hide');
                    const container = $('#fichas-user-' + usuarioLogado);
                    container.slideDown();
                    carregarFichasUsuario(usuarioLogado, container);
                }
            }, 'json');
        }




















        // ==========================================
        // 4. TEMPLATES HTML (RETORNAM STRINGS)
        // ==========================================

        function templateSidebarCampanha(c) {
            let inicial = c.nome.charAt(0).toUpperCase();
            return `
                <a href="#" class="campanha-item text-decoration-none text-dark p-2 d-flex align-items-center" data-id="${c.id}">
                    <div class="avatar-campanha rounded-circle d-flex justify-content-center align-items-center me-3 flex-shrink-0">${inicial}</div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h6 class="mb-0 text-truncate fw-bold">${c.nome}</h6>
                        <small class="text-muted text-truncate d-block">${c.descricao ? c.descricao : 'Sem descrição'}</small>
                    </div>
                </a>
            `;
        }

        function templateEsqueletoCampanha() {
            return `
                <div class="bg-white border-bottom p-2 d-flex align-items-center justify-content-between shadow-sm z-1 flex-shrink-0">
                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                        <button class="btn btn-light d-md-none px-2" id="btnVoltarLista"><span class="fs-5">←</span></button>
                        <div class="avatar-campanha rounded-circle d-flex justify-content-center align-items-center" style="width:40px; height:40px; font-size:1rem;" id="headerAvatar"></div>
                        <div class="overflow-hidden"><h5 class="mb-0 fw-bold text-truncate" id="headerNome">Carregando...</h5></div>
                    </div>
                    <div id="headerActions"></div>
                </div>
                <ul class="nav nav-tabs bg-white px-3 pt-2 flex-shrink-0" id="campanhaTabs" role="tablist">
                    <li class="nav-item" role="presentation"><button class="nav-link active fw-bold text-dark" id="tab-chat" data-bs-toggle="tab" data-bs-target="#pane-chat" type="button" role="tab">💬 Chat</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link fw-bold text-dark" id="tab-jogadores" data-bs-toggle="tab" data-bs-target="#pane-jogadores" type="button" role="tab">⚔️ Jogadores</button></li>
                </ul>
                <div class="tab-content flex-grow-1 bg-white" id="campanhaTabsContent" style="min-height: 0; overflow: hidden;">
                    <div class="tab-pane fade show active h-100" id="pane-chat" role="tabpanel">
                        <div class="d-flex flex-column h-100 w-100">
                            <div id="chatMensagens" class="flex-grow-1 p-3 d-flex flex-column" style="overflow-y: auto; min-height: 0;"></div>
                            <div class="p-2 bg-light border-top flex-shrink-0">
                                <form id="formChat" class="d-flex gap-2 mb-0">
                                    <input type="text" id="chatInput" class="form-control rounded-pill" placeholder="Digite uma mensagem..." autocomplete="off">
                                    <button type="submit" class="btn btn-primary px-3 fw-bold">➤</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade h-100 overflow-auto p-3 bg-light" id="pane-jogadores" role="tabpanel">
                        <div id="listaJogadores" class="row g-2"></div>
                    </div>
                </div>
            `;
        }

        function templateJogador(j, papelCampanha) {
            let badge = j.papel === 'mestre' ? '<span class="badge bg-success">Mestre</span>' : '<span class="badge bg-secondary">Jogador</span>';
            let botoesAcao = '';

            if (j.id == usuarioLogado) {
                botoesAcao += `
                    <button class="btn btn-sm btn-outline-success btn-add-ficha py-0 px-2" data-user="${j.id}" title="Adicionar da sua lista" style="font-size:0.9rem;">+ Adicionar</button>
                    <button class="btn btn-sm btn-primary btn-criar-ficha-campanha py-0 px-2" style="font-size:0.9rem;">Criar</button>
                `;
            }
            if (papelCampanha === 'mestre' && j.id != usuarioLogado && j.papel != 'mestre') {
                botoesAcao += `<button class="btn btn-sm btn-outline-danger py-0 px-2 remover-jogador" data-id="${j.id}" title="Remover Jogador">✖</button>`;
            }

            return `
                <div class="col-12 col-md-6">
                    <div class="card border-0 shadow-sm jogador-item" data-id="${j.id}" style="cursor: pointer;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div><h6 class="mb-0 fw-bold">${j.username}</h6>${badge}</div>
                                <div class="d-flex gap-1 flex-wrap justify-content-end">${botoesAcao}</div>
                            </div>
                            <div class="fichas-usuario mt-2 pt-2 border-top" id="fichas-user-${j.id}" style="display:none;"></div>
                        </div>
                    </div>
                </div>
            `;
        }

        function templateFichaUsuario(f, idLogado, papelCampanha) {
            const donoFicha = f.usuario_id;
            const podeEditar = (idLogado == donoFicha || papelCampanha === 'mestre');
            const imagem = f.personagem_imagem ? f.personagem_imagem : 'uploads/perfil-vazio.png';
            const imagemEstilo = f.personagem_imagem ? '' : 'opacity:0.5;';
            const tipoFicha = f.tipo_ficha || 'padrao';

            let badgeEstilo = tipoFicha === 'bloco' ? 'bg-warning' : (tipoFicha === 'arquivo' ? 'bg-info' : 'bg-primary');
            let badgeTexto = tipoFicha === 'bloco' ? 'Bloco de Notas' : (tipoFicha === 'arquivo' ? 'PDF' : 'Padrão Alta');

            const classeEditavel = podeEditar ? 'editar-ficha ficha-hover' : '';
            const cursorStyle = podeEditar ? 'cursor: pointer;' : '';

            return `
                <div class="d-flex align-items-center gap-2 mb-2 bg-white p-2 rounded border ${classeEditavel}" data-id="${f.id}" data-tipo="${tipoFicha}" style="${cursorStyle} transition: background-color 0.2s;">
                    <img src="${imagem}" style="width:36px;height:36px;object-fit:cover;border-radius:6px;${imagemEstilo}">
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="mb-1"><span class="badge ${badgeEstilo}" style="font-size: 0.65rem;">${badgeTexto}</span></div>
                        <div class="fw-bold small text-truncate">${f.nome_personagem || 'Sem nome'}</div>
                        <div class="d-flex gap-1 mt-1">
                            ${podeEditar ? `<button class="btn btn-light btn-sm py-0" style="font-size:0.8rem; pointer-events: none;">Editar</button>` : ''}
                            ${podeEditar ? `<button class="btn btn-outline-danger btn-sm py-0 remover-ficha" data-id="${f.id}" style="font-size:0.8rem;">Remover</button>` : ''}
                        </div>
                    </div>
                </div>
            `;
        }

        function templateMensagem(m, idLogado, papelCampanha) {
            const dataFormatada = formatarDataChat(m.data_envio);
            const podeExcluir = (idLogado == m.usuario_id || papelCampanha === 'mestre');
            const btnExcluir = podeExcluir ? `<button class="btn-lixeira ms-2" data-id="${m.id}" title="Excluir mensagem">🗑️</button>` : '';

            return `
                <div class="w-100 d-flex flex-column align-items-start">
                    <div class="chat-bubble d-flex flex-column" style="min-width: 120px;">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <small class="fw-bold text-primary flex-shrink-0" style="font-size: 0.75rem; white-space: nowrap;">${m.username}</small>
                            ${btnExcluir}
                        </div>
                        <div class="chat-text">${m.mensagem}</div>
                        <span class="chat-timestamp flex-shrink-0">${dataFormatada}</span>
                    </div>
                </div>
            `;
        }
    });
</script>

<?php include('footer.php'); ?>