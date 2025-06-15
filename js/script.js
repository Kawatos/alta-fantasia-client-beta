
let modoEdicao = false;

document.addEventListener("DOMContentLoaded", function () {
    const modalFicha = new bootstrap.Modal(document.getElementById('modalFicha'));
    const form = document.getElementById('formFicha');
    const botaoSalvar = document.getElementById('botao-salvar');


    // Botão para abrir em modo CRIAÇÃO
    document.querySelector('#botaoCriarFicha').addEventListener('click', function () {
        fetch('backend/criar_ficha.php', {
            method: 'POST', // ou 'GET' se você quiser, mas POST é melhor por segurança.
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    alert('Ficha criada com sucesso!');
                    location.reload(); // ou atualizar só o DOM necessário
                } else {
                    alert(data.mensagem || 'Erro ao criar ficha.');
                }
            })
            .catch(erro => {
                alert('Erro na requisição: ' + erro);
            });
    });

    function getDadosFicha(fichaId) {
        $.ajax({
            url: 'backend/get_dados_ficha.php',
            method: 'POST',
            data: {
                id_ficha: fichaId
            },
            dataType: 'json',
            success: function (resposta) {
                if (resposta.status === 'sucesso') {
                    const ficha = resposta.ficha;
                    const atributos = resposta.atributos;
                    const pericias = resposta.pericias;

                    console.log(pericias);
                    console.log(ficha);
                    console.log(atributos);
                    document.querySelector('#ficha-id').value = ficha.id;
                    document.querySelector('.nome-personagem').value = ficha.nome_personagem;
                    document.querySelector('.nome-personagem-exibicao').textContent = ficha.nome_personagem;

                    document.querySelector('.classe-personagem').value = ficha.classe;
                    document.querySelector('.nivel-personagem').value = ficha.nivel;
                    document.querySelector('.raca-personagem').value = ficha.raca;
                    document.querySelector('.descricao-personagem').value = ficha.descricao;

                    document.querySelector('.pontos-de-vida-personagem').value = ficha.pontos_de_vida;
                    document.querySelector('.pontos-de-mana-personagem').value = ficha.pontos_de_mana;
                    document.querySelector('.status-personagem').value = ficha.status_personagem;
                    document.querySelector('.pvs_atuais-personagem').value = ficha.pvs_atuais;
                    document.querySelector('.pms_atuais-personagem').value = ficha.pms_atuais;
                    document.querySelector('.deslocamento-personagem').value = ficha.deslocamento;
                    document.querySelector('.regen_pv-personagem').value = ficha.regen_pv;
                    document.querySelector('.regen_pm-personagem').value = ficha.regen_pm;
                    document.querySelector('.observacoes_atributos-personagem').value = ficha.observacoes_atributos;
                    document.querySelector('.observacoes_pericias-personagem').value = ficha.observacoes_pericias;
                    document.querySelector('.observacoes_habilidades-personagem').value = ficha.observacoes_habilidades;
                    document.querySelector('.observacoes_magias_arcanas-personagem').value = ficha.observacoes_magias_arcanas;
                    document.querySelector('.observacoes_magias_divinas-personagem').value = ficha.observacoes_magias_divinas;
                    document.querySelector('.observacoes_itens-personagem').value = ficha.observacoes_itens;
                    document.querySelector('.observacoes_jogador-personagem').value = ficha.observacoes_jogador;
                    document.querySelector('.divindade-personagem').value = ficha.divindade;
                    document.querySelector('.escola_arcana-personagem').value = ficha.escola_arcana;
                    document.querySelector('.idiomas-personagem').value = ficha.idiomas;
                    document.querySelector('.carga_suportada_mod-personagem').value = ficha.carga_suportada_mod;
                    document.querySelector('.inventario_interno_mod-personagem').value = ficha.inventario_interno_mod;


                    // Atributos

                    document.querySelector('.vigor_mod').value = atributos.vigor_mod;
                    document.querySelector('.forca_mod').value = atributos.forca_mod;
                    document.querySelector('.destreza_mod').value = atributos.destreza_mod;
                    document.querySelector('.espirito_mod').value = atributos.espirito_mod;
                    document.querySelector('.carisma_mod').value = atributos.carisma_mod;
                    document.querySelector('.intelecto_mod').value = atributos.intelecto_mod;

                    document.querySelector('.vigor_mod_nv').value = atributos.vigor_mod_nv;
                    document.querySelector('.forca_mod_nv').value = atributos.forca_mod_nv;
                    document.querySelector('.destreza_mod_nv').value = atributos.destreza_mod_nv;
                    document.querySelector('.espirito_mod_nv').value = atributos.espirito_mod_nv;
                    document.querySelector('.carisma_mod_nv').value = atributos.carisma_mod_nv;
                    document.querySelector('.intelecto_mod_nv').value = atributos.intelecto_mod_nv;

                    // Pericias
                    document.querySelector('.tenacidade_mod').value = pericias.tenacidade_mod;
                    document.querySelector('.fortitude_mod').value = pericias.fortitude_mod;
                    document.querySelector('.reflexo_mod').value = pericias.reflexo_mod;
                    document.querySelector('.controle_mod').value = pericias.controle_mod;
                    document.querySelector('.atletismo_mod').value = pericias.atletismo_mod;
                    document.querySelector('.corpoacorpo_mod').value = pericias.corpoacorpo_mod;
                    document.querySelector('.autocontrole_mod').value = pericias.autocontrole_mod;
                    document.querySelector('.resiliencia_mod').value = pericias.resiliencia_mod;
                    document.querySelector('.intuicao_mod').value = pericias.intuicao_mod;
                    document.querySelector('.percepcao_mod').value = pericias.percepcao_mod;
                    document.querySelector('.influencia_mod').value = pericias.influencia_mod;
                    document.querySelector('.atuacao_mod').value = pericias.atuacao_mod;
                    document.querySelector('.c_arcano_mod').value = pericias.c_arcano_mod;
                    document.querySelector('.c_religioso_mod').value = pericias.c_religioso_mod;
                    document.querySelector('.c_historico_mod').value = pericias.c_historico_mod;
                    document.querySelector('.c_natureza_mod').value = pericias.c_natureza_mod;
                    document.querySelector('.c_engenharia_mod').value = pericias.c_engenharia_mod;
                    document.querySelector('.c_alquimia_mod').value = pericias.c_alquimia_mod;
                    document.querySelector('.c_navegacao_mod').value = pericias.c_navegacao_mod;
                    document.querySelector('.c_linguistico_mod').value = pericias.c_linguistico_mod;
                    document.querySelector('.t_esgrima_mod').value = pericias.t_esgrima_mod;
                    document.querySelector('.t_pontaria_mod').value = pericias.t_pontaria_mod;
                    document.querySelector('.t_marcial_mod').value = pericias.t_marcial_mod;
                    document.querySelector('.t_metalurgia_mod').value = pericias.t_metalurgia_mod;
                    document.querySelector('.t_artesanato_mod').value = pericias.t_artesanato_mod;
                    document.querySelector('.t_ladinagem_mod').value = pericias.t_ladinagem_mod;
                    document.querySelector('.t_instrumentos_mod').value = pericias.t_instrumentos_mod;
                    document.querySelector('.t_pilotagem_mod').value = pericias.t_pilotagem_mod;

                    // Treinamentos
                    document.querySelector('.tenacidade_treinamentos').value = pericias.tenacidade_treinamentos;
                    document.querySelector('.fortitude_treinamentos').value = pericias.fortitude_treinamentos;
                    document.querySelector('.reflexo_treinamentos').value = pericias.reflexo_treinamentos;
                    document.querySelector('.controle_treinamentos').value = pericias.controle_treinamentos;
                    document.querySelector('.atletismo_treinamentos').value = pericias.atletismo_treinamentos;
                    document.querySelector('.corpoacorpo_treinamentos').value = pericias.corpoacorpo_treinamentos;
                    document.querySelector('.autocontrole_treinamentos').value = pericias.autocontrole_treinamentos;
                    document.querySelector('.resiliencia_treinamentos').value = pericias.resiliencia_treinamentos;
                    document.querySelector('.intuicao_treinamentos').value = pericias.intuicao_treinamentos;
                    document.querySelector('.percepcao_treinamentos').value = pericias.percepcao_treinamentos;
                    document.querySelector('.influencia_treinamentos').value = pericias.influencia_treinamentos;
                    document.querySelector('.atuacao_treinamentos').value = pericias.atuacao_treinamentos;
                    document.querySelector('.c_arcano_treinamentos').value = pericias.c_arcano_treinamentos;
                    document.querySelector('.c_religioso_treinamentos').value = pericias.c_religioso_treinamentos;
                    document.querySelector('.c_historico_treinamentos').value = pericias.c_historico_treinamentos;
                    document.querySelector('.c_natureza_treinamentos').value = pericias.c_natureza_treinamentos;
                    document.querySelector('.c_engenharia_treinamentos').value = pericias.c_engenharia_treinamentos;
                    document.querySelector('.c_alquimia_treinamentos').value = pericias.c_alquimia_treinamentos;
                    document.querySelector('.c_navegacao_treinamentos').value = pericias.c_navegacao_treinamentos;
                    document.querySelector('.c_linguistico_treinamentos').value = pericias.c_linguistico_treinamentos;
                    document.querySelector('.t_esgrima_treinamentos').value = pericias.t_esgrima_treinamentos;
                    document.querySelector('.t_pontaria_treinamentos').value = pericias.t_pontaria_treinamentos;
                    document.querySelector('.t_marcial_treinamentos').value = pericias.t_marcial_treinamentos;
                    document.querySelector('.t_metalurgia_treinamentos').value = pericias.t_metalurgia_treinamentos;
                    document.querySelector('.t_artesanato_treinamentos').value = pericias.t_artesanato_treinamentos;
                    document.querySelector('.t_ladinagem_treinamentos').value = pericias.t_ladinagem_treinamentos;
                    document.querySelector('.t_instrumentos_treinamentos').value = pericias.t_instrumentos_treinamentos;
                    document.querySelector('.t_pilotagem_treinamentos').value = pericias.t_pilotagem_treinamentos;

                    // Proficiências
                    document.querySelector('.tenacidade_proeficiencias').value = pericias.tenacidade_proeficiencias;
                    document.querySelector('.fortitude_proeficiencias').value = pericias.fortitude_proeficiencias;
                    document.querySelector('.reflexo_proeficiencias').value = pericias.reflexo_proeficiencias;
                    document.querySelector('.controle_proeficiencias').value = pericias.controle_proeficiencias;
                    document.querySelector('.atletismo_proeficiencias').value = pericias.atletismo_proeficiencias;
                    document.querySelector('.corpoacorpo_proeficiencias').value = pericias.corpoacorpo_proeficiencias;
                    document.querySelector('.autocontrole_proeficiencias').value = pericias.autocontrole_proeficiencias;
                    document.querySelector('.resiliencia_proeficiencias').value = pericias.resiliencia_proeficiencias;
                    document.querySelector('.intuicao_proeficiencias').value = pericias.intuicao_proeficiencias;
                    document.querySelector('.percepcao_proeficiencias').value = pericias.percepcao_proeficiencias;
                    document.querySelector('.influencia_proeficiencias').value = pericias.influencia_proeficiencias;
                    document.querySelector('.atuacao_proeficiencias').value = pericias.atuacao_proeficiencias;
                    document.querySelector('.c_arcano_proeficiencias').value = pericias.c_arcano_proeficiencias;
                    document.querySelector('.c_religioso_proeficiencias').value = pericias.c_religioso_proeficiencias;
                    document.querySelector('.c_historico_proeficiencias').value = pericias.c_historico_proeficiencias;
                    document.querySelector('.c_natureza_proeficiencias').value = pericias.c_natureza_proeficiencias;
                    document.querySelector('.c_engenharia_proeficiencias').value = pericias.c_engenharia_proeficiencias;
                    document.querySelector('.c_alquimia_proeficiencias').value = pericias.c_alquimia_proeficiencias;
                    document.querySelector('.c_navegacao_proeficiencias').value = pericias.c_navegacao_proeficiencias;
                    document.querySelector('.c_linguistico_proeficiencias').value = pericias.c_linguistico_proeficiencias;
                    document.querySelector('.t_esgrima_proeficiencias').value = pericias.t_esgrima_proeficiencias;
                    document.querySelector('.t_pontaria_proeficiencias').value = pericias.t_pontaria_proeficiencias;
                    document.querySelector('.t_marcial_proeficiencias').value = pericias.t_marcial_proeficiencias;
                    document.querySelector('.t_metalurgia_proeficiencias').value = pericias.t_metalurgia_proeficiencias;
                    document.querySelector('.t_artesanato_proeficiencias').value = pericias.t_artesanato_proeficiencias;
                    document.querySelector('.t_ladinagem_proeficiencias').value = pericias.t_ladinagem_proeficiencias;
                    document.querySelector('.t_instrumentos_proeficiencias').value = pericias.t_instrumentos_proeficiencias;
                    document.querySelector('.t_pilotagem_proeficiencias').value = pericias.t_pilotagem_proeficiencias;



                    getHabilidades();
                    getMagias();
                    getItens();




                    modalFicha.show();

                } else {
                    alert(resposta.mensagem);
                }
            },
            error: function () {
                alert('Erro ao buscar a ficha.');
            }
        });
    }


    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function () {
            modoEdicao = true;

            fichaId = this.dataset.id;

            getDadosFicha(fichaId);

        });



    });



    // Enviar formulário
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const url = 'backend/editar_ficha_ajax.php';

        fetch(url, {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    alert('Ficha atualizada com sucesso! 3');
                    getDadosFicha(fichaId);
                } else {
                    alert(data.mensagem || 'Erro ao salvar');
                }
            });
    });

    document.getElementById("salvar-habilidade-nova").addEventListener("click", () => controleHabilidade('criar'));
    document.getElementById("salvar-magia-nova").addEventListener("click", () => controleMagia('criar'));
    document.getElementById("salvar-item-novo").addEventListener("click", () => controleItem('criar'));

    function ativarBotoesHabilidades() {
        // Botão de salvar (edição)
        document.querySelectorAll('.salvar-habilidade').forEach(botao => {
            botao.addEventListener('click', () => {
                const id = botao.dataset.id;
                const card = botao.closest('.card-body');

                const nome = card.querySelector('input[type="text"]').value;
                const requisitos = card.querySelectorAll('input[type="text"]')[1].value;
                const descricao = card.querySelector('textarea').value;

                const formData = new FormData();
                formData.append('acao', 'editar');
                formData.append('id_habilidade', id);
                formData.append('nome', nome);
                formData.append('requisitos', requisitos);
                formData.append('descricao', descricao);
                formData.append('id_ficha', fichaId);

                fetch('backend/habilidades/controle_habilidades.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(data => {
                        if (data.status === 'sucesso') {
                            alert('Habilidade atualizada com sucesso!');
                            getHabilidades();
                        } else {
                            alert(data.mensagem || 'Erro ao atualizar habilidade');
                        }
                    });
            });
        });

        // Botão de excluir
        document.querySelectorAll('.excluir-habilidade').forEach(botao => {
            botao.addEventListener('click', () => {
                const id = botao.dataset.id;
                if (!confirm('Tem certeza que deseja excluir esta habilidade?')) return;

                const formData = new FormData();
                formData.append('acao', 'excluir');
                formData.append('id_habilidade', id);
                formData.append('id_ficha', fichaId);

                fetch('backend/habilidades/controle_habilidades.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(data => {
                        if (data.status === 'sucesso') {
                            alert('Habilidade excluída com sucesso!');
                            getHabilidades();
                        } else {
                            alert(data.mensagem || 'Erro ao excluir habilidade');
                        }
                    });
            });
        });
    }


    // Criar Habilidade

    function controleHabilidade(acao) {
        const habilidadeNome = document.getElementById('habilidade-nome').value;
        const habilidadeRequisitos = document.getElementById('habilidade-requisitos').value;
        const habilidadeDescricao = document.getElementById('habilidade-descricao').value;


        console.log(habilidadeNome);
        console.log(habilidadeRequisitos);
        console.log(habilidadeDescricao);
        console.log(fichaId, "dentro de criar habilidade");

        const formData = new FormData();
        formData.append('id_ficha', fichaId);
        formData.append('nome', habilidadeNome);
        formData.append('requisitos', habilidadeRequisitos);
        formData.append('descricao', habilidadeDescricao);
        formData.append('acao', acao);

        fetch('backend/habilidades/controle_habilidades.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    alert('Habilidade criada com sucesso!');
                    getHabilidades();
                } else {
                    console.error('Erro:', data);
                    alert(data.mensagem || 'Erro ao salvar');
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Erro ao enviar os dados');
            });
    }

    function getHabilidades() {
        const habilidadesContainer = document.querySelector('#habilidadesContainer');
        habilidadesContainer.innerHTML = '';

        const formData = new FormData();
        formData.append('id_ficha', fichaId);

        fetch('backend/habilidades/get_habilidades.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                try {
                    if (data.status === 'sucesso') {
                        data.habilidades.forEach((hab, index) => {
                            const card = document.createElement('div');
                            card.className = 'card mb-2';

                            card.innerHTML = `
                            <div class="card-header" role="button" data-bs-toggle="collapse" data-bs-target="#habilidade${hab.id_habilidade}">
                                <strong>${hab.nome}</strong>
                            </div>
                            <div class="collapse" id="habilidade${hab.id_habilidade}">
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nome:</label>
                                        <input type="text" class="form-control" value="${hab.nome}" data-id="${hab.id_habilidade}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Requisitos:</label>
                                        <input type="text" class="form-control" value="${hab.requisitos}" data-id="${hab.id_habilidade}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Descrição:</label>
                                        <textarea class="form-control" rows="3" data-id="${hab.id_habilidade}">${hab.descricao}</textarea>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-primary btn-sm me-2 salvar-habilidade" data-id="${hab.id_habilidade}">Salvar</button>
                                        <button class="btn btn-danger btn-sm excluir-habilidade" data-id="${hab.id_habilidade}">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        `;

                            habilidadesContainer.appendChild(card);
                        });
                        ativarBotoesHabilidades();

                    } else {
                        habilidadesContainer.innerHTML = 'Nenhuma habilidade encontrada.';
                    }

                } catch (err) {
                    console.error('Erro ao processar habilidades:', err);
                    habilidadesContainer.innerHTML = 'Erro ao renderizar habilidades.';
                }
            })

    }

    function ativarBotoesMagias() {
        // Event listener para salvar
        document.querySelectorAll('.salvar-magia').forEach(botao => {
            botao.onclick = () => {
                const id = botao.dataset.id;
                const nome = document.querySelector(`.nome-magia[data-id="${id}"]`)?.value;
                const tipo = document.querySelector(`.tipo-magia[data-id="${id}"]`)?.value;
                const nivel = document.querySelector(`.nivel-magia[data-id="${id}"]`)?.value;
                const custo = document.querySelector(`.custo-magia[data-id="${id}"]`)?.value;
                const alcance = document.querySelector(`.alcance-magia[data-id="${id}"]`)?.value;
                const duracao = document.querySelector(`.duracao-magia[data-id="${id}"]`)?.value;
                const descritor = document.querySelector(`.descritor-magia[data-id="${id}"]`)?.value;
                const descricao = document.querySelector(`.descricao-magia[data-id="${id}"]`)?.value;

                const formData = new FormData();
                formData.append('id_magia', id);
                formData.append('id_ficha', fichaId);
                formData.append('nome_magia', nome);
                formData.append('tipo_magia', tipo);
                formData.append('nivel', nivel);
                formData.append('custo_pm', custo);
                formData.append('alcance', alcance);
                formData.append('duracao', duracao);
                formData.append('descritor', descritor);
                formData.append('descricao', descricao);
                formData.append('acao', 'editar');

                fetch('backend/magias/controle_magias.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(data => {
                        if (data.status === 'sucesso') {
                            alert('Magia salva com sucesso!');
                            /* getMagias(); */
                        } else {
                            alert('Erro ao salvar magia.');
                        }
                    });
            };
        });

        // Event listener para excluir
        document.querySelectorAll('.excluir-magia').forEach(botao => {
            botao.onclick = () => {
                const id = botao.dataset.id;

                if (!confirm("Tem certeza que deseja excluir esta magia?")) return;

                const formData = new FormData();
                formData.append('id_magia', id);
                formData.append('id_ficha', fichaId);
                formData.append('acao', 'excluir');

                fetch('backend/magias/controle_magias.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(data => {
                        if (data.status === 'sucesso') {
                            alert('Magia excluída com sucesso!');
                            getMagias();
                        } else {
                            alert('Erro ao excluir magia.');
                        }
                    });
            };
        });
    }



    function controleMagia(acao) {
        const magiaNome = document.getElementById('magia-nome').value;
        const magiaTipo = document.getElementById('magia-tipo').value;
        const magiaNivel = document.getElementById('magia-nivel').value;
        const magiaCusto = document.getElementById('magia-custo').value;
        const magiaAlcance = document.getElementById('magia-alcance').value;
        const magiaDuracao = document.getElementById('magia-duracao').value;
        const magiaDescritor = document.getElementById('magia-descritor').value;
        const magiaDescricao = document.getElementById('magia-descricao').value;

        console.log(magiaNome, magiaTipo, magiaNivel, magiaCusto, magiaAlcance, magiaDuracao, magiaDescritor, magiaDescricao);
        console.log(fichaId, "dentro de controleMagia");

        const formData = new FormData();
        formData.append('id_ficha', fichaId);
        formData.append('nome_magia', magiaNome);
        formData.append('tipo_magia', magiaTipo);
        formData.append('nivel', magiaNivel);
        formData.append('custo_pm', magiaCusto);
        formData.append('alcance', magiaAlcance);
        formData.append('duracao', magiaDuracao);
        formData.append('descritor', magiaDescritor);
        formData.append('descricao', magiaDescricao);
        formData.append('acao', acao);

        fetch('backend/magias/controle_magias.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    alert('Magia salva com sucesso!');
                    getMagias(); // Certifique-se que essa função exista
                } else {
                    console.error('Erro:', data);
                    alert(data.mensagem || 'Erro ao salvar magia');
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Erro ao enviar os dados');
            });
    }

    function getMagias() {
        const containerArcana = document.querySelector('#magias-arcanas');
        const containerDivina = document.querySelector('#magias-divinas');
        containerArcana.innerHTML = '';
        containerDivina.innerHTML = '';

        const formData = new FormData();
        formData.append('id_ficha', fichaId);

        fetch('backend/magias/get_magias.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    data.magias.forEach(magia => {
                        const card = document.createElement('div');
                        card.className = 'card mb-2';

                        card.innerHTML = `
                            <div class="card-header" role="button" data-bs-toggle="collapse" data-bs-target="#magia${magia.id_magias}">
                                <strong>${magia.nome_magia}</strong>
                            </div>
                            <div class="collapse" id="magia${magia.id_magias}">
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nome:</label>
                                            <input type="text" class="form-control nome-magia" value="${magia.nome_magia}" data-id="${magia.id_magias}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tipo:</label>
                                            <select class="form-select tipo-magia" data-id="${magia.id_magias}">
                                                <option value="arcana" ${magia.tipo_magia === 'arcana' ? 'selected' : ''}>Arcana</option>
                                                <option value="divina" ${magia.tipo_magia === 'divina' ? 'selected' : ''}>Divina</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nível:</label>
                                            <input type="number" class="form-control nivel-magia" value="${magia.nivel}" data-id="${magia.id_magias}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Custo (PM):</label>
                                            <input type="number" class="form-control custo-magia" value="${magia.custo_pm}" data-id="${magia.id_magias}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Alcance:</label>
                                            <input type="text" class="form-control alcance-magia" value="${magia.alcance}" data-id="${magia.id_magias}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Duração:</label>
                                            <input type="text" class="form-control duracao-magia" value="${magia.duracao}" data-id="${magia.id_magias}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Descritor:</label>
                                            <input type="text" class="form-control descritor-magia" value="${magia.descritor}" data-id="${magia.id_magias}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Descrição:</label>
                                            <textarea class="form-control descricao-magia" rows="3" data-id="${magia.id_magias}">${magia.descricao}</textarea>
                                        </div>
                                        <div class="col-12 text-end mt-3">
                                            <button class="btn btn-primary btn-sm me-2 salvar-magia" data-id="${magia.id_magias}">Salvar</button>
                                            <button class="btn btn-danger btn-sm excluir-magia" data-id="${magia.id_magias}">Excluir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;


                        if (magia.tipo_magia == 'arcana') {
                            containerArcana.appendChild(card);
                        } else {
                            containerDivina.appendChild(card);
                        }
                    });

                    ativarBotoesMagias();

                } else {
                    containerArcana.innerHTML = 'Nenhuma magia arcana encontrada.';
                    containerDivina.innerHTML = 'Nenhuma magia divina encontrada.';
                }
            })
            .catch(err => {
                console.error('Erro ao processar magias:', err);
                containerArcana.innerHTML = 'Erro ao renderizar magias.';
                containerDivina.innerHTML = 'Erro ao renderizar magias.';
            });
    }

    function ativarBotoesItens() {
        // Botão de salvar (edição)
        document.querySelectorAll('.salvar-item').forEach(botao => {
            botao.addEventListener('click', () => {
                const id = botao.dataset.id;
                const card = botao.closest('.card-body');

                const nome = card.querySelectorAll('input[type="text"]')[0].value;
                const rank = card.querySelector('input[type="number"]').value;
                const peso = card.querySelectorAll('input[type="number"]')[1].value;
                const volume = card.querySelectorAll('input[type="text"]')[1].value;
                const equipado = card.querySelector('select').value;
                const inventario_interno = card.querySelectorAll('select')[1].value;
                const descricao = card.querySelector('textarea').value;

                const formData = new FormData();
                formData.append('acao', 'editar');
                formData.append('id_item', id);
                formData.append('id_ficha', fichaId);
                formData.append('nome', nome);
                formData.append('rank', rank);
                formData.append('peso', peso);
                formData.append('volume', volume);
                formData.append('equipado', equipado);
                formData.append('inventario_interno', inventario_interno);
                formData.append('descricao', descricao);

                fetch('backend/itens/controle_itens.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(data => {
                        if (data.status === 'sucesso') {
                            alert('Item atualizado com sucesso!');
                            getItens();
                        } else {
                            alert(data.mensagem || 'Erro ao atualizar item');
                        }
                    });
            });
        });

        // Botão de excluir
        document.querySelectorAll('.excluir-item').forEach(botao => {
            botao.addEventListener('click', () => {
                const id = botao.dataset.id;
                if (!confirm('Tem certeza que deseja excluir este item?')) return;

                const formData = new FormData();
                formData.append('acao', 'excluir');
                formData.append('id_item', id);
                formData.append('id_ficha', fichaId);

                fetch('backend/itens/controle_itens.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(data => {
                        if (data.status === 'sucesso') {
                            alert('Item excluído com sucesso!');
                            getItens();
                        } else {
                            alert(data.mensagem || 'Erro ao excluir item');
                        }
                    });
            });
        });

        configurarListenersDeItens();
    }


    // Criar Item

    function controleItem(acao) {
        const itemNome = document.getElementById('item-nome').value;
        const itemRank = document.getElementById('item-rank').value;
        const itemDescricao = document.getElementById('item-descricao').value;
        const itemPeso = document.getElementById('item-peso').value;
        const itemVolume = document.getElementById('item-volume').value;
        const itemEquipado = document.getElementById('item-equipado').value;
        const itemInventarioInterno = document.getElementById('item-inventario-interno').value;

        console.log(itemNome, itemRank, itemDescricao, itemPeso, itemVolume, itemEquipado);
        console.log(fichaId, "dentro de criar item");

        const formData = new FormData();
        formData.append('id_ficha', fichaId);
        formData.append('nome', itemNome);
        formData.append('rank', itemRank);
        formData.append('descricao', itemDescricao);
        formData.append('peso', itemPeso);
        formData.append('volume', itemVolume);
        formData.append('equipado', itemEquipado);
        formData.append('inventario_interno', itemInventarioInterno);

        formData.append('acao', acao);

        fetch('backend/itens/controle_itens.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    alert('Item criado com sucesso!');
                    getItens(); // Função que você deverá criar para recarregar os itens na tela
                } else {
                    console.error('Erro:', data);
                    alert(data.mensagem || 'Erro ao salvar');
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Erro ao enviar os dados');
            });
    }


    function getItens() {
        const itensContainer = document.querySelector('#itensContainer');
        itensContainer.innerHTML = '';

        const formData = new FormData();
        formData.append('id_ficha', fichaId);

        fetch('backend/itens/get_itens.php', {
            method: 'POST',
            body: formData
        })
            .then(resp => resp.json())
            .then(data => {
                try {
                    if (data.status === 'sucesso') {
                        data.itens.forEach((item) => {
                            const card = document.createElement('div');
                            card.className = 'card mb-2';

                            card.innerHTML = `
                                <div class="card-header" role="button" data-bs-toggle="collapse" data-bs-target="#item${item.id_item}">
                                    <strong>${item.nome}</strong>
                                </div>
                                <div class="collapse" id="item${item.id_item}">
                                    <div class="card-body p-3">
                                        <div class="row g-3 item-details">
                                            <div class="col-md-6">
                                                <label class="form-label">Nome:</label>
                                                <input type="text" class="form-control" value="${item.nome}" data-id="${item.id_item}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Rank:</label>
                                                <input type="number" class="form-control" value="${item.rank}" data-id="${item.id_item}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Peso (kg):</label>
                                                <input type="number" class="form-control" value="${item.peso}" data-id="${item.id_item}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Volume:</label>
                                                <input type="text" class="form-control" value="${item.volume}" data-id="${item.id_item}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Equipado:</label>
                                                <select class="form-control" data-id="${item.id_item}">
                                                    <option value="">Selecione</option>
                                                    <option value="sim" ${item.equipado === 'sim' ? 'selected' : ''}>Sim</option>
                                                    <option value="nao" ${item.equipado === 'nao' ? 'selected' : ''}>Não</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Inventário Interno:</label>
                                                <select class="form-control" data-id="${item.id_item}">
                                                    <option value="">Selecione</option>
                                                    <option value="sim" ${item.inventario_interno === 'sim' ? 'selected' : ''}>Sim</option>
                                                    <option value="nao" ${item.inventario_interno === 'nao' ? 'selected' : ''}>Não</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Descrição:</label>
                                                <textarea class="form-control" rows="3" data-id="${item.id_item}">${item.descricao}</textarea>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button class="btn btn-primary btn-sm me-2 salvar-item" data-id="${item.id_item}">Salvar</button>
                                                <button class="btn btn-danger btn-sm excluir-item" data-id="${item.id_item}">Excluir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;


                            itensContainer.appendChild(card);
                        });

                        ativarBotoesItens(); // Crie essa função para lidar com edição e exclusão
                    } else {
                        itensContainer.innerHTML = 'Nenhum item encontrado.';
                    }
                } catch (err) {
                    console.error('Erro ao processar itens:', err);
                    itensContainer.innerHTML = 'Erro ao renderizar itens.';
                }
            });

    }




    // Executa ao carregar







});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".excluir-ficha").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            if (confirm("Tem certeza que deseja excluir esta ficha?")) {
                fetch("backend/excluir_ficha.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + encodeURIComponent(id)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.sucesso) {
                            this.closest(".col").remove();
                        } else {
                            alert(data.erro || "Erro ao excluir a ficha.");
                        }
                    });
            }
        });
    });
});

