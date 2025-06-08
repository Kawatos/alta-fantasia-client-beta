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


    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function () {
            modoEdicao = true;
            document.getElementById('titulo-modal').textContent = 'Editar Personagem';

            document.getElementById('botao-salvar').textContent = 'Salvar';
            fichaId = this.dataset.id;

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


                        // Atributos
                        document.querySelector('.vigor').value = atributos.vigor;
                        document.querySelector('.vigor_mod').value = atributos.vigor_mod;
                        document.querySelector('.forca').value = atributos.forca;
                        document.querySelector('.forca_mod').value = atributos.forca_mod;
                        document.querySelector('.destreza').value = atributos.destreza;
                        document.querySelector('.destreza_mod').value = atributos.destreza_mod;


                        document.querySelector('.espirito').value = atributos.espirito;
                        document.querySelector('.espirito_mod').value = atributos.espirito_mod;
                        document.querySelector('.carisma').value = atributos.carisma;
                        document.querySelector('.carisma_mod').value = atributos.carisma_mod;
                        document.querySelector('.intelecto').value = atributos.intelecto;
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



                        // Pegar Habilidades
                        const habilidadesContainer = document.querySelector('#habilidadesContainer');
                        habilidadesContainer.innerHTML = '';

                        fetch('backend/get_habilidades.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id_ficha: fichaId
                            })
                        })
                            .then(resp => resp.json())
                            .then(data => {
                                if (data.status === 'sucesso') {
                                    data.habilidades.forEach(hab => {
                                        const div = document.createElement('div');
                                        div.classList.add('habilidade-item');
                                        div.innerHTML = `
                            <strong>${hab.nome}</strong>: ${hab.descricao}
                            <button class="btn btn-sm btn-warning editar-habilidade" data-id="${hab.id}">Editar</button>
                            <button class="btn btn-sm btn-danger excluir-habilidade" data-id="${hab.id}">Excluir</button>
                        `;
                                        habilidadesContainer.appendChild(div);
                                    });

                                    // Ativa os botões criados dinamicamente
                                    ativarBotoesHabilidades();
                                } else {
                                    habilidadesContainer.innerHTML = 'Nenhuma habilidade encontrada.';
                                }
                            })
                            .catch(() => {
                                habilidadesContainer.innerHTML = 'Erro ao carregar habilidades.';
                            });



                        modalFicha.show();




                    } else {
                        alert(resposta.mensagem);
                    }
                },
                error: function () {
                    alert('Erro ao buscar a ficha.');
                }
            });




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
                    alert('Ficha atualizada com sucesso!');
                    location.reload();
                } else {
                    alert(data.mensagem || 'Erro ao salvar');
                }
            });
    });

    document.getElementById("salvar-habilidade").addEventListener("click", criarHabilidade);

    // Criar Habilidade


    function criarHabilidade() {
        const habilidadeNome = document.getElementById('habilidade-nome').value;
        const habilidadeRequisitos = document.getElementById('habilidade-requisitos').value;
        const habilidadeDescricao = document.getElementById('habilidade-descricao').value;

        console.log(habilidadeNome);
        console.log(habilidadeRequisitos);
        console.log(habilidadeDescricao);



        
        const url = 'backend/criar_habilidade_ajax.php';

        fetch(url, {
            method: 'POST',
            body: {
                nome: habilidadeNome,
                requisitos: habilidadeRequisitos,
                descricao: habilidadeDescricao
            }
        })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    alert('Habilidade criada com sucesso!');
                    getHabilidades();
                } else {
                    alert(data.mensagem || 'Erro ao salvar');
                }
            });
    }
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

modalFicha.addEventListener('shown.bs.modal', atualizarNivelEBarra);
document.getElementById("ficha-xp").addEventListener("input", atualizarNivelEBarra);
