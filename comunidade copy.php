<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: bemvindo.php");
    exit;
}
?>
<?php include('header.php'); ?>



<div class="container-fluid mt-2">

    <!-- HEADER -->
    <div class="text-center mb-2">
        <h1 class="display-6 fw-bold">
            <span class="font-alta">Alta</span>
            <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia</span>
        </h1>

        <h6 class="text-muted">
            Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </h6>
    </div>

    <!-- NAV MOBILE -->
    <div class="d-flex gap-2">
        <button class="btn btn-sm btn-light btn-nav" data-view="campanhas">Campanhas</button>
        <button class="btn btn-sm btn-light btn-nav" data-view="amigos">Amigos</button>
    </div>

    <!-- APP -->
    <div class="row" id="appLayout" style="height: 85vh;">

        <!-- CAMPANHAS -->
        <div id="view-campanhas" class="col-12 col-md-3 border-end d-flex flex-column view active">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Campanhas</h5>

                <div class="d-flex gap-1">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCriar">+</button>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEntrar">↪</button>
                </div>
            </div>

            <div id="sidebarCampanhas" style="overflow-y:auto;"></div>
        </div>

        <!-- CHAT / CAMPANHA -->
        <div id="view-chat" class="col-12 col-md-6 d-flex flex-column view">

            <div id="conteudoCampanha" class="d-flex flex-column h-100"></div>

        </div>

        <!-- FICHAS -->
        <div id="view-fichas" class="col-12 col-md-3 border-start d-flex flex-column view">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Personagens</h5>

                <button id="botaoCriarFicha" class="btn btn-sm btn-primary">+</button>
            </div>

            <div id="lista-fichas" style="overflow-y:auto;"></div>
        </div>

    </div>

</div>

<script>

</script>

<!-- MODAL CRIAR -->
<div class="modal fade" id="modalCriar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Criar Campanha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formCriar">
                    <input type="text" name="nome" class="form-control mb-2" placeholder="Nome da campanha" required>

                    <textarea name="descricao" class="form-control mb-3" placeholder="Descrição (opcional)"></textarea>

                    <button type="submit" class="btn btn-success w-100">
                        Criar
                    </button>
                </form>

                <div id="feedbackCriar" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ENTRAR -->