// Quando o modal for fechado, salva automaticamente se estiver no modo de edição
const modalFicha = document.getElementById('modalFicha');

modalFicha.addEventListener('hidden.bs.modal', function () {
    const form = document.getElementById('formFicha');

    // Garante que o formulário existe
    if (!form) return;

    const formData = new FormData(form);
    const url = 'backend/editar_ficha_ajax.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
        .then(resp => resp.json())
        .then(data => {
            if (data.status === 'sucesso') {
                alert('Ficha atualizada com sucesso!');
                location.reload();
            } else {
                alert(data.mensagem || 'Erro ao salvar');
            }
        });
});





function atualizarNivelEBarra() {
    const inputXp = document.getElementById("ficha-xp");
    const spanNivel = document.getElementById("nivel-atual");
    const barraXp = document.getElementById("barra-xp");

    const barraProgressoTotal = document.getElementById("barra-progresso-total");
    const textoProgressoTotal = document.getElementById("progresso-total-texto");

    const xp = parseInt(inputXp.value) || 0;
    const nivel = Math.floor(xp / 100);
    const progresso = xp % 100;

    // Atualiza nível e barra do nível atual
    spanNivel.textContent = nivel;
    barraXp.style.width = `${progresso}%`;
    barraXp.textContent = `${progresso}%`;

    // Atualiza barra de progresso total (máx 100 níveis)
    const totalMaxXp = 100 * 100; // 100 níveis
    const progressoTotal = Math.min(100, ((xp / totalMaxXp) * 100).toFixed(2));
    barraProgressoTotal.style.width = `${progressoTotal}%`;
    barraProgressoTotal.textContent = `${progressoTotal}%`;
    textoProgressoTotal.textContent = `${progressoTotal}%`;
}

