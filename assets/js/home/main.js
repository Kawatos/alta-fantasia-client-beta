// ==========================================
// ARQUIVO: assets/js/home/main.js
// ==========================================

// 1. Importações (trazendo o garçom, o montador de telas e o chat)
import * as API from './api.js';
import * as TPL from './templates.js';
import * as Chat from './chat.js';

$(document).ready(function () {
    // 2. Estado Global da Home (Protegido dentro do módulo)
    const estado = {
        campanhaAtual: null,
        usuarioLogado: document.body.dataset.userId,
        dadosCampanha: null
    };

    // 3. Inicialização
    carregarListaCampanhas();
    carregarSidebarFichas();

    // ==========================================
    // FUNÇÕES DE CONTROLE DE TELA
    // ==========================================

    function alternarView(view) {
        if (window.innerWidth >= 768) return;
        $('.mobile-view').removeClass('active-view');
        if (view === 'sidebar') {
            $('#view-sidebar').addClass('active-view');
        } else if (view === 'campanha') {
            $('#view-campanha').addClass('active-view');
        }
    }


    // ==========================================
    // INTEGRAÇÕES COM A API
    // ==========================================

    function carregarListaCampanhas() {
        $('#sidebarCampanhas').html('<div class="text-center p-3 text-muted">Carregando...</div>');

        API.listarCampanhas().done(function (res) {
            if (res.status !== 'sucesso') {
                $('#sidebarCampanhas').html('<div class="text-danger p-3">Erro ao carregar campanhas</div>');
                return;
            }
            if (res.campanhas.length === 0) {
                $('#sidebarCampanhas').html('<div class="text-muted text-center p-4">Você não participa de nenhuma campanha.</div>');
                return;
            }

            const html = res.campanhas.map(c => TPL.templateSidebarCampanha(c)).join('');
            $('#sidebarCampanhas').html(html);
        }).fail(function () {
            $('#sidebarCampanhas').html('<div class="text-danger p-3">Erro de conexão</div>');
        });
    }

    function carregarSidebarFichas() {
        $('#sidebarFichas').html('<div class="text-center p-3 text-muted">Carregando...</div>');
        $.get('backend/buscar_fichas.php', function (fichas) {
            if (fichas.length === 0) {
                return $('#sidebarFichas').html('<div class="text-muted text-center p-4">Nenhuma ficha criada.</div>');
            }

            // Força a conversão para número para evitar bugs de ordenação de strings
            fichas.sort((a, b) => parseInt(b.id) - parseInt(a.id));

            const html = fichas.map(f => {
                const img = f.personagem_imagem || 'uploads/perfil-vazio.png';
                const tipo = f.tipo_ficha || 'padrao';

                // 🎨 Configuração visual dos tipos de ficha (Cor, Nome amigável e Ícone)
                const configTipos = {
                    'padrao': { nome: 'Padrão Alta', cor: 'bg-primary' },
                    'bloco': { nome: 'Bloco de Notas', cor: 'bg-warning ' },
                    'arquivo': { nome: 'PDF', cor: 'bg-info' }
                };

                // Busca a configuração do tipo atual. Se vier algo estranho do banco, usa um cinza escuro de fallback.
                const estiloTipo = configTipos[tipo] || { nome: tipo, cor: 'bg-dark', icone: 'bi-tag' };

                // Variável para guardar o Nível/Rank (só aparece se for padrão)
                let infoProgressao = '';

                if (tipo === 'padrao') {
                    const xp = parseInt(f.nivel) || 0;
                    const nivelAtual = Math.floor(xp / 100);
                    const rankAtual = Math.floor((nivelAtual - 1) / 10) + 1;

                    infoProgressao = `<small class="text-muted d-block mt-1">Nível ${nivelAtual} • Rank ${rankAtual}</small>`;
                }

                return `
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-3  border-0 rounded mb-1" data-id="${f.id}" data-tipo="${tipo}">
                                <div class="btn-editar d-flex align-items-center gap-3 flex-grow-1 p-2" style="cursor: pointer;" data-id="${f.id}" data-tipo="${tipo}">
        
                                    <img src="${img}" class="rounded shadow-sm" style="width: 48px; height: 48px; object-fit: cover;">
                                    
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="mb-0 text-truncate fw-bold">${f.nome_personagem || 'Sem nome'}</h6>
                                            
                                            <span class="badge ${estiloTipo.cor} d-flex align-items-center gap-1" style="font-size: 0.65rem;">
                                                ${estiloTipo.nome}
                                            </span>
                                        </div>
                                        ${infoProgressao}
                                    </div>
                                    
                                </div>
                                    
                                <div class="dropdown" >
                                    <button class="btn btn-sm btn-link text-muted p-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Opções">
                                        <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="z-index:999;">
                                        <li>
                                            <button class="dropdown-item d-flex align-items-center gap-2 btn-editar " data-id="${f.id}" data-tipo="${tipo}">
                                                <i class="bi bi-pencil text-secondary"></i> Editar Ficha
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item d-flex align-items-center gap-2 btn-duplicar-ficha" data-id="${f.id}">
                                                <i class="bi bi-files text-info"></i> Duplicar Ficha
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button class="dropdown-item d-flex align-items-center gap-2 text-danger btn-excluir-ficha" data-id="${f.id}">
                                                <i class="bi bi-trash"></i> Excluir Ficha
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        `;
            }).join('');

            $('#sidebarFichas').html(html);

            $('#sidebarFichas').html(html);
        }, 'json');
    }



    function carregarCampanha(campanhaId) {
        if (!campanhaId) return;

        // Prepara a UI
        // Limpa a tela, esconde a Ficha Inline e mostra o Chat da Campanha
        $('#empty-state').removeClass('d-md-block').addClass('d-none');
        $('#conteudoFichaInline').addClass('d-none'); // <--- Esconde a ficha!
        $('#conteudoCampanha').removeClass('d-none').addClass('flex-grow-1').html(TPL.templateEsqueletoCampanha());

        alternarView('campanha');

        // Busca dados
        API.buscarCampanhaDetalhes(campanhaId).done(function (res) {
            if (res.status !== 'sucesso') return;
            estado.dadosCampanha = res.campanha;

            $('#headerNome').text(res.campanha.nome);
            $('#headerAvatar').text(res.campanha.nome.charAt(0).toUpperCase());

            if (res.papel === 'mestre') {
                $('#headerActions').html(`<button class="btn btn-light" id="btnConfigCampanha" title="Configurações">⚙️</button>`);
            } else {
                $('#headerActions').html(`<button class="btn btn-outline-danger btn-sm fw-bold px-3" id="btnSairCampanha">Sair</button>`);
            }

            const htmlJogadores = res.jogadores.map(j => TPL.templateJogador(j, estado.usuarioLogado, res.papel)).join('');
            $('#listaJogadores').html(htmlJogadores);

            // Inicia o módulo de Chat!
            Chat.iniciar(campanhaId, res.papel);
        });
    }

    function carregarFichasUsuario(userId, container) {
        API.buscarFichasUsuario(userId, estado.campanhaAtual).done(function (res) {
            if (res.status !== 'sucesso') return;
            if (!res.fichas || res.fichas.length === 0) {
                container.html(`<div class="text-muted small text-center mt-2">Nenhum personagem.</div>`);
                return;
            }

            const html = res.fichas.map(f => TPL.templateFichaUsuario(f, estado.usuarioLogado, res.papel)).join('');
            container.html(html);
        });
    }


    // ==========================================
    // EVENTOS (CLIQUES E SUBMITS)
    // ==========================================


    // Navegação Mobile
    $(document).on('click', '#btnVoltarLista, #btnVoltarListaFichas', function () {
        // 🚨 AUTO-SAVE: Salva ao voltar pro menu no celular
        if (this.id === 'btnVoltarListaFichas' && typeof window.autoSalvarFichaAtual === 'function') {
            window.autoSalvarFichaAtual();
        }

        alternarView('sidebar');
        Chat.parar();
    });

    // Selecionar Campanha
    $(document).on('click', '.campanha-item', function (e) {
        e.preventDefault();
        $('.campanha-item').removeClass('active bg-light');
        $(this).addClass('active bg-light');

        estado.campanhaAtual = $(this).data('id');
        carregarCampanha(estado.campanhaAtual);
    });

    // Modais e Configurações de Campanha
    $(document).on('click', '#btnConfigCampanha', function () {
        $('#editarNomeCampanha').val(estado.dadosCampanha.nome);
        $('#editarDescricaoCampanha').val(estado.dadosCampanha.descricao);
        $('#codigoCampanha').val(estado.dadosCampanha.codigo_convite);
        new bootstrap.Modal(document.getElementById('modalCampanha')).show();
    });

    $(document).on('click', '#btnConfigCampanha', function () {
        $('#editarNomeCampanha').val(estado.dadosCampanha.nome);
        $('#editarDescricaoCampanha').val(estado.dadosCampanha.descricao);
        $('#codigoCampanha').val(estado.dadosCampanha.codigo_convite);
        // Usando a instância correta!
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCampanha')).show();
    });

    $(document).on('click', '#salvarCampanha', function () {
        API.editarCampanha(estado.campanhaAtual, $('#editarNomeCampanha').val(), $('#editarDescricaoCampanha').val()).done(function (res) {
            if (res.status === 'sucesso') {
                $('#modalCampanha').modal('hide');
                carregarListaCampanhas();
                carregarCampanha(estado.campanhaAtual);
            }
        });
    });



    // Clicar em "Editar" dentro da Campanha (Mantém como Modal)
    $(document).on('click', '.editar-ficha', function (e) {
        e.preventDefault(); e.stopPropagation();
        if (typeof window.abrirFicha === 'function') {
            window.abrirFicha($(this).data('id'), $(this).data('tipo'), 'modal');
        }
    });

    $(document).on('click', '#excluirCampanha', function () {
        if (!confirm('Tem certeza que deseja excluir a campanha?')) return;
        API.excluirCampanha(estado.campanhaAtual).done(function (res) {
            if (res.status === 'sucesso') {
                $('#modalCampanha').modal('hide');
                estado.campanhaAtual = null;
                Chat.parar();
                $('#conteudoCampanha').addClass('d-none').html('');
                $('#empty-state').removeClass('d-none');
                carregarListaCampanhas();
                alternarView('sidebar');
            }
        });
    });

    document.addEventListener('fichaAtualizada', function () {
        carregarSidebarFichas();
        if (estado.campanhaAtual) {
            // Acha a div das fichas do usuário logado (que foi quem editou a ficha)
            const container = $('#fichas-user-' + estado.usuarioLogado);

            // Se a div estiver aberta na tela, manda recarregar!
            if (container.length && container.is(':visible')) {
                carregarFichasUsuario(estado.usuarioLogado, container);
            }
        }
    });

    $(document).on('click', '#btnSairCampanha', function () {
        if (!confirm('Tem certeza que deseja sair desta campanha? Suas fichas continuarão vinculadas a você, mas não aparecerão mais aqui.')) return;
        API.sairCampanha(estado.campanhaAtual).done(function (res) {
            if (res.status === 'sucesso') {
                estado.campanhaAtual = null;
                Chat.parar();
                $('#conteudoCampanha').addClass('d-none').html('');
                $('#empty-state').removeClass('d-none');
                carregarListaCampanhas();
                alternarView('sidebar');
                alert('Você saiu da campanha.');
            } else {
                alert(res.mensagem || 'Erro ao sair da campanha.');
            }
        });
    });

    // Jogadores e Fichas
    $(document).on('click', '.jogador-item', function (e) {
        if ($(e.target).closest('button').length) return;

        const userId = $(this).data('id');
        const container = $('#fichas-user-' + userId);

        if (container.is(':visible')) {
            container.slideUp();
            return;
        }

        container.html('<div class="text-center small text-muted">Carregando...</div>');
        container.slideDown();
        carregarFichasUsuario(userId, container);
    });

    // IMPORTANTE: Aqui você acionava getDadosFicha que estava no window.
    // Como estamos modularizando, se essa função for para outra página,
    // considere usar um redirect `window.location.href = ...` em vez de chamar a função aqui.
    // Ação de clicar na ficha (Abre o Editor)
    $(document).on('click', '.editar-ficha', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const fichaId = $(this).data('id');
        const tipoFicha = $(this).data('tipo') || 'padrao';

        // Verifica se o motor do editor foi carregado na página
        if (typeof window.abrirFicha === 'function') {
            window.abrirFicha(fichaId, tipoFicha);
        } else {
            console.error("Erro: O script do editor não foi carregado nesta página.");
            alert("Erro ao carregar o editor de fichas.");
        }
    });

    $(document).on('click', '.remover-ficha', function (e) {
        e.stopPropagation();
        const fichaId = $(this).data('id');
        const container = $(this).closest('.fichas-usuario');
        const userId = container.attr('id').replace('fichas-user-', '');

        if (!confirm('Remover esta ficha da campanha?')) return;

        API.removerFichaCampanha(fichaId, estado.campanhaAtual).done(function (res) {
            if (res.status === 'sucesso') carregarFichasUsuario(userId, container);
        });
    });

    $(document).on('click', '.duplicar-ficha-campanha', function (e) {
        e.stopPropagation();
        const fichaId = $(this).data('id');

        API.duplicarFicha(fichaId).done(function (res) {
            if (res.sucesso) {
                alert('Ficha duplicada com sucesso!');
                // Recarrega a lista de fichas do usuário
                const container = $('.fichas-usuario:visible').first();
                if (container.length) {
                    const userId = container.attr('id').replace('fichas-user-', '');
                    carregarFichasUsuario(userId, container);
                }
            } else {
                alert('Erro ao duplicar: ' + (res.erro || 'Erro desconhecido'));
            }
        });
    });

    $(document).on('click', '.remover-jogador', function () {
        if (!confirm('Remover este jogador da campanha?')) return;
        API.removerJogadorCampanha($(this).data('id'), estado.campanhaAtual).done(function (res) {
            if (res.status === 'sucesso') carregarCampanha(estado.campanhaAtual);
        });
    });

    // Adicionar Fichas (Modal)
    $(document).on('click', '.btn-add-ficha', function () {
        $('#modalAddFicha').modal('show');
        $('#listaMinhasFichas').html('<div class="text-center">Carregando seus personagens...</div>');

        API.buscarMinhasFichasParaAdicionar(estado.campanhaAtual).done(function (fichas) {
            const dadosFichas = typeof fichas === 'string' ? JSON.parse(fichas) : fichas;
            const html = '<div class="list-group">' + dadosFichas.map(f => TPL.templateItemMinhasFichas(f)).join('') + '</div>';
            $('#listaMinhasFichas').html(html);
        });
    });

    $('#confirmarAddFicha').click(function () {
        const ids = [];
        $('.check-ficha:checked:not(:disabled)').each(function () {
            ids.push($(this).val());
        });

        if (ids.length === 0) return $('#modalAddFicha').modal('hide');

        API.adicionarFichasCampanha(estado.campanhaAtual, ids).done(function (res) {
            if (res.status === 'sucesso') {
                $('#modalAddFicha').modal('hide');
                const container = $('#fichas-user-' + estado.usuarioLogado);
                container.slideDown();
                carregarFichasUsuario(estado.usuarioLogado, container);
            }
        });
    });

    // Criar Ficha na Campanha (SweetAlert)
    $(document).on('click', '.btn-criar-ficha-campanha', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (typeof Swal === 'undefined') return alert("Erro: SweetAlert2 não está carregado.");

        Swal.fire({
            title: 'Escolha o formato da ficha',
            input: 'select',
            inputOptions: { 'bloco': 'Bloco de Notas', 'arquivo': 'PDF', 'padrao': 'Padrão Alta' },
            inputPlaceholder: 'Selecione uma opção',
            showCancelButton: true,
            confirmButtonText: 'Avançar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => { if (!value) return 'Você precisa escolher um formato!'; }
        }).then((formatoResult) => {
            if (formatoResult.isConfirmed) {
                Swal.fire({
                    title: 'Nome do personagem',
                    input: 'text',
                    inputPlaceholder: 'Ex: Arthanor',
                    showCancelButton: true,
                    confirmButtonText: 'Criar Ficha',
                    inputValidator: (value) => { if (!value) return 'Você precisa digitar um nome!'; }
                }).then((nomeResult) => {
                    if (nomeResult.isConfirmed) {
                        API.criarFicha(nomeResult.value, formatoResult.value).then(data => {
                            if (data.status === 'sucesso') {
                                Swal.fire({ icon: 'success', title: 'Ficha criada!', showConfirmButton: false, timer: 1000 })
                                    .then(() => {
                                        // Atualiza as fichas do usuário visualmente
                                        const container = $('#fichas-user-' + estado.usuarioLogado);
                                        carregarFichasUsuario(estado.usuarioLogado, container);
                                        carregarSidebarFichas();
                                    });
                            } else {
                                Swal.fire({ icon: 'error', title: data.mensagem, showConfirmButton: false, timer: 1500 });
                            }
                        });
                    }
                });
            }
        });
    });

    // Criar e Entrar em Campanha (Submits de Modal)
    $('#formCriar').on('submit', function (e) {
        e.preventDefault();
        $('#feedbackCriar').html('<div class="text-muted">Criando...</div>');

        API.criarCampanha($(this).serialize()).done(function (res) {
            if (res.status === 'sucesso') {
                $('#feedbackCriar').html(`<div class="alert alert-success p-2">Criada com sucesso!<br>Código: <b>${res.codigo}</b></div>`);
                $('#formCriar')[0].reset();
                carregarListaCampanhas();
                setTimeout(() => $('#modalCriar').modal('hide'), 2000);
            } else {
                $('#feedbackCriar').html('<div class="text-danger">' + res.mensagem + '</div>');
            }
        });
    });

    $('#formEntrar').on('submit', function (e) {
        e.preventDefault();
        $('#feedbackEntrar').html('<div class="text-muted">Entrando...</div>');

        API.entrarCampanha($(this).serialize()).done(function (res) {
            if (res.status === 'sucesso') {
                $('#feedbackEntrar').html('<div class="alert alert-success p-2">Entrou na campanha!</div>');
                $('#formEntrar')[0].reset();
                carregarListaCampanhas();
                setTimeout(() => $('#modalEntrar').modal('hide'), 1500);
            } else {
                $('#feedbackEntrar').html('<div class="text-danger">' + res.mensagem + '</div>');
            }
        });
    });





    $(document).on('hidden.bs.modal', function () {
        if ($('.modal.show').length === 0) {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css('padding-right', '');
        }
    });

    // 🚨 AUTO-SAVE: Ocorre quando o usuário clica nas abas do Menu Lateral
    $('button[data-bs-toggle="pill"]').on('show.bs.tab', function (e) {
        if (typeof window.autoSalvarFichaAtual === 'function') window.autoSalvarFichaAtual();
    });

});