<div class="modal fade" id="modalEntrar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Entrar em Campanha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formEntrar">
                    <input type="text" name="codigo" class="form-control mb-3" placeholder="Código da campanha" required>

                    <button type="submit" class="btn btn-primary w-100">
                        Entrar
                    </button>
                </form>

                <div id="feedbackEntrar" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddFicha">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Adicionar Fichas</h5>
            </div>

            <div class="modal-body">
                <div id="listaMinhasFichas"></div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="confirmarAddFicha">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCampanha" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Configurar Campanha</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="text" id="editarNomeCampanha" class="form-control mb-2" placeholder="Nome">

                <textarea id="editarDescricaoCampanha" class="form-control mb-3" placeholder="Descrição"></textarea>

                <div class="mb-3">
                    <label><b>Código da campanha</b></label>
                    <div class="d-flex gap-2">
                        <input type="text" id="codigoCampanha" class="form-control" readonly>
                        <button class="btn btn-outline-primary" id="copiarCodigo">Copiar</button>
                    </div>
                </div>

                <button class="btn btn-success w-100 mb-2" id="salvarCampanha">
                    Salvar
                </button>

                <button class="btn btn-danger w-100" id="excluirCampanha">
                    Excluir campanha
                </button>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var campanhaAtual = null;
        const usuarioLogado = <?php echo $_SESSION['usuario_id']; ?>;



        function carregarListaCampanhas() {

            $('#sidebarCampanhas').html('<div class="text-center">Carregando...</div>');

            $.ajax({
                url: 'backend/listar_campanhas.php',
                method: 'GET',
                dataType: 'json',
                success: function(res) {

                    if (res.status !== 'sucesso') {
                        $('#sidebarCampanhas').html('<div class="text-danger">Erro ao carregar campanhas</div>');
                        return;
                    }

                    if (res.campanhas.length === 0) {
                        $('#sidebarCampanhas').html('<div class="text-muted">Você não participa de nenhuma campanha.</div>');
                        return;
                    }

                    let html = '';

                    res.campanhas.forEach(c => {
                        html += `
                            <div class="campanha-item p-2 border-bottom d-flex justify-content-between align-items-center"
                                data-id="${c.id}"
                                style="cursor:pointer;">

                                <div>
                                    <strong>${c.nome}</strong><br>
                                    <small class="text-muted">${c.descricao ?? ''}</small>
                                </div>

                                <button class="btn btn-sm btn-outline-primary btn-abrir" data-id="${c.id}">
                                    Abrir
                                </button>

                            </div>
                        `;
                    });

                    $('#sidebarCampanhas').html(html);
                },
                error: function() {
                    $('#sidebarCampanhas').html('<div class="text-danger">Erro de conexão</div>');
                }
            });
        }

        carregarListaCampanhas();



        $('#formCriar').on('submit', function(e) {
            e.preventDefault();

            const feedback = $('#feedbackCriar');
            feedback.html('<div class="text-muted">Criando...</div>');

            $.ajax({
                url: 'backend/criar_campanha.php',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',

                success: function(res) {

                    if (res.status === 'sucesso') {

                        feedback.html(`
                        <div class="text-success">
                            Campanha criada!<br>
                            Código: <b>${res.codigo}</b>
                        </div>
                    `);

                        $('#formCriar')[0].reset();
                        carregarListaCampanhas();

                    } else {
                        feedback.html('<div class="text-danger">' + res.mensagem + '</div>');
                    }
                },

                error: function() {
                    feedback.html('<div class="text-danger">Erro na conexão</div>');
                }
            });
        });



        $('#formEntrar').on('submit', function(e) {
            e.preventDefault();

            const feedback = $('#feedbackEntrar');
            feedback.html('<div class="text-muted">Entrando...</div>');

            $.ajax({
                url: 'backend/entrar_campanha.php',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',

                success: function(res) {

                    if (res.status === 'sucesso') {

                        feedback.html('<div class="text-success">Entrou na campanha!</div>');

                        $('#formEntrar')[0].reset();
                        carregarListaCampanhas();

                    } else {
                        feedback.html('<div class="text-danger">' + res.mensagem + '</div>');
                    }
                },

                error: function() {
                    feedback.html('<div class="text-danger">Erro na conexão</div>');
                }
            });
        });



        $(document).on('click', '.btn-abrir', function() {
            campanhaId = $(this).data('id');
            campanhaAtual = campanhaId;

            carregarCampanha(campanhaId);
        });
        $(document).on('click', '.campanha-item', function() {
            campanhaId = $(this).data('id');
            campanhaAtual = campanhaId;
            $('.campanha-item').removeClass('active');
            $(this).addClass('active');

            carregarCampanha(campanhaId);
        });

        function carregarCampanha(campanhaId) {

            campanhaAtual = campanhaId;
            if (window.innerWidth < 768) {
                abrirView('chat');
            }

            /* estrutura base completa */
            $('#conteudoCampanha').html(`
                <div class="d-flex flex-column h-100">

                    <div id="campanhaHeader" class="border-bottom pb-2 mb-2"></div>

                    <div class="row flex-grow-1">

                        <div class="col-md-5 border-end" id="listaJogadores"></div>

                        <div class="col-md-7 d-flex flex-column">

                            <div id="chatMensagens" class="flex-grow-1 mb-2"></div>

                            <form id="formChat" class="d-flex gap-2">
                                <input type="text" id="chatInput" class="form-control" placeholder="Mensagem...">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>

                        </div>

                    </div>

                </div>
            `);

            /* request */
            $.get('backend/buscar_campanha_detalhes.php', {
                campanha_id: campanhaId
            }, function(res) {

                if (res.status !== 'sucesso') return;

                window.campanhaData = res.campanha;

                /* HEADER */
                $('#campanhaHeader').html(`
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center gap-2">

                            <button class="btn btn-sm btn-light d-md-none" id="btnVoltar">
                                ←
                            </button>

                            <div>
                                <h5 class="mb-0">${res.campanha.nome}</h5>
                                <small class="text-muted">${res.campanha.descricao ?? ''}</small>
                            </div>

                        </div>

                        ${res.papel === 'mestre' ? `
                            <button class="btn btn-sm btn-outline-secondary" id="btnConfigCampanha">
                                ⚙
                            </button>
                        ` : ''}

                    </div>
                `);

                /* JOGADORES */
                let htmlJogadores = '';

                res.jogadores.forEach(j => {
                    htmlJogadores += `
                        <div class="p-2 border-bottom jogador-item" data-id="${j.id}">

                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>${j.username}</strong>
                                    <span class="badge bg-${j.papel === 'mestre' ? 'success' : 'secondary'}">
                                        ${j.papel}
                                    </span>
                                </div>

                                ${j.id == usuarioLogado ? `
                                    <button class="btn btn-sm btn-success btn-add-ficha" data-user="${j.id}">
                                        +
                                    </button>
                                ` : ''}
                                ${res.papel === 'mestre' && j.id != usuarioLogado && j.papel != 'mestre' ? `
                                    <button class="btn btn-sm btn-danger remover-jogador" data-id="${j.id}">
                                        ✖
                                    </button>
                                ` : ''}
                            </div>

                            <div class="fichas-usuario mt-2" id="fichas-user-${j.id}" style="display:none;"></div>
                        </div>
                    `;
                });

                $('#listaJogadores').html(htmlJogadores);

                carregarChat(campanhaId);

            }, 'json');
        }

        $(document).on('click', '.campanha-item', function() {

            $('.campanha-item').removeClass('active');
            $(this).addClass('active');

        });

        function carregarFichasUsuario(userId, container) {
            $.get('backend/buscar_fichas_usuario.php', {
                usuario_id: userId,
                campanha_id: campanhaAtual
            }, function(res) {

                if (res.status !== 'sucesso') return;

                const papelUsuario = res.papel;
                const usuarioLogado = res.usuario_logado;

                // ✅ Caso não tenha fichas
                if (!res.fichas || res.fichas.length === 0) {
                    container.html(`
                <div class="text-muted small text-center mt-2">
                    Nenhuma ficha adicionada à campanha.
                </div>
            `);
                    return;
                }

                let html = '';

                res.fichas.forEach(f => {

                    const donoFicha = f.usuario_id;

                    const podeEditar = (
                        usuarioLogado == donoFicha ||
                        papelUsuario === 'mestre'
                    );

                    const podeRemover = podeEditar;

                    console.log('Ficha:', f);

                    // ✅ imagem com fallback
                    const imagem = f.personagem_imagem ?
                        f.personagem_imagem :
                        'uploads/perfil-vazio.png';

                    const imagemEstilo = f.personagem_imagem ?
                        '' :
                        'opacity:0.5;';

                    html += `
                <div class="card p-2 mb-2 d-flex flex-row align-items-center gap-2">

                    <!-- MINIATURA -->
                    <img src="${imagem}"
                         style="width:40px;height:40px;object-fit:cover;border-radius:6px;${imagemEstilo}">

                    <!-- INFO -->
                    <div class="flex-grow-1">
                        <div class="fw-bold small">
                            ${f.nome_personagem || 'Sem nome'}
                        </div>

                        <div class="d-flex gap-1 mt-1 flex-wrap">

                            ${podeEditar ? `
                                <button class="btn btn-secondary btn-sm editar-ficha" data-id="${f.id}">
                                    Editar
                                </button>
                            ` : ''}

                            ${podeRemover ? `
                                <button class="btn btn-sm btn-danger remover-ficha" data-id="${f.id}">
                                    Remover
                                </button>
                            ` : ''}

                        </div>
                    </div>

                </div>
            `;
                });

                container.html(html);

            }, 'json');
        }

        // 3. Atualizar a lista ao fechar o modal

        $(document).on('click', '.jogador-item', function() {

            const userId = $(this).data('id');
            const container = $('#fichas-user-' + userId);

            if (container.is(':visible')) {
                container.slideUp();
                return;
            }

            container.html('Carregando...');
            container.slideDown();



            carregarFichasUsuario(userId, container);




        });

        $(document).on('submit', '#formChat', function(e) {
            e.preventDefault();

            const msg = $('#chatInput').val();

            if (!msg.trim()) return;

            $.post('backend/enviar_mensagem.php', {
                mensagem: msg,
                campanha_id: campanhaAtual
            }, function() {
                carregarMensagens(campanhaAtual); // opcional (ver abaixo)
            });

            $('#chatInput').val('');
        });

        let chatInterval = null;

        function carregarChat(campanhaId) {

            if (!campanhaId) return;

            if (chatInterval) {
                clearInterval(chatInterval);
            }

            chatInterval = setInterval(() => {

                $.get('backend/listar_mensagens.php', {
                    campanha_id: campanhaId
                }, function(res) {

                    if (res.status !== 'sucesso') return;

                    let html = '';

                    res.mensagens.forEach(m => {
                        html += `<div><b>${m.username}:</b> ${m.mensagem}</div>`;
                    });

                    $('#chatMensagens').html(html);

                }, 'json');

            }, 500);
        }

        let fichasSelecionadas = [];

        $(document).on('click', '.btn-add-ficha', function(e) {
            e.stopPropagation();

            const userId = $(this).data('user');

            fichasSelecionadas = [];

            $('#modalAddFicha').modal('show');

            $.get('backend/buscar_fichas.php', {
                campanha_id: campanhaAtual
            }, function(fichas) {

                const dadosFichas = typeof fichas === 'string' ? JSON.parse(fichas) : fichas;

                let html = '';

                dadosFichas.forEach(f => {

                    const checked = f.na_campanha ? 'checked' : '';
                    const disabled = f.na_campanha ? 'disabled' : '';

                    html += `
            <div class="d-flex align-items-center gap-2 mb-1">

                <input type="checkbox"
                       value="${f.id}"
                       class="check-ficha"
                       ${checked}
                       ${disabled}>

                <span>
                    ${f.nome_personagem}
                    ${f.na_campanha ? '<small class="text-success">(já adicionada)</small>' : ''}
                </span>

            </div>
        `;
                });

                $('#listaMinhasFichas').html(html);
            });
        });

        $('#confirmarAddFicha').click(function() {

            const ids = [];

            $('.check-ficha:checked').each(function() {
                ids.push($(this).val());
            });

            $.post('backend/adicionar_fichas_campanha.php', {
                campanha_id: campanhaAtual,
                fichas: ids
            }, function(res) {

                if (res.status === 'sucesso') {
                    $('#modalAddFicha').modal('hide');

                    // recarrega campanha
                    carregarCampanha(campanhaAtual);
                }

            }, 'json');
        });


        document.addEventListener('fichaAtualizada', function(e) {
            console.log('Ficha atualizada detectada');

            // Atualiza todos os containers abertos
            $('.fichas-usuario:visible').each(function() {

                const container = $(this);
                const userId = container.attr('id').replace('fichas-user-', '');

                carregarFichasUsuario(userId, container);
            });
        });

        $(document).on('click', '.editar-ficha', function(e) {
            e.stopPropagation();

            const fichaId = $(this).data('id');

            modoEdicao = true;
            getDadosFicha(fichaId);
        });

        $(document).on('click', '.remover-ficha', function(e) {
            e.stopPropagation();

            const fichaId = $(this).data('id');

            if (!confirm('Remover esta ficha da campanha?')) return;

            $.post('backend/remover_ficha_campanha.php', {
                ficha_id: fichaId,
                campanha_id: campanhaAtual
            }, function(res) {

                if (res.status === 'sucesso') {
                    carregarCampanha(campanhaAtual);
                } else {
                    alert(res.mensagem || 'Erro');
                }

            }, 'json');
        });
        $(document).on('click', '#btnConfigCampanha', function() {

            $('#editarNomeCampanha').val(campanhaData.nome);
            $('#editarDescricaoCampanha').val(campanhaData.descricao);
            $('#codigoCampanha').val(campanhaData.codigo_convite);

            const modal = new bootstrap.Modal(document.getElementById('modalCampanha'));
            modal.show();
        });

        $(document).on('click', '#copiarCodigo', function() {
            navigator.clipboard.writeText($('#codigoCampanha').val());
        });

        $(document).on('click', '#salvarCampanha', function() {

            $.post('backend/editar_campanha.php', {
                campanha_id: campanhaAtual,
                nome: $('#editarNomeCampanha').val(),
                descricao: $('#editarDescricaoCampanha').val()
            }, function(res) {

                if (res.status === 'sucesso') {
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

                    campanhaAtual = null;


                    carregarListaCampanhas();
                    $('#conteudoCampanha').html(`
                        
                    `);

                }

            }, 'json');
        });
        $(document).on('click', '.remover-jogador', function(e) {
            e.stopPropagation();

            const userId = $(this).data('id');

            if (!confirm('Remover este jogador da campanha?')) return;

            $.post('backend/remover_jogador_campanha.php', {
                usuario_id: userId,
                campanha_id: campanhaAtual
            }, function(res) {

                if (res.status === 'sucesso') {
                    carregarCampanha(campanhaAtual);
                } else {
                    alert(res.mensagem || 'Erro');
                }

            }, 'json');
        });















        function abrirView(view) {

            $('.view').removeClass('active');

            if (view === 'campanhas') {
                $('#view-campanhas').addClass('active');
            }

            if (view === 'chat') {
                $('#view-chat').addClass('active');
            }

            if (view === 'fichas') {
                $('#view-fichas').addClass('active');
            }
        }

        $(document).on('click', '.btn-nav', function() {
            const view = $(this).data('view');
            abrirView(view);
        });

        $(document).on('click', '#btnVoltar', function() {
            abrirView('campanhas');
        });

    });
</script>

<style>
    /* MOBILE */
    @media (max-width: 768px) {

        .view {
            display: none !important;
            width: 100%;
        }

        .view.active {
            display: flex !important;
            flex-direction: column;
        }

        #view-campanhas {
            display: flex !important;
        }

    }
</style>

<?php include('footer.php'); ?>