function atualizarAtributos() {
    const atributos = ["vigor", "forca", "destreza", "espirito", "carisma", "intelecto"];
    let totalModNivel = 0;
    const nivelAtual = parseInt(document.getElementById("nivel-atual").textContent) || 1;

    atributos.forEach(attr => {
        const modBase = parseInt(document.querySelector(`.${attr}_mod`)?.value) || 0;
        const modNivel = parseInt(document.querySelector(`.${attr}_mod_nv`)?.value) || 0;

        totalModNivel += modNivel;

        const total = modBase + modNivel;
        const inputAtributo = document.querySelector(`.${attr}`);
        const spanAtributo = document.querySelector(`.${attr}-txt`);
        const spanAtrbutoMod = document.querySelector(`.${attr}_mod-txt`);
        const spanAtrbutoModNivel = document.querySelector(`.${attr}_mod_nv-txt`);
        if (inputAtributo) {
            inputAtributo.value = total;
            if (spanAtributo) {
                spanAtributo.textContent = total;
            }
            if (spanAtrbutoMod) {
                spanAtrbutoMod.textContent = modBase;
            }
            if (spanAtrbutoModNivel) {
                spanAtrbutoModNivel.textContent = modNivel;
            }
        }
        calcularPericias();
        verificarLimiteDeCarga()
    });

    // Atualiza total de pontos gastos e nível
    document.getElementById("total-mod-nivel").textContent = totalModNivel;
    document.getElementById("pontos-por-nivel").textContent = nivelAtual;

    // Atualiza total de pontos gastos e nível
    const totalModNivelElement = document.getElementById("total-mod-nivel");
    const pontosPorNivelElement = document.getElementById("pontos-por-nivel");

    // Seleciona o <h5> onde estão os dois <span>
    const h5Container = totalModNivelElement.closest("p");


    // Adiciona ou remove a cor vermelha se exceder os pontos do nível
    if (totalModNivel > nivelAtual) {
        h5Container.style.color = "red";
    } else {
        h5Container.style.color = ""; // volta ao padrão
    }

}

