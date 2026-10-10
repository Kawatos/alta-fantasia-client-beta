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
    if (estado.usuarioLogado) {
        carregarListaCampanhas();
        carregarSidebarFichas();
    }

    // Reatividade SPA para login e logout
    window.addEventListener('af:auth-change', function () {
        estado.usuarioLogado = document.body.dataset.userId;
        if (estado.usuarioLogado) {
            carregarListaCampanhas();
            carregarSidebarFichas();
        } else {
            $('#sidebarCampanhas').html('<div class="text-muted text-center p-4">Você não está logado.</div>');
            $('#sidebarFichas').html('');
        }
    });

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
                    'padrao': { nome: '⚔️ Padrão', cor: 'bg-primary text-white' },
                    'bloco': { nome: '📝 Bloco', cor: 'bg-warning text-dark' },
                    'arquivo': { nome: '📄 PDF', cor: 'bg-info text-dark' }
                };

                const estiloTipo = configTipos[tipo] || { nome: tipo, cor: 'bg-secondary text-white' };

                let infoProgressao = '';
                if (tipo === 'padrao') {
                    const xp = parseInt(f.nivel) || 0;
                    const nivelAtual = Math.floor(xp / 100);
                    const rankAtual = Math.floor((nivelAtual - 1) / 10) + 1;
                    infoProgressao = `<small class="text-white-50 d-flex align-items-center gap-1 mt-0.5" style="font-size:0.74rem;"><span class="text-warning fw-bold">Nv ${nivelAtual}</span> • <span>Rank ${rankAtual}</span></small>`;
                } else {
                    infoProgressao = `<small class="text-white-50 d-block mt-0.5" style="font-size:0.72rem;">Ficha Personalizada</small>`;
                }

                return `
                    <div class="sidebar-ficha-item d-flex align-items-center justify-content-between p-2 m-2 rounded-3" data-id="${f.id}" data-tipo="${tipo}" style="background: rgba(255, 255, 255, 0.04); border: 1px solid var(--af-glass-border); cursor: pointer; transition: all 0.2s ease;">
                        <div class="d-flex align-items-center flex-grow-1 overflow-hidden" style="min-width: 0;">
                            <img src="${img}" class="rounded shadow-sm flex-shrink-0 me-3" style="width: 44px; height: 44px; object-fit: cover; border: 1px solid rgba(255,255,255,0.15);">
                            <div class="flex-grow-1 overflow-hidden" style="min-width: 0;">
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <h6 class="mb-0 text-truncate fw-bold text-white flex-grow-1 me-2.5" style="font-size: 0.92rem;">${f.nome_personagem || 'Sem nome'}</h6>
                                    <span class="badge ${estiloTipo.cor} flex-shrink-0" style="font-size: 0.65rem; font-weight: 600; padding: 0.35em 0.6em;">
                                        ${estiloTipo.nome}
                                    </span>
                                </div>
                                ${infoProgressao}
                            </div>
                        </div>
                                    
                        <div class="dropdown flex-shrink-0 ms-2">
                            <button class="btn btn-sm btn-link text-muted p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Opções" style="line-height: 1;">
                                <i class="bi bi-three-dots-vertical fs-5"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="z-index:999;">
                                <li>
                                    <button class="dropdown-item d-flex align-items-center gap-2 btn-editar-modal" data-id="${f.id}" data-tipo="${tipo}">
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
                    </div>
                `;
            }).join('');

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
                $('#headerActions').html(`
                    <button class="btn btn-sm d-flex align-items-center justify-content-center rounded-circle" id="btnConfigCampanha" title="Configurações da Mesa" style="width: 38px; height: 38px; background: rgba(240,199,94,0.12); border: 1px solid var(--af-gold-soft); color: var(--af-gold-soft); transition: all 0.25s ease;">
                        <i class="bi bi-gear-fill fs-5"></i>
                    </button>
                `);
            } else {
                $('#headerActions').html(`<button class="btn btn-outline-danger btn-sm fw-bold px-3" id="btnSairCampanha">Sair</button>`);
            }

            // Ordena os jogadores para o mestre sempre ficar no topo!
            if (Array.isArray(res.jogadores)) {
                res.jogadores.sort((a, b) => {
                    const isMestreA = (a.papel === 'mestre' || a.id == res.campanha?.mestre_id);
                    const isMestreB = (b.papel === 'mestre' || b.id == res.campanha?.mestre_id);
                    if (isMestreA && !isMestreB) return -1;
                    if (!isMestreA && isMestreB) return 1;
                    return (a.username || '').localeCompare(b.username || '');
                });
            }

            const htmlJogadores = res.jogadores.map(j => TPL.templateJogador(j, estado.usuarioLogado, res.papel)).join('');
            $('#listaJogadores').html(htmlJogadores);

            // Inicia o módulo de Chat!
            Chat.iniciar(campanhaId, res.papel);
        });
    }

    function carregarFichasJogadorModal(userId) {
        const container = $('#modalJogadorListaFichas');
        container.html('<div class="text-center py-4 text-white-50"><div class="spinner-border spinner-border-sm text-warning me-2"></div>Carregando fichas...</div>');

        API.buscarFichasUsuario(userId, estado.campanhaAtual).done(function (res) {
            if (res.status !== 'sucesso') {
                container.html('<div class="text-danger text-center py-3">Erro ao buscar fichas.</div>');
                return;
            }
            if (!res.fichas || res.fichas.length === 0) {
                container.html(`
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-journal-x fs-1 opacity-50 d-block mb-2 text-warning"></i>
                        <p class="mb-0 small text-white-50">Nenhuma ficha vinculada a esta mesa por este jogador.</p>
                    </div>
                `);
                return;
            }

            const html = res.fichas.map(f => TPL.templateFichaUsuario(f, estado.usuarioLogado, res.papel)).join('');
            container.html(html);
        }).fail(function () {
            container.html('<div class="text-danger text-center py-3">Erro de conexão ao buscar fichas.</div>');
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
        $('.campanha-item').removeClass('active');
        $('.sidebar-ficha-item').removeClass('active');
        $(this).addClass('active');

        estado.campanhaAtual = $(this).data('id');
        carregarCampanha(estado.campanhaAtual);
    });

    // Clicar numa Ficha da Sidebar (Abre no Modal)
    $(document).on('click', '.sidebar-ficha-item', function (e) {
        // Ignora cliques no menu dropdown de opções (3 pontinhos)
        if ($(e.target).closest('.dropdown').length) return;
        e.preventDefault();

        const fichaId = $(this).data('id');
        const tipoFicha = $(this).data('tipo') || 'padrao';

        if (typeof window.abrirFicha === 'function') {
            window.abrirFicha(fichaId, tipoFicha, 'modal');
        }
    });

    // Clicar no botão "Editar Ficha" do dropdown da sidebar (Abre em Modal)
    $(document).on('click', '.btn-editar-modal', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const fichaId = $(this).data('id');
        const tipoFicha = $(this).data('tipo') || 'padrao';
        if (typeof window.abrirFicha === 'function') {
            window.abrirFicha(fichaId, tipoFicha, 'modal');
        }
    });

    // Modais e Configurações de Campanha
    $(document).on('click', '#btnConfigCampanha', function () {
        $('#editarNomeCampanha').val(estado.dadosCampanha.nome);
        $('#editarDescricaoCampanha').val(estado.dadosCampanha.descricao);
        $('#codigoCampanha').val(estado.dadosCampanha.codigo_convite);
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

    function atualizarFichasJogadorModalSeAberto(userId) {
        const modalEl = document.getElementById('modalJogadorFichas');
        if (modalEl && $(modalEl).hasClass('show')) {
            const currentUserId = $(modalEl).data('userId');
            if (!userId || userId == currentUserId) {
                carregarFichasJogadorModal(currentUserId);
            }
        }
    }

    document.addEventListener('fichaAtualizada', function () {
        carregarSidebarFichas();
        atualizarFichasJogadorModalSeAberto();
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

    // Clicar em Jogador da Mesa -> Abre o Modal com as Fichas do Jogador
    $(document).on('click', '.jogador-item', function (e) {
        if ($(e.target).closest('button').length) return;

        const userId = $(this).data('id');
        const username = $(this).data('username') || 'Jogador';
        const papel = $(this).data('papel') || 'jogador';

        $('#modalJogadorNome').text(username);
        $('#modalJogadorAvatar').text(username.charAt(0).toUpperCase());
        const roleBadge = (papel === 'mestre')
            ? '<span class="badge py-1 px-2.5" style="background: linear-gradient(135deg, #d4a017, #b8860b); color: #101235; font-weight: 700; box-shadow: 0 2px 6px rgba(212,160,23,0.3); font-size: 0.72rem;"><i class="fas fa-crown me-1"></i>Mestre</span>'
            : '<span class="badge py-1 px-2.5" style="background: rgba(255,255,255,0.1); color: #e9eaf5; border: 1px solid rgba(255,255,255,0.18); font-size: 0.72rem;"><i class="fas fa-shield-alt me-1"></i>Jogador</span>';
        $('#modalJogadorBadge').html(roleBadge);

        if (userId == estado.usuarioLogado) {
            $('#modalJogadorAcoes').removeClass('d-none');
            $('#btnModalAddFicha').attr('data-user', userId);
        } else {
            $('#modalJogadorAcoes').addClass('d-none');
        }

        $('#modalJogadorFichas').data('userId', userId);
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalJogadorFichas')).show();
        carregarFichasJogadorModal(userId);
    });

    // Clicar em uma Ficha (Abre o Editor no Modal)
    $(document).on('click', '.editar-ficha', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const fichaId = $(this).data('id');
        const tipoFicha = $(this).data('tipo') || 'padrao';

        // Fecha o modal de lista de fichas do jogador antes de abrir o modal da ficha
        const modalJogador = bootstrap.Modal.getInstance(document.getElementById('modalJogadorFichas'));
        if (modalJogador) {
            modalJogador.hide();
        }

        // Verifica se o motor do editor foi carregado na página
        if (typeof window.abrirFicha === 'function') {
            window.abrirFicha(fichaId, tipoFicha, 'modal');
        } else {
            console.error("Erro: O script do editor não foi carregado nesta página.");
            alert("Erro ao carregar o editor de fichas.");
        }
    });

    $(document).on('click', '.remover-ficha', function (e) {
        e.stopPropagation();
        const fichaId = $(this).data('id');

        if (!confirm('Remover esta ficha da campanha?')) return;

        API.removerFichaCampanha(fichaId, estado.campanhaAtual).done(function (res) {
            if (res.status === 'sucesso') {
                const modalEl = document.getElementById('modalJogadorFichas');
                const userId = $(modalEl).data('userId');
                if (userId) carregarFichasJogadorModal(userId);
            }
        });
    });

    $(document).on('click', '.duplicar-ficha-campanha', function (e) {
        e.stopPropagation();
        const fichaId = $(this).data('id');

        API.duplicarFicha(fichaId).done(function (res) {
            if (res.sucesso) {
                alert('Ficha duplicada com sucesso!');
                const modalEl = document.getElementById('modalJogadorFichas');
                const userId = $(modalEl).data('userId');
                if (userId) carregarFichasJogadorModal(userId);
                carregarSidebarFichas();
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
        $('#listaMinhasFichas').html('<div class="text-center py-3 text-white-50">Carregando seus personagens...</div>');

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
                const modalEl = document.getElementById('modalJogadorFichas');
                const userId = $(modalEl).data('userId');
                if (userId) carregarFichasJogadorModal(userId);
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
                                        const modalEl = document.getElementById('modalJogadorFichas');
                                        const userId = $(modalEl).data('userId');
                                        if (userId) carregarFichasJogadorModal(userId);
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