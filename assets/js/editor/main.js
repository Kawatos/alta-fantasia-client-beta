// ==========================================
// ARQUIVO: assets/js/editor/main.js
// ==========================================

import * as API from './api.js';
import * as Calc from './calc.js';
import * as TPL from './templates.js'; // Faremos no próximo passo!

$(document).ready(function () {
    // --- ESTADO GLOBAL DO EDITOR ---
    const estado = {
        modoEdicao: false,
        fichaIdAtual: null,
        tipoFichaAtual: 'padrao'
    };

    // --- INICIALIZAÇÃO ---
    iniciarEditor();

    function iniciarEditor() {
        carregarListaFichasEditor();
        configurarEventosGerais();
        configurarEventosCalculo();
        iniciarMensagensAleatorias();
        configurarEventosSubItens();
    }

    // ==========================================
    // 1. RENDERIZAÇÃO DA PÁGINA INICIAL DO EDITOR
    // ==========================================

    function carregarListaFichasEditor() {
        const container = $('#lista-fichas');
        if (container.length === 0) return; // Trava de segurança (só roda na página certa)

        container.html('<div class="text-center text-muted">Carregando fichas...</div>');

        API.listarFichas().done(function (fichas) {
            if (fichas.length === 0) {
                container.html('<p class="text-center">Você ainda não criou nenhum personagem.</p>');
                return;
            }

            fichas.sort((a, b) => b.id - a.id);
            const html = fichas.map(f => TPL.cardFicha(f)).join('');
            container.html(html);
        }).fail(function () {
            container.html('<p class="text-center text-danger">Erro ao carregar fichas.</p>');
        });
    }

    // ==========================================
    // 2. ABRIR E PREENCHER A FICHA (O CORAÇÃO DO EDITOR)
    // ==========================================

    // Tornamos a função acessível globalmente CASO algum HTML antigo ainda dependa do onclick="getDadosFicha()"
    // Mas o ideal é usar os Event Listeners abaixo.
    window.abrirFicha = abrirFicha;

    function moverFormularioParaModo(tipoFicha, modo) {
        // 1. Identifica os elementos
        const forms = {
            'padrao': { form: '#formFicha', modal: '#modalFicha' },
            'bloco': { form: '#formFichaBloco', modal: '#modalFichaBloco' },
            'arquivo': { form: '#formFichaArquivo', modal: '#modalFichaArquivo' }
        };

        // 2. ARRUMA A CASA: Devolve todos os formulários e MOSTRA todos os footers
        Object.values(forms).forEach(item => {
            $(item.modal + ' .modal-content').append($(item.form));
            $(item.form + ' .modal-footer').show(); // Garante que volta a aparecer
        });

        // 3. MOVE PRO LUGAR CERTO E GERENCIA O FOOTER
        if (modo === 'inline') {
            const currentForm = forms[tipoFicha].form;

            // Move para a tela principal
            $('#fichaInlineFormContainer').append($(currentForm));

            // ESCONDE o footer especificamente para o modo inline
            $(currentForm + ' .modal-footer').hide();
        }
    }

    window.abrirFicha = abrirFicha;
    function abrirFicha(fichaId, tipoFicha = 'padrao', modo = 'modal') {
        if (!fichaId) return;
        estado.fichaIdAtual = fichaId;
        estado.tipoFichaAtual = tipoFicha;
        estado.modoEdicao = true;

        API.buscarDadosFicha(fichaId).done(function (resposta) {
            if (resposta.status !== 'sucesso') return Swal.fire({ icon: 'info', title: resposta.mensagem, timer: 1000 });

            const ficha = resposta.ficha;

            // --- 1. ATUALIZA O CABEÇALHO (NOME E IMAGEM) ---
            $('#fichaHeaderNome').text(ficha.nome_personagem || 'Sem nome');

            const urlImagem = ficha.personagem_imagem || 'uploads/perfil-vazio.png';
            // Transformamos o avatar em uma imagem real ou mantemos a inicial se preferir
            $('#fichaHeaderAvatar').html(`<img src="${urlImagem}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">`);
            $('#fichaHeaderAvatar').css('background', 'none'); // Remove o gradiente de fundo

            // 2. Move o formulário
            moverFormularioParaModo(tipoFicha, modo);

            if (tipoFicha === 'bloco') {
                $('#bloco-ficha-id').val(ficha.id);
                $('#bloco-nome').val(ficha.nome_personagem || '');
                $('#bloco-texto').val(ficha.bloco_notas || '');
                $('#preview_bloco_imagem').attr('src', urlImagem);
            } else if (tipoFicha === 'arquivo') {
                $('#arquivo-ficha-id').val(ficha.id);
                $('#arquivo-nome').val(ficha.nome_personagem || '');
                $('#preview_arquivo_imagem').attr('src', urlImagem);
                if (ficha.arquivo_pdf) {
                    $('#container-arquivo-atual').removeClass('d-none');
                    $('#iframe-pdf').attr('src', ficha.arquivo_pdf);
                    $('#link-arquivo-atual').attr('href', ficha.arquivo_pdf);
                } else {
                    $('#container-arquivo-atual').addClass('d-none');
                    $('#iframe-pdf').attr('src', '');
                }
            } else {
                preencherCamposBase(ficha, resposta.atributos, resposta.pericias);
                if (modo === 'inline') $('#titulo-modal').addClass('d-none');
                else $('#titulo-modal').removeClass('d-none');

                TPL.renderizarClasses(ficha.classe);
                recarregarSubListas(ficha.id);
                if (modo === 'inline') setTimeout(() => dispararCalculosManualmente(), 100);
            }

            // --- 3. EXIBIÇÃO E LIMPEZA DA TELA ---
            if (modo === 'inline') {
                // Removemos o d-md-block para o desktop não forçar a exibição da mensagem vazia
                $('#empty-state').removeClass('d-md-block d-flex').addClass('d-none');
                $('#conteudoCampanha').addClass('d-none');
                $('#conteudoFichaInline').removeClass('d-none').addClass('d-flex');

                if (window.innerWidth < 768) {
                    $('.mobile-view').removeClass('active-view');
                    $('#view-campanha').addClass('active-view');
                }
            } else {
                let modalId = tipoFicha === 'bloco' ? '#modalFichaBloco' : (tipoFicha === 'arquivo' ? '#modalFichaArquivo' : '#modalFicha');
                bootstrap.Modal.getOrCreateInstance(document.querySelector(modalId)).show();
            }

        }).fail(() => Swal.fire({ icon: 'error', title: 'Erro ao buscar a ficha.', timer: 1000 }));
    }

    function dispararCalculosManualmente() {
        Calc.atualizarNivelEBarra();
        Calc.atualizarAtributos();
        Calc.calcularPericias();
        Calc.atualizarBarraDeVida(false);
        Calc.atualizarBarraDeMana();
        Calc.atualizarPesoTotal();
    }

    function preencherCamposBase(ficha, atributos, pericias) {
        // Limpeza de TextAreas
        $('.descricao-personagem, .descricao_jogador-personagem, .transformacoes_jogador-personagem, .observacoes_atributos-personagem, .observacoes_pericias-personagem, .observacoes_habilidades-personagem, .observacoes_magias_arcanas-personagem, .observacoes_magias_divinas-personagem, .observacoes_itens-personagem, .observacoes_jogador-personagem').val('');

        // --- PREENCHIMENTO DOS CAMPOS BÁSICOS E INPUTS ---
        $('#ficha-id').val(ficha.id);
        $('.nome-personagem').val(ficha.nome_personagem);
        $('.nome-personagem-exibicao').text(ficha.nome_personagem);
        $('.nivel-personagem').val(ficha.nivel);
        $('.raca-personagem').val(ficha.raca);
        $('.pontos-de-vida-personagem').val(ficha.pontos_de_vida);
        $('.pontos-de-mana-personagem').val(ficha.pontos_de_mana);
        $('.pvs_atuais-personagem').val(ficha.pvs_atuais);
        $('.pms_atuais-personagem').val(ficha.pms_atuais);
        $('.deslocamento-personagem').val(ficha.deslocamento);
        $('.regen_pv-personagem').val(ficha.regen_pv);
        $('.regen_pm-personagem').val(ficha.regen_pm);
        $('.divindade-personagem').val(ficha.divindade);
        $('.escola_arcana-personagem').val(ficha.escola_arcana);
        $('.idiomas-personagem').val(ficha.idiomas);
        $('.carga_suportada_mod-personagem').val(ficha.carga_suportada_mod);
        $('.inventario_interno_mod-personagem').val(ficha.inventario_interno_mod);
        $('.altura-personagem').val(ficha.altura);
        $('.idade-personagem').val(ficha.idade);
        $('.sexo-personagem').val(ficha.sexo);
        $('.tendencia-personagem').val(ficha.tendencia);
        $('.nome_jogador-personagem').val(ficha.nome_jogador);
        $('.profissao_jogador-personagem').val(ficha.profissao_jogador);

        // --- PREENCHIMENTO DOS TEXTAREAS (OBSERVAÇÕES) ---
        $('.descricao-personagem').val(ficha.descricao || '');
        $('.descricao_jogador-personagem').val(ficha.descricao_jogador || '');
        $('.transformacoes_jogador-personagem').val(ficha.transformacoes_jogador || '');
        $('.observacoes_atributos-personagem').val(ficha.observacoes_atributos || '');
        $('.observacoes_pericias-personagem').val(ficha.observacoes_pericias || '');
        $('.observacoes_habilidades-personagem').val(ficha.observacoes_habilidades || '');
        $('.observacoes_magias_arcanas-personagem').val(ficha.observacoes_magias_arcanas || '');
        $('.observacoes_magias_divinas-personagem').val(ficha.observacoes_magias_divinas || '');
        $('.observacoes_itens-personagem').val(ficha.observacoes_itens || '');
        $('.observacoes_jogador-personagem').val(ficha.observacoes_jogador || '');

        // --- PREENCHIMENTO DOS ATRIBUTOS ---
        if (atributos) {
            ['vigor', 'forca', 'destreza', 'espirito', 'carisma', 'intelecto'].forEach(attr => {
                $(`.${attr}_mod`).val(atributos[`${attr}_mod`]);
                $(`.${attr}_mod_nv`).val(atributos[`${attr}_mod_nv`]);
            });
        }

        // --- PREENCHIMENTO DAS PERÍCIAS (Substitui as 100 linhas antigas por 5 linhas) ---
        if (pericias) {
            const listaPericias = [
                'tenacidade', 'fortitude', 'reflexo', 'controle', 'atletismo', 'corpoacorpo', 'autocontrole',
                'resiliencia', 'intuicao', 'percepcao', 'influencia', 'atuacao', 'c_arcano', 'c_religioso',
                'c_historico', 'c_natureza', 'c_engenharia', 'c_alquimia', 'c_navegacao', 'c_linguistico',
                't_esgrima', 't_pontaria', 't_marcial', 't_metalurgia', 't_artesanato', 't_ladinagem',
                't_instrumentos', 't_pilotagem'
            ];

            listaPericias.forEach(p => {
                $(`.${p}_mod`).val(pericias[`${p}_mod`]);
                $(`.${p}_treinamentos`).val(pericias[`${p}_treinamentos`]);
                $(`.${p}_proeficiencias`).val(pericias[`${p}_proeficiencias`]);
            });
        }

        // --- IMAGEM ---
        $('#preview_imagem_personagem').attr('src', ficha.personagem_imagem || 'uploads/perfil-vazio.png');
    }

    function recarregarSubListas(fichaId) {
        API.getHabilidades(fichaId).done(res => TPL.renderizarHabilidades(res, fichaId));
        API.getMagias(fichaId).done(res => TPL.renderizarMagias(res, fichaId));
        API.getItens(fichaId).done(res => TPL.renderizarItens(res, fichaId));
    }

    // ==========================================
    // 3. EVENTOS GERAIS (CLIQUES E FORMULÁRIOS)
    // ==========================================

    function configurarEventosGerais() {

        // Abrir modal de edição ao clicar no card da ficha
        $(document).on('click', '.cardPersonagem, .btn-editar', function (e) {
            e.stopPropagation();
            abrirFicha($(this).data('id'), $(this).data('tipo'));
        });

        // Excluir Ficha
        $(document).on('click', '.excluir-ficha', function (e) {
            e.stopPropagation();
            const id = $(this).data('id');

            Swal.fire({
                title: "Tem certeza?", text: "Deseja realmente excluir esta ficha?", icon: "warning",
                showCancelButton: true, confirmButtonColor: "#d33", confirmButtonText: "Sim, excluir"
            }).then((result) => {
                if (result.isConfirmed) {
                    API.excluirFicha(id).done(res => {
                        if (res.sucesso) {
                            Swal.fire({ icon: "success", title: "Ficha excluída!", showConfirmButton: false, timer: 1000 });
                            carregarListaFichasEditor();
                        }
                    });
                }
            });
        });

        // Duplicar Ficha
        $(document).on('click', '.duplicar-ficha', function (e) {
            e.stopPropagation();
            const id = $(this).data('id');

            API.duplicarFicha(id).done(res => {
                if (res.sucesso) {
                    Swal.fire({ icon: "success", title: "Ficha duplicada!", showConfirmButton: false, timer: 1000 });
                    carregarListaFichasEditor();
                } else {
                    Swal.fire({ icon: "error", title: res.erro || "Erro ao duplicar", timer: 1000 });
                }
            });
        });

        // --- 1. SALVAMENTO DA FICHA PADRÃO ---
        $(document).off('submit', '#formFicha').on('submit', '#formFicha', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('classe', JSON.stringify(TPL.getClassesFromForm()));

            const isSilencioso = $(this).data('silencioso'); // Checa se é o Auto-Save

            API.salvarFicha(formData).done(data => {
                if (data.status === 'sucesso' || data.status === 200) {
                    // Avisa a Home para atualizar a barra lateral imediatamente!
                    document.dispatchEvent(new CustomEvent('fichaAtualizada', { detail: {} }));

                    if (!isSilencioso) Swal.fire({ icon: 'success', title: 'Ficha atualizada!', showConfirmButton: false, timer: 700 });
                } else {
                    if (!isSilencioso) Swal.fire({ icon: 'error', title: data.mensagem || 'Erro ao salvar', timer: 1000 });
                }
                $(this).removeData('silencioso'); // Limpa a flag
            });
        });

        // --- 2. SALVAMENTO DAS FICHAS SIMPLES (Bloco e PDF) ---
        $(document).off('submit', '#formFichaBloco, #formFichaArquivo').on('submit', '#formFichaBloco, #formFichaArquivo', function (e) {
            e.preventDefault();
            const isSilencioso = $(this).data('silencioso');

            API.salvarFichaSimples(new FormData(this)).done(res => {
                if (res.status === 'sucesso') {
                    // Avisa a Home para atualizar a barra lateral!
                    document.dispatchEvent(new CustomEvent('fichaAtualizada', { detail: {} }));

                    if (!isSilencioso) Swal.fire({ icon: 'success', title: 'Ficha atualizada!', showConfirmButton: false, timer: 700 });
                }
                $(this).removeData('silencioso');
            });
        });

        // --- 3. A FUNÇÃO GLOBAL DE AUTO-SAVE ---
        // A Home vai chamar isso sempre que o jogador tentar "fugir" da ficha
        window.autoSalvarFichaAtual = function () {
            const formVisivel = $('#fichaInlineFormContainer form:visible');
            if (formVisivel.length > 0) {
                // Coloca a flag silenciosa para não piscar alerta na cara do jogador
                formVisivel.data('silencioso', true);
                formVisivel.submit();
            }
        };

        // Salvar Ficha ao fechar o modal
        document.getElementById('modalFicha')?.addEventListener('hidden.bs.modal', function () {
            const form = document.getElementById('formFicha');
            if (!form) return;
            const formData = new FormData(form);
            formData.append('classe', JSON.stringify(TPL.getClassesFromForm()));

            API.salvarFicha(formData).done(data => {
                if (data.status === 200 || data.status === 'sucesso') {
                    document.dispatchEvent(new CustomEvent('fichaAtualizada', { detail: {} }));
                    carregarListaFichasEditor();
                }
            });
        });
        // Preview da imagem ao selecionar arquivo
        $('#personagem_imagem_id').on('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => $('#preview_imagem_personagem').attr('src', e.target.result);
                reader.readAsDataURL(file);
            }
        });

        // Clique no preview ativa o input de arquivo oculto
        $('#preview_imagem_personagem').on('click', function () {
            $('#personagem_imagem_id').click();
        });

        $(document).on('click', '#btnSalvarFichaInline', function () {
            // Acha qual formulário está visível na div inline e "clica" no submit dele
            $('#fichaInlineFormContainer form:visible').submit();
        });

        // Botão de Excluir Ficha (na Sidebar)
        $(document).on('click', '.btn-excluir-ficha', function (e) {
            e.preventDefault();
            e.stopPropagation(); // Impede que o clique abra a ficha

            const id = $(this).data('id'); // Pega o ID direto do botão clicado na sidebar
            if (!id) return;

            Swal.fire({
                title: "Excluir Personagem?",
                text: "Essa ação não pode ser desfeita!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "Sim, excluir",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    API.excluirFicha(id).done(res => {
                        if (res.sucesso) {
                            Swal.fire({ icon: "success", title: "Ficha excluída!", showConfirmButton: false, timer: 1000 });

                            // Se a ficha excluída for a que está aberta no momento, limpa a tela
                            if (estado.fichaIdAtual == id) {
                                $('#conteudoFichaInline').addClass('d-none');
                                $('#empty-state').removeClass('d-none').addClass('d-md-block');
                                estado.fichaIdAtual = null; // Reseta o estado
                            }

                            // Avisa a Home para atualizar a lista lateral (recarregar a sidebar)
                            document.dispatchEvent(new CustomEvent('fichaAtualizada', { detail: {} }));

                            // Volta para a visualização da sidebar no mobile
                            if (window.innerWidth < 768) {
                                $('.mobile-view').removeClass('active-view');
                                $('#view-sidebar').addClass('active-view');
                            }
                        }
                    });
                }
            });
        });

        // Botão de Duplicar Ficha (na Sidebar)
        $(document).on('click', '.btn-duplicar-ficha', function (e) {
            e.preventDefault();
            e.stopPropagation(); // Impede que o clique abra a ficha

            const id = $(this).data('id'); // Pega o ID direto do botão clicado na sidebar
            if (!id) return;

            API.duplicarFicha(id).done(res => {
                if (res.sucesso) {
                    Swal.fire({ icon: "success", title: "Ficha duplicada!", showConfirmButton: false, timer: 1000 });

                    // Dispara o evento para recarregar a sidebar e mostrar a nova ficha
                    document.dispatchEvent(new CustomEvent('fichaAtualizada', { detail: {} }));
                } else {
                    Swal.fire({ icon: "error", title: res.erro || "Erro ao duplicar", timer: 1000 });
                }
            });
        });


    }

    // ==========================================
    // 4. LIGAÇÃO COM O CALC.JS (A MATEMÁTICA)
    // ==========================================

    function configurarEventosCalculo() {
        const modal = document.getElementById('modalFicha');
        if (!modal) return;

        // Quando o modal abre, força o cálculo de tudo
        modal.addEventListener('shown.bs.modal', () => {
            Calc.atualizarNivelEBarra();
            Calc.atualizarAtributos();
            Calc.calcularPericias();
            Calc.atualizarBarraDeVida(false);
            Calc.atualizarBarraDeMana();
            Calc.atualizarPesoTotal();
        });

        // Escutando inputs de Atributos e XP para recalcular
        $(document).on('input', 'input[name$="_mod"], input[name$="_mod_nv"]', Calc.atualizarAtributos);
        $(document).on('input', '#ficha-xp', Calc.atualizarNivelEBarra);
        $(document).on('input', '.pericia-mod, .treinado, .proeficiente', Calc.calcularPericias);

        // Escutando barras de Vida e Mana
        $(document).on('input', '#ficha-pontos_de_vida, #ficha-pvs_atuais', () => Calc.atualizarBarraDeVida(true));
        $(document).on('input', '#ficha-pontos_de_mana, #ficha-pms_atuais', Calc.atualizarBarraDeMana);

        // Ações rápidas de Cura/Dano (Atribuir nos botões no HTML)
        window.aplicarDano = () => Calc.aplicarAjusteStatus('ficha-pvs_atuais', 'pv-valor-ajuste', '-');
        window.aplicarCura = () => Calc.aplicarAjusteStatus('ficha-pvs_atuais', 'pv-valor-ajuste', '+');
        window.ConjurarMagia = () => Calc.aplicarAjusteStatus('ficha-pms_atuais', 'pm-valor-ajuste', '-');
        window.RecuperarMana = () => Calc.aplicarAjusteStatus('ficha-pms_atuais', 'pm-valor-ajuste', '+');
    }

    // ==========================================
    // 5. MENSAGENS ALEATÓRIAS DE FLAVOR TEXT
    // ==========================================

    function iniciarMensagensAleatorias() {

        const mensagens = [
            '"Que suas aventuras sejam épicas e seus dados sempre favoráveis!"',
            '"Nunca subestime o poder de um crítico natural."',
            '"Até os goblins merecem uma chance... talvez."',
            '"A sorte favorece os audaciosos, mas um bom plano nunca é demais."',
            '"Em um mundo de fantasia, até os sonhos mais loucos podem se tornar realidade."',
            '"A magia está em todo lugar, basta saber onde olhar."',
            '"Cada dado lançado é uma nova história esperando para ser contada."',
            '"A jornada é tão importante quanto o destino."',
            '"Um bom mestre de jogo sabe que a narrativa é mais importante que as regras."',
            '"A amizade é o maior tesouro que um aventureiro pode encontrar."',
            '"A imaginação é o único limite em um mundo de fantasia."',
            '"Role os dados e confie no destino."',
            '"Um herói é feito de escolhas e sorte."',
            '"A verdadeira aventura começa onde o conforto termina."',
            '"Em cada esquina, uma nova história espera para ser descoberta."',
            '"Em Alta Fantasia, um dos pilares da Magia é a criatividade."',
            '"A diplomacia é tão poderosa quanto a espada."',
            '"Nunca subestime o poder de um bom plano de fuga."',
            '"A violencia não é a resposta, mas às vezes é a única opção."',
            '"Nem todos os monstros são maus, e nem todos os heróis são bons."',
            '"Nem todos os vilões podem ser convencidos com palavras."',
            '"As vezes o reconhecimento é o maior tesouro que um aventureiro pode encontrar."',
            '"Atitudes bondosas podem ser mal vistas em certos lugares."',
            '"Mostros se chamam monstros por um motivo."',
            '"Anote os nomes dos NPCs, eles podem ser importantes mais tarde."',
            '"Sempre leve em conta as intenções daqueles que falam com você."',
            '"Violencia gratuíta não é bem vista na grande maioria dos lugares."',
            '"Um bom mestre de jogo sabe que ele não está competindo com os jogadores."',
            '"A verdadeira magia está na capacidade de contar histórias que unem as pessoas."',
            '"Em Alta Fantasia, cada personagem é uma peça fundamental na tapeçaria da aventura."',
            '"O caminho fácil nem sempre é o mais divertido."',
            '"Nem sempre o inimigo do seu inimigo é seu amigo."',
            '"A Progressive Technologies é uma empresa que surgiu do nada, mas que se tornou um dos maiores conglomerados de tecnologia do mundo."',
            '"A única diferença entre Alta e o mundo real, é que no mundo real não existem goblins, mas existem pessoas que agem como tais."',
            '"Em Alta existem magos que destroem cidades e guerreiros que partem montanhas ao meio."',
            '"Antes de Alta ascender, ela era uma criança como qualquer outra."',
            '"Resolver um problema com diplomacia também dá XP, e às vezes até mais do que na base da violência."',
            '"Porque será que tem uma mancha de sangue na frente desse baú?"',
            '"Alta Fantasia é balanceado através da força."',
            '"Uma noite tão calminha no mar, o que poderia dar errado?"',
            '"Uma vez teve um infeliz que tentou domar um dragão com uma cenoura."',
            '"Vocês ouviram? Um forasteiro vestido de preto foi grosseiro com a Capitã Irina! Precisamos fazer algo a respeito!"',
            '"As lendas contam que, no topo da montanha mais alta do mundo, Sagarmāthā, reside a Espada do Herói, sobre a sombra de uma Gegenteil...',
            '"A magia é a linguagem do universo, e o universo não fala com ignorantes. Agora, tentem não se explodirem desta vez." — Hayla, a Arquimaga Eterna"',
            '"O primeiro personagem de Alta Fantasia foi um Bardo, que o jogador era Gaúcho! Assim como o Gado, seu criador!"',
            '"O primeiro mago de Alta Fantasia se chamava Taskir, o gnomo, e sua banda de rock favorita era o Nirvana. Ele foi criado pelo Gui!"',
            '"O primeiro clérigo de Alta Fantasia era chamado Cassian De Montverre Bastratti, e ele era um tanto, digamos... excêntrico."',
            '"O primeiro ninja de Alta Fantasia era um humano, de 2m+ de altura, chamado Tekomo (kkkk), sim, ele era Japonês! Ele foi criado pelo Joaobachi!"',
            '"O primeiro samurai de Alta Fantasia e segundo personagem criado foi o Jeff, o Herói de Sagarmāthā... Ele foi criado pelo Ike!"',
            '"Existiam, na Era das Cinzas, 3 poderosas bruxas, uma delas era Sagarmāthā, a Bruxa do Destino, que criou a profecia da Espada do Herói."',
            '"Taskir foi o primeiro avatar a morrer em Alta Fantasia, e, seu controlador Peter que vivia na Terra foi o primeiro a se libertar."',
            '"Veja mais sobre a campanha oficial de Alta Fantasia em: https://alta-fantasia.ct.ws/campanhas_oficiais.php!"',

        ];

        const mensagemEl = document.getElementById('mensagem');
        if (!mensagemEl) return;

        // Embaralha
        mensagens.sort(() => Math.random() - 0.5);

        let index = 0;
        mensagemEl.innerHTML = `<em>${mensagens[index]}</em>`;
        mensagemEl.style.opacity = 1;

        setInterval(() => {
            mensagemEl.style.opacity = 0;
            setTimeout(() => {
                index = (index + 1) % mensagens.length;
                mensagemEl.innerHTML = `<em>${mensagens[index]}</em>`;
                mensagemEl.style.opacity = 1;
            }, 500);
        }, 5000);
    }

    // ==========================================
    // 6. EVENTOS DE SUB-ITENS (MAGIAS, ITENS, HABILIDADES E CLASSES)
    // ==========================================

    function configurarEventosSubItens() {

        // --- GERENCIAMENTO DE CLASSES ---
        $(document).on('click', '#add-classe-btn', function () {
            const classes = TPL.getClassesFromForm();
            classes.push({ nome: '', nivel: 1 });
            TPL.renderizarClasses(classes);
        });

        $(document).on('click', '.remove-classe-btn', function () {
            const classes = TPL.getClassesFromForm();
            const index = $(this).closest('.classe-item').data('index');
            classes.splice(index, 1);
            TPL.renderizarClasses(classes);
        });

        // Atualizar Peso ao mudar Item Dinamicamente
        $(document).on('change', '.item-peso, .item-quantidade, .item-inventario_interno, .item-equipado, .item-ignorar-peso', function () {
            if (typeof Calc.atualizarPesoTotal === 'function') Calc.atualizarPesoTotal();
        });


        // --- HABILIDADES ---

        $(document).on('click', '#salvar-habilidade-nova', function () {
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('acao', 'criar');
            formData.append('nome', $('#habilidade-nome').val());
            formData.append('requisitos', $('#habilidade-requisitos').val());
            formData.append('descricao-habilidade', $('#habilidade-descricao').val());

            API.salvarHabilidade(formData).done(res => {
                if (res.status === 'sucesso') {
                    $('#habilidade-nome, #habilidade-requisitos, #habilidade-descricao').val('');
                    recarregarSubListas(estado.fichaIdAtual);
                }
            });
        });

        $(document).on('click', '.salvar-habilidade', function () {
            const id = $(this).data('id');
            const card = $(this).closest('.card-body');
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('id_habilidade', id);
            formData.append('acao', 'editar');
            formData.append('nome', card.find('input').eq(0).val());
            formData.append('requisitos', card.find('input').eq(1).val());
            formData.append('descricao-habilidade', card.find('textarea').val());

            API.salvarHabilidade(formData).done(res => {
                if (res.status === 'sucesso') Swal.fire({ icon: 'success', title: 'Habilidade Salva!', timer: 700, showConfirmButton: false });
            });
        });

        $(document).on('click', '.excluir-habilidade', function () {
            if (!confirm('Deseja excluir esta habilidade?')) return;
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('id_habilidade', $(this).data('id'));
            formData.append('acao', 'excluir');

            API.salvarHabilidade(formData).done(res => {
                if (res.status === 'sucesso') recarregarSubListas(estado.fichaIdAtual);
            });
        });


        // --- MAGIAS ---

        $(document).on('click', '#salvar-magia-nova', function () {
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('acao', 'criar');
            formData.append('nome_magia', $('#magia-nome').val());
            formData.append('tipo_magia', $('#magia-tipo').val());
            formData.append('nivel', $('#magia-nivel').val());
            formData.append('custo_pm', $('#magia-custo').val());
            formData.append('alcance', $('#magia-alcance').val());
            formData.append('duracao', $('#magia-duracao').val());
            formData.append('descritor', $('#magia-descritor').val());
            formData.append('descricao-magia', $('#magia-descricao').val());

            API.salvarMagia(formData).done(res => {
                if (res.status === 'sucesso') {
                    $('#collapseMagia input, #collapseMagia textarea').val('');
                    recarregarSubListas(estado.fichaIdAtual);
                }
            });
        });

        $(document).on('click', '.salvar-magia', function () {
            const id = $(this).data('id');
            const card = $(this).closest('.card-body');
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('id_magia', id);
            formData.append('acao', 'editar');
            formData.append('nome_magia', card.find('.nome-magia').val());
            formData.append('tipo_magia', card.find('.tipo-magia').val());
            formData.append('nivel', card.find('.nivel-magia').val());
            formData.append('custo_pm', card.find('.custo-magia').val());
            formData.append('alcance', card.find('.alcance-magia').val());
            formData.append('duracao', card.find('.duracao-magia').val());
            formData.append('descritor', card.find('.descritor-magia').val());
            formData.append('descricao-magia', card.find('.descricao-magia').val());

            API.salvarMagia(formData).done(res => {
                if (res.status === 'sucesso') Swal.fire({ icon: 'success', title: 'Magia Salva!', timer: 700, showConfirmButton: false });
            });
        });

        $(document).on('click', '.excluir-magia', function () {
            if (!confirm('Deseja excluir esta magia?')) return;
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('id_magia', $(this).data('id'));
            formData.append('acao', 'excluir');

            API.salvarMagia(formData).done(res => {
                if (res.status === 'sucesso') recarregarSubListas(estado.fichaIdAtual);
            });
        });


        // --- ITENS ---

        $(document).on('click', '#salvar-item-novo', function () {
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('acao', 'criar');
            formData.append('nome', $('#item-nome').val());
            formData.append('rank', $('#item-rank').val());
            formData.append('quantidade', $('#item-quantidade').val());
            formData.append('peso', $('#item-peso').val());
            formData.append('conjunto', $('#item-conjunto').val());
            formData.append('ignorar_peso', $('#item-ignorar-peso').val());
            formData.append('volume', $('#item-volume').val());
            formData.append('equipado', $('#item-equipado').val());
            formData.append('inventario_interno', $('#item-inventario-interno').val());
            formData.append('estado', $('#item-estado').val());
            formData.append('descricao-item-novo', $('#item-descricao').val());

            API.salvarItem(formData).done(res => {
                if (res.status === 'sucesso') {
                    $('#collapseItem input, #collapseItem textarea, #collapseItem select').val('');
                    recarregarSubListas(estado.fichaIdAtual);
                    if (typeof Calc.atualizarPesoTotal === 'function') Calc.atualizarPesoTotal();
                }
            });
        });

        $(document).on('click', '.salvar-item', function () {
            const id = $(this).data('id');
            const card = $(this).closest('.card-body');
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('id_item', id);
            formData.append('acao', 'editar');
            formData.append('nome', card.find('.item-nome').val());
            formData.append('rank', card.find('.item-rank').val());
            formData.append('quantidade', card.find('.item-quantidade').val());
            formData.append('peso', card.find('.item-peso').val());
            formData.append('conjunto', card.find('.item-conjunto').val());
            formData.append('ignorar_peso', card.find('.item-ignorar-peso').val());
            formData.append('volume', card.find('.item-volume').val());
            formData.append('equipado', card.find('.item-equipado').val());
            formData.append('inventario_interno', card.find('.item-inventario_interno').val());
            formData.append('estado', card.find('.item-estado').val());
            formData.append('descricao-item-novo', card.find('.item-descricao').val());

            API.salvarItem(formData).done(res => {
                if (res.status === 'sucesso') {
                    Swal.fire({ icon: 'success', title: 'Item Salvo!', timer: 700, showConfirmButton: false });
                    if (typeof Calc.atualizarPesoTotal === 'function') Calc.atualizarPesoTotal();
                }
            });
        });

        $(document).on('click', '.excluir-item', function () {
            if (!confirm('Deseja excluir este item?')) return;
            const formData = new FormData();
            formData.append('id_ficha', estado.fichaIdAtual);
            formData.append('id_item', $(this).data('id'));
            formData.append('acao', 'excluir');

            API.salvarItem(formData).done(res => {
                if (res.status === 'sucesso') {
                    recarregarSubListas(estado.fichaIdAtual);
                    if (typeof Calc.atualizarPesoTotal === 'function') Calc.atualizarPesoTotal();
                }
            });
        });
    }
});