// Adiciona listeners aos campos de modificadores
document.querySelectorAll("input").forEach(input => {
    if (input.name.endsWith("_mod") || input.name.endsWith("_mod_nv")) {
        input.addEventListener("input", atualizarAtributos);
    }
});



const getNivel = () => parseInt(document.getElementById("nivel-atual")?.textContent) || 1;
const getAtributoValor = (atributo) => parseInt(document.querySelector(`.${atributo}`)?.value) || 0;

function calcularPericias() {
    console.log("calculando pericias");
    const nivel = getNivel();
    const escalaNivel = Math.ceil(nivel / 10);
    const pericias = document.querySelectorAll(".pericia");

    pericias.forEach(pericia => {
        const modBase = parseInt(pericia.querySelector(".pericia-mod")?.value) || 0;
        const valorTreinamento = parseInt(pericia.querySelector(".treinado")?.value) || 0;
        const valorProeficiencia = parseInt(pericia.querySelector(".proeficiente")?.value) || 0;
        const atributo = pericia.dataset.atributo;
        const valorAtributo = getAtributoValor(atributo);

        const bonusTreinamento = 2 * escalaNivel * valorTreinamento;
        const bonusProeficiencia = 1 * escalaNivel * valorProeficiencia;

        const resultado = modBase + bonusTreinamento + bonusProeficiencia + valorAtributo;

        // Atualizar valores visuais
        pericia.querySelector(".modbase-valor").textContent = modBase;
        pericia.querySelector(".treinado-valor").textContent = bonusTreinamento;
        pericia.querySelector(".proeficiente-valor").textContent = bonusProeficiencia;
        pericia.querySelector(".atributo-valor").value = valorAtributo;
        pericia.querySelector(".atributotxt-valor").textContent = valorAtributo;
        pericia.querySelector(".pericia-final").textContent = resultado;
    });
}

// Recalcular ao alterar qualquer campo relevante
document.querySelectorAll(".pericia-mod, .treinado, .proeficiente").forEach(el => {
    el.addEventListener("input", calcularPericias);
});

function atualizarPesoTotal() {
    let totalPeso = 0;
    console.log("atualizando peso total");

    console.log(document.querySelectorAll('.item-details').length, "cards de item encontrados");
    // Percorre todos os cards de item
    document.querySelectorAll('.item-details').forEach(details => {
        console.log("calculando peso para card");
        // Pega todos os inputs numéricos (rank e peso)
        const inputsNumericos = details.querySelectorAll('input[type="number"]');
        if (inputsNumericos.length < 2) return;

        const inputPeso = inputsNumericos[1]; // O segundo input é o PESO
        const peso = parseFloat(inputPeso.value) || 0;

        // Pega todos os selects (equipado e inventário interno)
        const selects = details.querySelectorAll('select');
        if (selects.length < 2) return;

        const selectInventarioInterno = selects[1]; // O segundo select é INVENTÁRIO INTERNO
        const inventarioInterno = selectInventarioInterno.value;

        // Soma somente se inventário interno for diferente de "sim"
        if (inventarioInterno !== 'sim') {
            totalPeso += peso;
        }
    });

    document.getElementById('peso-total-carregado').textContent = totalPeso.toFixed(2);
    verificarLimiteDeCarga();
}


// Atualiza peso total sempre que o campo de peso ou inventário interno mudar
function configurarListenersDeItens() {
    document.querySelectorAll('.item-details').forEach(card => {
        const inputsNumericos = card.querySelectorAll('input[type="number"]');
        const selects = card.querySelectorAll('select');

        if (inputsNumericos.length >= 2) {
            inputsNumericos[1].addEventListener('input', atualizarPesoTotal); // peso
        }

        if (selects.length >= 2) {
            selects[1].addEventListener('change', atualizarPesoTotal); // inventário interno
        }
    });

    atualizarPesoTotal(); // Atualiza imediatamente após configurar
}

function verificarLimiteDeCarga() {
    const pesoAtual = parseFloat(document.getElementById('peso-total-carregado').textContent) || 0;
    const pesoTotalH5 = document.getElementById('peso-total-h5');
    const inputForca = document.querySelector('.forca');
    const inputCargaMod = document.getElementById('ficha-carga_suportada_mod');
    const pesoMaximoSpan = document.getElementById('peso-maximo-carregavel');

    const forca = parseInt(inputForca?.value) || 0;
    const cargaMod = parseFloat(inputCargaMod?.value) || 0;

    const limite = (forca * 3) + cargaMod;

    pesoMaximoSpan.textContent = limite.toFixed(2);

    const spanPeso = document.getElementById('peso-total-carregado');

    if (pesoAtual > limite) {
        pesoTotalH5.style.color = 'red';
    } else {
        pesoTotalH5.style.color = ''; // Cor padrão
    }
}


function atualizarBarraDeStatus({ inputMaxId, inputAtualId, barraId, bgBarraId, tipo = "vida", exibirAlerta = false }) {
    const inputMax = document.getElementById(inputMaxId);
    const inputAtual = document.getElementById(inputAtualId);
    const barra = document.getElementById(barraId);
    const bgBarra = document.getElementById(bgBarraId);

    const max = parseInt(inputMax?.value) || 1;
    const atual = parseInt(inputAtual?.value) || 0;
    const percentual = Math.round(Math.min(100, Math.max(0, (atual / max) * 100)));

    barra.style.width = `${percentual}%`;
    barra.textContent = `${percentual}%`;

    // Remove estilos anteriores
    barra.classList.remove('bg-success', 'bg-warning', 'bg-danger', 'bg-dark');
    if (bgBarra) bgBarra.classList.remove('bg-dark');


    /// Limpa classes Bootstrap e estilo
    barra.classList.remove('bg-success', 'bg-warning', 'bg-danger', 'bg-dark');
    barra.style.backgroundColor = '';
    if (bgBarra) {
        bgBarra.classList.remove('bg-dark');
        bgBarra.style.backgroundColor = '';
    }

    if (tipo === "mana") {
        // Cor vai de roxo escuro (100%) a azul claro (0%)
        /* const cor = interpolarCor((100 - percentual) / 100, '#4b0082', '#00e0ff'); */
        const cor = interpolarMultiplasCores((100 - percentual) / 100, [
            '#4b0082',
            '#00e0ff'
        ]);
        barra.style.backgroundColor = cor;
    } else if (atual <= 0) {
        barra.classList.add('bg-dark');
        if (bgBarra) bgBarra.classList.add('bg-dark');

        if (exibirAlerta && !barra.dataset.alertShown) {
            Swal.fire({
                title: '[ALERTA DO SISTEMA]',
                html: `
                <b>Seus Pontos de Vida chegaram a 0.</b><br><br>
                Morte permanente será aplicada conforme as regras deste mundo, se não houverem contramedidas.<br><br>
                ⚠️ <i>Continue por sua conta e risco.</i>
            `,
                background: '#1a1a1a',
                color: '#00ccff',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#000000',
                customClass: {
                    popup: 'swal2-border-radius'
                }
            });
            barra.dataset.alertShown = "true";
        }
    } else {
        const cor = interpolarMultiplasCores((100 - percentual) / 100, [
            '#006400', // verde escuro
            '#8b8000', // amarelo escuro
            '#8b0000', // vermelho escuro
            '#000000'  // preto
        ]);
        barra.style.backgroundColor = cor;
        delete barra.dataset.alertShown;
    }


}

function interpolarMultiplasCores(percentual, coresHex) {
    // Converte HEX para RGB
    const hexToRgb = hex => {
        const bigint = parseInt(hex.replace("#", ""), 16);
        return {
            r: (bigint >> 16) & 255,
            g: (bigint >> 8) & 255,
            b: bigint & 255
        };
    };

    const lerp = (a, b, t) => Math.round(a + (b - a) * t);

    const total = coresHex.length - 1;
    const intervalo = 1 / total;
    let index = Math.floor(percentual / intervalo);

    if (index >= total) index = total - 1;

    const localT = (percentual - (index * intervalo)) / intervalo;
    const c1 = hexToRgb(coresHex[index]);
    const c2 = hexToRgb(coresHex[index + 1]);

    const r = lerp(c1.r, c2.r, localT);
    const g = lerp(c1.g, c2.g, localT);
    const b = lerp(c1.b, c2.b, localT);

    return `rgb(${r}, ${g}, ${b})`;
}



function atualizarBarraDeVida() {
    atualizarBarraDeStatus({
        inputMaxId: "ficha-pontos_de_vida",
        inputAtualId: "ficha-pvs_atuais",
        barraId: "barra-pv",
        bgBarraId: "barra-vida",
        tipo: "vida",
        exibirAlerta: true
    });
}

function atualizarBarraDeMana() {
    atualizarBarraDeStatus({
        inputMaxId: "ficha-pontos_de_mana",
        inputAtualId: "ficha-pms_atuais",
        barraId: "barra-pm",
        bgBarraId: "barra-mana",
        tipo: "mana",
        exibirAlerta: false
    });
}





document.getElementById("ficha-pontos_de_vida").addEventListener("input", atualizarBarraDeVida);
document.getElementById("ficha-pvs_atuais").addEventListener("input", atualizarBarraDeVida);

document.getElementById("ficha-pontos_de_mana").addEventListener("input", atualizarBarraDeMana);
document.getElementById("ficha-pms_atuais").addEventListener("input", atualizarBarraDeMana);

modalFicha.addEventListener('shown.bs.modal', () => {
    atualizarBarraDeVida();
    atualizarBarraDeMana();
});





modalFicha.addEventListener('shown.bs.modal', atualizarNivelEBarra);
modalFicha.addEventListener('shown.bs.modal', atualizarAtributos);
modalFicha.addEventListener('shown.bs.modal', calcularPericias);
document.getElementById("ficha-xp").addEventListener("input", atualizarNivelEBarra);
document.getElementById("ficha-xp").addEventListener("input", atualizarAtributos);

