<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: bemvindo.php");
    exit;
}
?>

<?php include('header.php'); ?>




<div class="container text-center mt-4">
    <div class="row g-2">
        <div class="col-12">
            <h1 class="display-5 fw-bold">
                <span class="font-alta">Alta</span>
                <span class="title-dynamic font-fantasia fw-bold" id="fantasiaText">Fantasia</span>
            </h1>
            <div class="text-center mt-2 mb-4">
                <i class="fas fa-dice-d20 me-1"></i>
                <i class="fas fa-dice-d20 ms-1"></i>
                <p id="mensagem" class="mb-0 text-muted fade">

                    <em></em>
                </p>
            </div>
            <h3 class="text-center mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>

            <div class="d-grid gap-2 col-6 mx-auto mb-5">
                <button id="botaoCriarFicha" class="btn btn-primary">Criar Novo Personagem</button>
            </div>

            <h2 class="mb-4">Seus Personagens</h2>

            <div class="container mt-4">
                <div id="lista-fichas" class="row row-cols-1 row-cols-lg-5 justify-content-center">
                    <!-- Fichas serão inseridas aqui -->
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal Unificado para Criar/Editar -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formFicha" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="ficha-id">

                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-modal">Editar Personagem: <span class="nome-personagem-exibicao"></span><br>
                        Nível: <span class="nivel-personagem-span"></span>
                        (Rank: <span class="rank-personagem-span"></span>)<br>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body row g-3">
                    <ul class="nav nav-tabs" id="fichaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-identificacao" data-bs-toggle="tab" data-bs-target="#identificacao" type="button" role="tab">Identificação</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-atributos" data-bs-toggle="tab" data-bs-target="#atributos" type="button" role="tab">Status e Atributos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-pericias" data-bs-toggle="tab" data-bs-target="#pericias" type="button" role="tab">Perícias</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-habilidades" data-bs-toggle="tab" data-bs-target="#habilidades" type="button" role="tab">Habilidades</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-magias" data-bs-toggle="tab" data-bs-target="#magias" type="button" role="tab">Magias</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-itens" data-bs-toggle="tab" data-bs-target="#itens" type="button" role="tab">Itens</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-jogador" data-bs-toggle="tab" data-bs-target="#jogador" type="button" role="tab">Jogador</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Identificação -->

                        <div class="tab-pane fade show active" id="identificacao" role="tabpanel">
                            <h4 class="mt-4">Identificação</h4>
                            <div class="row g-3 mb-2" style="display: flex; justify-content: center;">
                                <div class="col-md-6">

                                    <div class="mb-2 text-center">
                                        <img id="preview_imagem_personagem" src="uploads/perfil-vazio.png" alt="Preview da Imagem"
                                            style="width: 200px; height: 200px; object-fit: cover; border-radius: 12px;">
                                    </div>

                                    <label for="personagem_imagem_id" class="form-label">Imagem do Personagem:</label>

                                    <div class="input-group">
                                        <input type="file" class="form-control personagem_imagem" id="personagem_imagem_id"
                                            name="imagem" accept="image/*">
                                    </div>
                                </div>

                            </div>
                            <div class="row g-3">
                                <!-- Linha 1: Nome e Raça -->
                                <div class="col-md-6">
                                    <label for="ficha-nome" class="form-label">Nome do Avatar</label>
                                    <input type="text" name="nome" id="ficha-nome" class="form-control nome-personagem my-1" placeholder="Nome do Avatar">

                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-raca" class="form-label">Raça</label>
                                    <select name="raca" id="ficha-raca" class="form-control raca-personagem my-1">
                                        <option value="" selected>Selecione uma Raça</option>
                                        <option value="Lichiru">Lichiru</option>
                                        <option value="Dunkeriu">Dunkeriu</option>
                                        <option value="Gnomo">Gnomo</option>
                                        <option value="Dryad">Dryad</option>
                                        <option value="Fada">Fada</option>
                                        <option value="Elfo">Elfo</option>
                                        <option value="Elfo Negro">Elfo Negro (Sharym'El)</option>
                                        <option value="Elfo Negro">Draqueni</option>
                                        <option value="Orc">Orc</option>
                                        <option value="Ferali">Ferali</option>
                                        <option value="Anao">Anão</option>
                                        <option value="Humano">Humano</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-classe" class="form-label">Classe</label>
                                    <select name="classe" id="ficha-classe" class="form-control classe-personagem" value="Selecione uma Classe">
                                        <option value="Sem Classe" selected>Selecione uma Classe</option>
                                        <option value="Guerreiro">Guerreiro</option>
                                        <option value="Bárbaro">Bárbaro</option>
                                        <option value="Samurai">Samurai</option>
                                        <option value="Cavaleiro">Cavaleiro</option>
                                        <option value="Ranger">Ranger</option>
                                        <option value="Monge">Monge</option>
                                        <option value="Swashbuckler">Swashbuckler</option>
                                        <option value="Ninja">Ninja</option>
                                        <option value="Caçador">Caçador</option>
                                        <option value="Inventor">Inventor</option>
                                        <option value="Nobre">Nobre</option>
                                        <option value="Ladino">Ladino</option>
                                        <option value="Mago">Mago</option>
                                        <option value="Feiticeiro">Feiticeiro</option>
                                        <option value="Bruxo">Bruxo</option>
                                        <option value="Clérigo">Clérigo</option>
                                        <option value="Bardo">Bardo</option>
                                        <option value="Druida">Druida</option>
                                    </select>
                                </div>




                                <div class="col-md-6">
                                    <label for="ficha-deslocamento" class="form-label">Deslocamento (Metros):</label>
                                    <input type="number" name="deslocamento" id="ficha-deslocamento" class="form-control deslocamento-personagem" placeholder="Deslocamento">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-deslocamento" class="form-label">Altura:</label>
                                    <input type="text" name="altura" id="altura-personagem" class="form-control altura-personagem" placeholder="Ex: 1.80m">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-deslocamento" class="form-label">Idade:</label>
                                    <input type="text" name="idade" id="idade-personagem" class="form-control idade-personagem" placeholder="Ex: 25 anos">
                                </div>
                                <div class="col-md-6">
                                    <label for="sexo-personagem" class="form-label">Sexo (Biológico):</label>
                                    <select name="sexo" id="sexo-personagem" class="form-control sexo-personagem" value="">
                                        <option value="" selected>Selecione uma opção</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="hemafrodita">Hemafrodita (ambos)</option>
                                        <option value="Não Possui">Não Possui</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tendencia-personagem" class="form-label">Tendência:</label>
                                    <select name="tendencia" id="tendencia-personagem" class="form-control tendencia-personagem" value="">
                                        <option value="" selected>Selecione uma opção</option>
                                        <option value="Leal - Bondoso">Leal - Bondoso</option>
                                        <option value="Leal - Neutro">Leal - Neutro</option>
                                        <option value="Leal - Maligno">Leal - Maligno</option>
                                        <option value="Neutro - Neutro">Neutro - Neutro</option>
                                        <option value="Caótico - Bondoso">Caótico - Bondoso</option>
                                        <option value="Caótico - Neutro">Caótico - Neutro</option>
                                        <option value="Caótico - Maligno">Caótico - Maligno</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-divindade" class="form-label">Divindade</label>
                                    <input type="text" name="divindade" id="ficha-divindade" class="form-control divindade-personagem" placeholder="Divindade">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-escola_arcana" class="form-label">Escola Arcana</label>
                                    <input type="text" name="escola_arcana" id="ficha-escola_arcana" class="form-control escola_arcana-personagem" placeholder="Escola Arcana">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-idiomas" class="form-label">Idiomas</label>
                                    <input type="text" name="idiomas" id="ficha-idiomas" class="form-control idiomas-personagem" placeholder="Idiomas">
                                </div>
                                <div class="col-6">
                                    <label for="ficha-xp" class="form-label">Experiência (XP)</label>
                                    <input type="number" name="nivel" id="ficha-xp" class="form-control nivel-personagem" placeholder="XP Atual" value="100" min="0">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Nível Atual: <span id="nivel-atual">1</span></label>
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar bg-success" id="barra-xp" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Progresso Total até o Nível 100: <span id="progresso-total-texto">1%</span></label>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-info" id="barra-progresso-total" role="progressbar" style="width: 1%;" aria-valuemin="0" aria-valuemax="100">1%</div>
                                    </div>
                                </div>

                                <!-- Linha 5: Descrição -->
                                <div class="col-12">
                                    <label for="ficha-descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="ficha-descricao" class="form-control descricao-personagem" placeholder="Descrição" rows="10" autocomplete="off"></textarea>

                                </div>

                            </div>
                        </div>


                        <!-- Atributos -->
                        <div class="tab-pane fade" id="atributos" role="tabpanel">

                            <!-- Tabs de Navegação Atributos-->
                            <div class="col-12 mt-3">
                                <!-- Linha 3: Status e Pontos de Vida -->
                                <div class="row g-3 mb-3">
                                    <h4 class="mt-1">Status</h4>
                                    <div class="col-md-12 mt-2">
                                        <label class="form-label">Pontos de Vida: <span id="barra-vida-span">0%</span></label>
                                        <div class="progress" id="barra-vida" style="height: 25px;">
                                            <div id="barra-pv" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-6">
                                        <label for="ficha-pontos_de_vida" class="form-label">PVs Totais</label>
                                        <input type="number" name="pontos_de_vida" id="ficha-pontos_de_vida" class="form-control pontos-de-vida-personagem" placeholder="Pontos de Vida Totais" value="100">
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="ficha-pvs_atuais" class="form-label">PVs Atuais</label>
                                        <input type="number" name="pvs_atuais" id="ficha-pvs_atuais" class="form-control pvs_atuais-personagem" placeholder="Pontos de Vida Atuais" value="100">
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="ficha-status" class="form-label">Status</label>
                                        <select name="status_personagem" id="ficha-status" class="form-control status-personagem" required>
                                            <option value="">Selecione um Status</option>
                                            <option value="Vivo" selected>Vivo</option>
                                            <option value="Morto">Morto</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="ficha-regen_pv" class="form-label">Regeneração de PVs</label>
                                        <input type="number" name="regen_pv" id="ficha-regen_pv" class="form-control regen_pv-personagem" placeholder="Regeneração de PVs">
                                    </div>

                                    <div class="col-12 mt-3 ">
                                        <div class="w-100" style="display: flex; align-items: flex-end; justify-content: center;">
                                            <div class="">
                                                <label for="pv-valor-ajuste" class="form-label">Valor de Cura/Dano</label>
                                                <input type="number" id="pv-valor-ajuste" class="form-control" placeholder="Valor em PVs">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100" style="display: flex; align-items: flex-end; justify-content: center;">
                                        <button type="button" class="btn btn-danger mx-2" onclick="aplicarDano()">Sofrer</button>
                                        <button type="button" class="btn btn-success mx-2" onclick="aplicarCura()">Curar</button>
                                    </div>

                                </div>

                                <h4 class="mt-4">Atributos</h4>
                                <p class="text-muted">Estilo de cálculo (Mod + Mod Nível = Atributo)</p>

                                <ul class="nav nav-tabs mt-4" id="tabs-atributos" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tab-atcorporais-tab" data-bs-toggle="tab" data-bs-target="#tab-atcorporais" type="button" role="tab">Corporais</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-atmentais-tab" data-bs-toggle="tab" data-bs-target="#tab-atmentais" type="button" role="tab">Mentais</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="atributos-tab-content">
                                    <div class="tab-pane fade show active" id="tab-atcorporais" role="tabpanel">

                                        <!-- Vigor -->
                                        <div class="col-12 border border-secondary-subtle rounded mb-3 p-3">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#atvigor">
                                                <h4>Vigor = <span class="vigor-txt"></span></h4>
                                                <h5 class="mb-1 text-muted">(M: <span class="vigor_mod-txt">0</span> + M/N: <span class="vigor_mod_nv-txt">0</span>) </h5>
                                            </div>
                                            <div class="collapse" id="atvigor">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador</label>
                                                        <input type="number" name="vigor_mod" class="form-control form-control-sm vigor_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador/Nível</label>
                                                        <input type="number" name="vigor_mod_nv" class="form-control form-control-sm vigor_mod_nv" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Total</label>
                                                        <input type="number" name="vigor" class="form-control form-control-sm vigor" id="vigorId" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Força -->
                                        <div class="col-12 border border-secondary-subtle rounded mb-3 p-3">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#atforca">
                                                <h4>Força = <span class="forca-txt"></span></h4>
                                                <h5 class="mb-1 text-muted">(M: <span class="forca_mod-txt">0</span> + M/N: <span class="forca_mod_nv-txt">0</span>) </h5>
                                            </div>
                                            <div class="collapse" id="atforca">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador</label>
                                                        <input type="number" name="forca_mod" class="form-control form-control-sm forca_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador/Nível</label>
                                                        <input type="number" name="forca_mod_nv" class="form-control form-control-sm forca_mod_nv" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Total</label>
                                                        <input type="number" name="forca" class="form-control form-control-sm forca" id="forcaId" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Destreza -->
                                        <div class="col-12 border border-secondary-subtle rounded mb-3 p-3">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#atdestreza">
                                                <h4>Destreza = <span class="destreza-txt"></span></h4>
                                                <h5 class="mb-1 text-muted">(M: <span class="destreza_mod-txt">0</span> + M/N: <span class="destreza_mod_nv-txt">0</span>) </h5>
                                            </div>
                                            <div class="collapse" id="atdestreza">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador</label>
                                                        <input type="number" name="destreza_mod" class="form-control form-control-sm destreza_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador/Nível</label>
                                                        <input type="number" name="destreza_mod_nv" class="form-control form-control-sm destreza_mod_nv" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Total</label>
                                                        <input type="number" name="destreza" class="form-control form-control-sm destreza" id="destrezaId" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-atmentais" role="tabpanel">
                                        <!-- Espírito -->
                                        <div class="col-12 border border-secondary-subtle rounded mb-3 p-3">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#atespirito">
                                                <h4>Espírito = <span class="espirito-txt"></span></h4>
                                                <h5 class="mb-1 text-muted">(M: <span class="espirito_mod-txt">0</span> + M/N: <span class="espirito_mod_nv-txt">0</span>) </h5>
                                            </div>
                                            <div class="collapse" id="atespirito">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador</label>
                                                        <input type="number" name="espirito_mod" class="form-control form-control-sm espirito_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador/Nível</label>
                                                        <input type="number" name="espirito_mod_nv" class="form-control form-control-sm espirito_mod_nv" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Total</label>
                                                        <input type="number" name="espirito" class="form-control form-control-sm espirito" id="espiritoId" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Carisma -->
                                        <div class="col-12 border border-secondary-subtle rounded mb-3 p-3">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#atcarisma">
                                                <h4>Carisma = <span class="carisma-txt"></span></h4>
                                                <h5 class="mb-1 text-muted">(M: <span class="carisma_mod-txt">0</span> + M/N: <span class="carisma_mod_nv-txt">0</span>) </h5>
                                            </div>
                                            <div class="collapse" id="atcarisma">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador</label>
                                                        <input type="number" name="carisma_mod" class="form-control form-control-sm carisma_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador/Nível</label>
                                                        <input type="number" name="carisma_mod_nv" class="form-control form-control-sm carisma_mod_nv" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Total</label>
                                                        <input type="number" name="carisma" class="form-control form-control-sm carisma" id="carismaId" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Intelecto -->
                                        <div class="col-12 border border-secondary-subtle rounded mb-3 p-3">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#atintelecto">
                                                <h4>Intelecto = <span class="intelecto-txt"></span></h4>
                                                <h5 class="mb-1 text-muted">(M: <span class="intelecto_mod-txt">0</span> + M/N: <span class="intelecto_mod_nv-txt">0</span>) </h5>
                                            </div>
                                            <div class="collapse" id="atintelecto">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador</label>
                                                        <input type="number" name="intelecto_mod" class="form-control form-control-sm intelecto_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Modificador/Nível</label>
                                                        <input type="number" name="intelecto_mod_nv" class="form-control form-control-sm intelecto_mod_nv" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Total</label>
                                                        <input type="number" name="intelecto" class="form-control form-control-sm intelecto" id="intelectoId" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">

                                <p>Total de Pontos de Modificadores de Nível: <span id="total-mod-nivel">0</span> / <span id="pontos-por-nivel">1</span></p>
                            </div>
                            <div class="col-12">
                                <label for="ficha-observacoes_atributos" class="form-label">Observações Atributos</label>
                                <textarea name="observacoes_atributos" id="ficha-observacoes_atributos" class="form-control observacoes_atributos-personagem" placeholder="Observações Atributos" rows="5"></textarea>
                            </div>
                        </div>

                        <!-- Perícias -->
                        <div class="tab-pane fade" id="pericias" role="tabpanel">
                            <h4 class="mt-2">Perícias</h4>
                            <!-- Tabs de Navegação Pericias-->
                            <div class="col-12 mt-4">
                                <ul class="nav nav-tabs" id="tabs-pericias" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tab-corporais-tab" data-bs-toggle="tab" data-bs-target="#tab-corporais" type="button" role="tab">Corporais</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-mentais-tab" data-bs-toggle="tab" data-bs-target="#tab-mentais" type="button" role="tab">Mentais</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-tecnicas-tab" data-bs-toggle="tab" data-bs-target="#tab-tecnicas" type="button" role="tab">Técnicas</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-conhecimentos-tab" data-bs-toggle="tab" data-bs-target="#tab-conhecimentos" type="button" role="tab">Conhecimentos</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="pericias-tab-content">
                                    <div class="tab-pane fade show active" id="tab-corporais" role="tabpanel">



                                        <!-- Tenacidade -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="vigor">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-tenacidade">
                                                <h4>Tenacidade = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Vigor]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-tenacidade">
                                                <div class="row">
                                                    <p>Descrição: Resistência física prolongada em esforços contínuos, como marchas longas ou nadar contra a correnteza.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="tenacidade_treinamentos" class="form-control form-control-sm treinado tenacidade_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="tenacidade_proeficiencias" class="form-control form-control-sm proeficiente tenacidade_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="tenacidade_mod" class="form-control form-control-sm pericia-mod tenacidade_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fortitude -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="vigor">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-fortitude">
                                                <h4>Fortitude = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Vigor]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-fortitude">
                                                <div class="row">
                                                    <p>Descrição: Suportar danos, venenos, doenças e ambientes hostis, mantendo-se funcional mesmo sob condições adversas.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="fortitude_treinamentos" class="form-control form-control-sm treinado fortitude_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="fortitude_proeficiencias" class="form-control form-control-sm proeficiente fortitude_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="fortitude_mod" class="form-control form-control-sm pericia-mod fortitude_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Atletismo -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="forca">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-atletismo">
                                                <h4>Atletismo = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Força]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-atletismo">
                                                <div class="row">
                                                    <p>Descrição: Aplicar força explosiva em ações rápidas, como saltar, empurrar ou erguer grandes pesos momentaneamente.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="atletismo_treinamentos" class="form-control form-control-sm treinado atletismo_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="atletismo_proeficiencias" class="form-control form-control-sm proeficiente atletismo_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="atletismo_mod" class="form-control form-control-sm pericia-mod atletismo_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Corpo-a-corpo -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="forca">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-corpoacorpo">
                                                <h4>Corpo-a-corpo = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Força]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-corpoacorpo">
                                                <div class="row">
                                                    <p>Descrição: Domínio físico em lutas, agarrões e imobilizações, usado tanto para resistir quanto para executar manobras de combate.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="corpoacorpo_treinamentos" class="form-control form-control-sm treinado corpoacorpo_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="corpoacorpo_proeficiencias" class="form-control form-control-sm proeficiente corpoacorpo_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="corpoacorpo_mod" class="form-control form-control-sm pericia-mod corpoacorpo_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reflexo -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-reflexo">
                                                <h4>Reflexo = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-reflexo">
                                                <div class="row">
                                                    <p>Descrição: Reagir rapidamente a perigos ou eventos súbitos, como desviar de ataques ou pegar algo que cai.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="reflexo_treinamentos" class="form-control form-control-sm treinado reflexo_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="reflexo_proeficiencias" class="form-control form-control-sm proeficiente reflexo_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="reflexo_mod" class="form-control form-control-sm pericia-mod reflexo_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Controle -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-controle">
                                                <h4>Controle = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-controle">
                                                <div class="row">
                                                    <p>Descrição: Manter equilíbrio, precisão e furtividade em movimentos sob pressão, como escalar, esgueirar-se ou se equilibrar.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="controle_treinamentos" class="form-control form-control-sm treinado controle_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="controle_proeficiencias" class="form-control form-control-sm proeficiente controle_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="controle_mod" class="form-control form-control-sm pericia-mod controle_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab-mentais" role="tabpanel">

                                        <!-- Autocontrole-->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="espirito">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-autocontrole">
                                                <h4>Autocontrole = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Espírito]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-autocontrole">
                                                <div class="row">
                                                    <p>Descrição: Resistência instantânea contra medo, pânico, impulsos ou coerção mental súbita.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="autocontrole_treinamentos" class="form-control form-control-sm treinado autocontrole_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="autocontrole_proeficiencias" class="form-control form-control-sm proeficiente autocontrole_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="autocontrole_mod" class="form-control form-control-sm pericia-mod autocontrole_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Resiliencia -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="espirito">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-resiliencia">
                                                <h4>Resiliencia = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Espírito]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-resiliencia">
                                                <div class="row">
                                                    <p>Descrição: Recuperação emocional após traumas, choques ou sofrimento prolongado, mantendo a sanidade.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="resiliencia_treinamentos" class="form-control form-control-sm treinado resiliencia_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="resiliencia_proeficiencias" class="form-control form-control-sm proeficiente resiliencia_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="resiliencia_mod" class="form-control form-control-sm pericia-mod resiliencia_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Intuição -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-intuicao">
                                                <h4>Intuição = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-intuicao">
                                                <div class="row">
                                                    <p>Descrição: Perceber mentiras, perigos ou obter palpites certeiros baseados em experiência e sensibilidade inconsciente.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="intuicao_treinamentos" class="form-control form-control-sm treinado intuicao_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="intuicao_proeficiencias" class="form-control form-control-sm proeficiente intuicao_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="intuicao_mod" class="form-control form-control-sm pericia-mod intuicao_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Percepção -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-percepcao">
                                                <h4>Percepção = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-percepcao">
                                                <div class="row">
                                                    <p>Descrição: Atenção aos sentidos e detalhes, identificando pistas, sons, cheiros, movimentos ou anomalias no ambiente.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="percepcao_treinamentos" class="form-control form-control-sm treinado percepcao_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="percepcao_proeficiencias" class="form-control form-control-sm proeficiente percepcao_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="percepcao_mod" class="form-control form-control-sm pericia-mod percepcao_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Influência -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="carisma">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-influencia">
                                                <h4>Influência = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Carísma]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-influencia">
                                                <div class="row">
                                                    <p>Descrição: Habilidade social para persuadir, inspirar, provocar ou comover pessoas através de presença e discurso.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="influencia_treinamentos" class="form-control form-control-sm treinado influencia_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="influencia_proeficiencias" class="form-control form-control-sm proeficiente influencia_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="influencia_mod" class="form-control form-control-sm pericia-mod influencia_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Atuação -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="carisma">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-atuacao">
                                                <h4>Atuação = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Carísma]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-atuacao">
                                                <div class="row">
                                                    <p>Descrição: Fingir emoções, disfarçar intenções ou imitar comportamentos para enganar, encantar ou despistar.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="atuacao_treinamentos" class="form-control form-control-sm treinado atuacao_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="atuacao_proeficiencias" class="form-control form-control-sm proeficiente atuacao_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="atuacao_mod" class="form-control form-control-sm pericia-mod atuacao_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="tab-tecnicas" role="tabpanel">
                                        <!-- Esgrima -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-esgrima">
                                                <h4>Esgrima = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-esgrima">
                                                <div class="row">
                                                    <p>Descrição: Habilidade com armas de corte e precisão (espadas, adagas).</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_esgrima_treinamentos" class="form-control form-control-sm treinado t_esgrima_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_esgrima_proeficiencias" class="form-control form-control-sm proeficiente t_esgrima_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_esgrima_mod" class="form-control form-control-sm pericia-mod t_esgrima_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pontaria -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-pontaria">
                                                <h4>Pontaria = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-pontaria">
                                                <div class="row">
                                                    <p>Descrição: Uso de armas à distância (arcos, bestas, armas de fogo).</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_pontaria_treinamentos" class="form-control form-control-sm treinado t_pontaria_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_pontaria_proeficiencias" class="form-control form-control-sm proeficiente t_pontaria_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_pontaria_mod" class="form-control form-control-sm pericia-mod t_pontaria_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Marcial -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-marcial">
                                                <h4>Marcial = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-marcial">
                                                <div class="row">
                                                    <p>Descrição: Uso de armas brutas ou improvisadas (machados, clavas, porretes).</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_marcial_treinamentos" class="form-control form-control-sm treinado t_marcial_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_marcial_proeficiencias" class="form-control form-control-sm proeficiente t_marcial_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_marcial_mod" class="form-control form-control-sm pericia-mod t_marcial_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Metalurgia -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-metalurgia">
                                                <h4>Metalurgia = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-metalurgia">
                                                <div class="row">
                                                    <p>Descrição: Manipulação prática de metais (forjar, moldar, fundir).</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_metalurgia_treinamentos" class="form-control form-control-sm treinado t_metalurgia_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_metalurgia_proeficiencias" class="form-control form-control-sm proeficiente t_metalurgia_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_metalurgia_mod" class="form-control form-control-sm pericia-mod t_metalurgia_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Artesanato -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-artesanato">
                                                <h4>Artesanato = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-artesanato">
                                                <div class="row">
                                                    <p>Descrição: Criação de objetos manuais: entalhes, costura, escultura, culinária.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_artesanato_treinamentos" class="form-control form-control-sm treinado t_artesanato_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_artesanato_proeficiencias" class="form-control form-control-sm proeficiente t_artesanato_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_artesanato_mod" class="form-control form-control-sm pericia-mod t_artesanato_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Ladinagem -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-ladinagem">
                                                <h4>Ladinagem = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-ladinagem">
                                                <div class="row">
                                                    <p>Descrição: Abertura de fechaduras, desarme/criação de armadilhas, truques manuais.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_ladinagem_treinamentos" class="form-control form-control-sm treinado t_ladinagem_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_ladinagem_proeficiencias" class="form-control form-control-sm proeficiente t_ladinagem_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_ladinagem_mod" class="form-control form-control-sm pericia-mod t_ladinagem_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Instrumentos -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-instrumentos">
                                                <h4>Instrumentos = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-instrumentos">
                                                <div class="row">
                                                    <p>Descrição: Operação precisa de instrumentos musicais ou mecânicos, como pequenas máquinas.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_instrumentos_treinamentos" class="form-control form-control-sm treinado t_instrumentos_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_instrumentos_proeficiencias" class="form-control form-control-sm proeficiente t_instrumentos_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_instrumentos_mod" class="form-control form-control-sm pericia-mod t_instrumentos_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pilotagem -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="destreza">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-pilotagem">
                                                <h4>Pilotagem = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Destreza]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-pilotagem">
                                                <div class="row">
                                                    <p>Descrição: Controle de montarias, veículos ou máquinas complexas.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="t_pilotagem_treinamentos" class="form-control form-control-sm treinado t_pilotagem_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="t_pilotagem_proeficiencias" class="form-control form-control-sm proeficiente t_pilotagem_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="t_pilotagem_mod" class="form-control form-control-sm pericia-mod t_pilotagem_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="tab-conhecimentos" role="tabpanel">
                                        <!-- Arcano -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-arcano">
                                                <h4>Arcano = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-arcano">
                                                <div class="row">
                                                    <p>Descrição: Entendimento de magia arcana, criaturas arcanas, artefatos e inscrições mágicas.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_arcano_treinamentos" class="form-control form-control-sm treinado c_arcano_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_arcano_proeficiencias" class="form-control form-control-sm proeficiente c_arcano_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_arcano_mod" class="form-control form-control-sm pericia-mod c_arcano_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Religioso -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-religioso">
                                                <h4>Religioso = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-religioso">
                                                <div class="row">
                                                    <p>Descrição: Saberes sobre magia divina, divindades, cultos, dogmas e magia divina.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_religioso_treinamentos" class="form-control form-control-sm treinado c_religioso_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_religioso_proeficiencias" class="form-control form-control-sm proeficiente c_religioso_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_religioso_mod" class="form-control form-control-sm pericia-mod c_religioso_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Histórico -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-historico">
                                                <h4>Histórico = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-historico">
                                                <div class="row">
                                                    <p>Descrição: Compreensão de fatos antigos, eventos marcantes e tradições.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_historico_treinamentos" class="form-control form-control-sm treinado c_historico_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_historico_proeficiencias" class="form-control form-control-sm proeficiente c_historico_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_historico_mod" class="form-control form-control-sm pericia-mod c_historico_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Natureza -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-natureza">
                                                <h4>Natureza = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-natureza">
                                                <div class="row">
                                                    <p>Descrição: Saber lidar com plantas, animais, sobrevivência clima e ambiente natural.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_natureza_treinamentos" class="form-control form-control-sm treinado c_natureza_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_natureza_proeficiencias" class="form-control form-control-sm proeficiente c_natureza_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_natureza_mod" class="form-control form-control-sm pericia-mod c_natureza_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Engenharia -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-engenharia">
                                                <h4>Engenharia = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-engenharia">
                                                <div class="row">
                                                    <p>Descrição: Projetos de armas, estruturas e mecanismos.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_engenharia_treinamentos" class="form-control form-control-sm treinado c_engenharia_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_engenharia_proeficiencias" class="form-control form-control-sm proeficiente c_engenharia_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_engenharia_mod" class="form-control form-control-sm pericia-mod c_engenharia_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Alquimia -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-alquimia">
                                                <h4>Alquimia = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-alquimia">
                                                <div class="row">
                                                    <p>Descrição: Conhecimento sobre substâncias, poções, efeitos químicos, Física, Matemática.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_alquimia_treinamentos" class="form-control form-control-sm treinado c_alquimia_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_alquimia_proeficiencias" class="form-control form-control-sm proeficiente c_alquimia_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_alquimia_mod" class="form-control form-control-sm pericia-mod c_alquimia_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Navegação -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-navegacao">
                                                <h4>Navegação = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-navegacao">
                                                <div class="row">
                                                    <p>Descrição: Cartografia, rotas terrestres e marítimas, geografia, clima.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_navegacao_treinamentos" class="form-control form-control-sm treinado c_navegacao_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_navegacao_proeficiencias" class="form-control form-control-sm proeficiente c_navegacao_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_navegacao_mod" class="form-control form-control-sm pericia-mod c_navegacao_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Linguístico -->
                                        <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="intelecto">
                                            <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-linguistico">
                                                <h4>Linguístico = <span class="pericia-final"></span></h4>
                                                <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                                    P: <span class="proeficiente-valor">0</span> +
                                                    M: <span class="modbase-valor">0</span> +
                                                    A: <span class="atributotxt-valor">0</span> [Intelecto]) </h5>
                                            </div>
                                            <div class="collapse" id="pericia-linguistico">
                                                <div class="row">
                                                    <p>Descrição: Conhecimento sobre Idiomas, dialetos e girias de outras regiões.</p>
                                                </div>
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Treinamentos</label>
                                                        <input type="number" name="c_linguistico_treinamentos" class="form-control form-control-sm treinado c_linguistico_treinamentos" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Proeficiências</label>
                                                        <input type="number" name="c_linguistico_proeficiencias" class="form-control form-control-sm proeficiente c_linguistico_proeficiencias" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Mod. Geral</label>
                                                        <input type="number" name="c_linguistico_mod" class="form-control form-control-sm pericia-mod c_linguistico_mod" />
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <label class="form-label mb-1">Atributo</label>
                                                        <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="ficha-observacoes_pericias" class="form-label">Observações Perícias</label>
                                <textarea name="observacoes_pericias" id="ficha-observacoes_pericias" class="form-control observacoes_pericias-personagem" placeholder="Observações Perícias" rows="5"></textarea>
                            </div>
                        </div>

                        <!-- Habilidades -->
                        <div class="tab-pane fade" id="habilidades" role="tabpanel">

                            <h4 class="mt-2 mb-4">Habilidades</h4>

                            <div class="col-12">
                                <button type="button" class="btn btn-primary criar-habilidade" id="criar-habilidade" data-bs-toggle="collapse" data-bs-target="#collapseHabilidade">Criar Nova Habilidade</button>
                                <button type="button" class="btn-close float-end" data-bs-toggle="collapse" data-bs-target="#collapseHabilidade" aria-label="Fechar"></button>
                                <div class="collapse mt-3" id="collapseHabilidade">
                                    <div class="card card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-12">
                                                <label for="habilidade-nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="habilidade-nome" name="nome-habilidade">
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <label for="habilidade-requisitos" class="form-label">Requisitos</label>
                                                <input type="text" class="form-control" id="habilidade-requisitos" name="requisitos">
                                            </div>
                                            <div class="col-12">
                                                <label for="habilidade-descricao" class="form-label">Descrição</label>
                                                <textarea class="form-control" id="habilidade-descricao" name="descricao-habilidade" rows="5"></textarea>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="button" class="btn btn-success" id="salvar-habilidade-nova">Salvar Habilidade</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="col-12 mt-3">
                                <label for="ficha-habilidades" class="form-label">Habilidades</label>
                                <div id="habilidadesContainer"></div>
                            </div>
                            <div class="col-12">
                                <label for="ficha-observacoes_habilidades" class="form-label">Observações Habilidades</label>
                                <textarea name="observacoes_habilidades" id="ficha-observacoes_habilidades" class="form-control observacoes_habilidades-personagem" placeholder="Observações Habilidades" rows="5"></textarea>
                            </div>

                        </div>
                        <!-- Magias -->
                        <div class="tab-pane fade" id="magias" role="tabpanel">
                            <h4 class="mt-2 mb-4">Magias</h4>
                            <div class="row g-3">

                                <!-- Linha 4: Pontos de Mana -->
                                <div class="col-md-12 my-2">
                                    <label class="form-label">Pontos de Mana: <span id="barra-mana-span">0%</span></label>
                                    <div class="progress" id="barra-mana" style="height: 25px;">
                                        <div id="barra-pm" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4 justify-content-center">
                                    <div class="col-6 col-md-6">
                                        <label for="ficha-pontos_de_mana" class="form-label">Pontos de Mana</label>
                                        <input type="number" name="pontos_de_mana" id="ficha-pontos_de_mana" class="form-control pontos-de-mana-personagem" placeholder="Pontos de Mana">
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="ficha-pms_atuais" class="form-label">PMs Atuais</label>
                                        <input type="number" name="pms_atuais" id="ficha-pms_atuais" class="form-control pms_atuais-personagem" placeholder="Pontos de Mana">
                                    </div>
                                    <div class="col-12 col-md-12 mt-2">
                                        <label for="ficha-regen_pm" class="form-label">Regeneração de PMs</label>
                                        <input type="text" name="regen_pm" id="ficha-regen_pm" class="form-control regen_pm-personagem" placeholder="Regeneração de PMs">
                                    </div>
                                </div>


                                <div class="col-12 mt-1 ">
                                    <div class="w-100" style="display: flex; align-items: flex-end; justify-content: center;">
                                        <div class="">
                                            <label for="pm-valor-ajuste" class="form-label">PMs Custo/Recuperação</label>
                                            <input type="number" id="pm-valor-ajuste" class="form-control" placeholder="Valor em PMs">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100" style="display: flex; align-items: flex-end; justify-content: center;">
                                    <button type="button" class="btn btn-danger mx-2" onclick="ConjurarMagia()">Conjurar</button>
                                    <button type="button" class="btn btn-success mx-2" onclick="RecuperarMana()">Recuperar</button>
                                </div>



                                <!-- Botão Criar Magia -->
                                <div class="col-12 mt-4">
                                    <button type="button" class="btn btn-primary criar-magia" id="criar-magia" data-bs-toggle="collapse" data-bs-target="#collapseMagia">Criar Nova Magia</button>
                                    <button type="button" class="btn-close float-end" data-bs-toggle="collapse" data-bs-target="#collapseMagia" aria-label="Fechar"></button>
                                    <div class="collapse mt-3" id="collapseMagia">
                                        <div class="card card-body">
                                            <div class="row g-3">
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="magia-nome">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-tipo" class="form-label">Tipo</label>
                                                    <select class="form-control" id="magia-tipo">
                                                        <option value="arcana">Arcana</option>
                                                        <option value="divina">Divina</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-nivel" class="form-label">Nível</label>
                                                    <input type="number" class="form-control" id="magia-nivel">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-custo" class="form-label">Custo (PM)</label>
                                                    <input type="number" class="form-control" id="magia-custo">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-alcance" class="form-label">Alcance</label>
                                                    <input type="text" class="form-control" id="magia-alcance">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-duracao" class="form-label">Duração</label>
                                                    <input type="text" class="form-control" id="magia-duracao">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="magia-descritor" class="form-label">Descritor</label>
                                                    <input type="text" class="form-control" id="magia-descritor">
                                                </div>
                                                <div class="col-12">
                                                    <label for="magia-descricao" class="form-label">Descrição</label>
                                                    <textarea class="form-control" id="magia-descricao" rows="5"></textarea>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="button" class="btn btn-success" id="salvar-magia-nova">Salvar Magia</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <!-- Tabs de Navegação -->
                                <div class="col-12 mt-4">
                                    <ul class="nav nav-tabs" id="tabs-magias" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="tab-arcana-tab" data-bs-toggle="tab" data-bs-target="#tab-arcana" type="button" role="tab">Magias Arcanas</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="tab-divina-tab" data-bs-toggle="tab" data-bs-target="#tab-divina" type="button" role="tab">Magias Divinas</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-3" id="magias-tab-content">
                                        <!-- Aba de Magias Arcanas -->
                                        <div class="tab-pane fade show active" id="tab-arcana" role="tabpanel">
                                            <div id="magias-arcanas"></div> <!-- Aqui o JS renderiza as magias arcanas -->
                                            <div class="col-12 mt-3">
                                                <label for="ficha-observacoes_magias_arcanas" class="form-label">Observações Magias Arcanas</label>
                                                <textarea name="observacoes_magias_arcanas" id="ficha-observacoes_magias_arcanas" class="form-control observacoes_magias_arcanas-personagem" placeholder="Observações Magias Arcanas" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <!-- Aba de Magias Divinas -->
                                        <div class="tab-pane fade" id="tab-divina" role="tabpanel">
                                            <div id="magias-divinas"></div> <!-- Aqui o JS renderiza as magias divinas -->
                                            <div class="col-12 mt-3">
                                                <label for="ficha-observacoes_magias_divinas" class="form-label">Observações Magias Divinas</label>
                                                <textarea name="observacoes_magias_divinas" id="ficha-observacoes_magias_divinas" class="form-control observacoes_magias_divinas-personagem" placeholder="Observações Magias Divinas" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                        <!-- Itens -->
                        <div class="tab-pane fade" id="itens" role="tabpanel">
                            <h4 class="mt-2 mb-4">Itens</h4>
                            <div class="row g-3">

                                <!-- Botão Criar Item -->
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="ficha-carga_suportada_mod" class="form-label">Carga Suportada Modificador (kg)</label>
                                            <input type="number" name="carga_suportada_mod" id="ficha-carga_suportada_mod" class="form-control carga_suportada_mod-personagem" placeholder="Carga Suportada Modificador">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ficha-carga_suportada_mod" class="form-label">Espaço Interno Mod</label>
                                            <input type="number" name="inventario_interno_mod" id="ficha-inventario_interno_mod" class="form-control inventario_interno_mod-personagem" placeholder="Inventário Interno Modificador">
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="mt-3" id="peso-total-h5">Peso Carregado: <span id="peso-total-carregado">0</span> kg</h5>
                                            <p class="text-muted">Máximo = 10 + (3x Força): <span id="peso-maximo-carregavel"></span> kg</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="mt-3" id="peso-total-h5">Itens no Espaço Interno: <span id="inventario-interno-atual-span">0</span></h5>
                                            <p class="text-muted">Espaço Interno Total: <span id="inventario-interno-total-span"></span></p>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseItem">Criar Novo Item</button>
                                    <button type="button" class="btn-close float-end" data-bs-toggle="collapse" data-bs-target="#collapseItem" aria-label="Fechar"></button>

                                    <div class="collapse mt-3" id="collapseItem">
                                        <div class="card card-body">
                                            <div class="row g-3">
                                                <div class="col-6 col-md-6">
                                                    <label for="item-nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="item-nome" name="nome-item">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="item-rank" class="form-label">Rank</label>
                                                    <input type="number" class="form-control" id="item-rank" name="rank">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="item-quantidade" class="form-label">Quantidade:</label>
                                                    <input type="number" class="form-control" id="item-quantidade" name="quantidade">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="item-peso" class="form-label">Peso (kg):</label>
                                                    <input type="number" class="form-control" id="item-peso" name="peso">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="item-volume" class="form-label">Volume</label>
                                                    <input type="text" class="form-control" id="item-volume" name="volume">
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="item-equipado" class="form-label">Equipado</label>
                                                    <select class="form-control" id="item-equipado" name="equipado">
                                                        <option value="">Selecione</option>
                                                        <option value="sim">Sim</option>
                                                        <option value="nao">Não</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label for="item-inventario-interno" class="form-label">Interno</label>
                                                    <select class="form-control" id="item-inventario-interno" name="inventario_interno">
                                                        <option value="">Selecione</option>
                                                        <option value="sim">Sim</option>
                                                        <option value="nao">Não</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <label class="form-label">Estado:</label>
                                                    <select class="form-control item-estado" id="item-estado">
                                                        <option value="">Selecione</option>
                                                        <option value="intacto">Intacto</option>
                                                        <option value="pouco-danificado">Pouco danificado</option>
                                                        <option value="danificado">Danificado</option>
                                                        <option value="inutilizavel">Inutilizável</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="item-descricao" class="form-label">Descrição</label>
                                                    <textarea class="form-control" id="item-descricao" name="descricao-item-novo" rows="5"></textarea>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="button" class="btn btn-success" id="salvar-item-novo">Salvar Item</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="col-12 mt-3">
                                <label for="ficha-itens" class="form-label">Itens</label>
                                <div id="itensContainer"></div>
                            </div>



                            <div class="col-12">
                                <label for="ficha-observacoes_itens" class="form-label">Observações Itens</label>
                                <textarea name="observacoes_itens" id="ficha-observacoes_itens" class="form-control observacoes_itens-personagem" placeholder="Observações Itens" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="jogador" role="tabpanel">

                            <div class="row g-3">

                                <div class="col-12 mb-2">
                                    <h4>Espaço do Jogador, no caso você <?php echo htmlspecialchars($_SESSION['username']); ?></h4>
                                    <div class="text-muted" role="alert">
                                        Jogador, use este espaço para contar quem você é no mundo real: sua história, seus caminhos, o que faz, onde vive, com quem compartilha a jornada. Aqui também é o lugar para registrar descobertas importantes, estratégias, fraquezas de inimigos, rotas secretas e segredos que não podem ser esquecidos. Tudo aquilo que faz de você mais do que um avatar: um verdadeiro explorador entre mundos.<br>
                                    </div>
                                    <br>
                                    <span class="text-danger"><em>O Sistema não se responsabiliza por memórias perdidas.</em></span>
                                    <br>
                                    <label for="ficha-observacoes_jogador" class="form-label mt-3">Observações do Jogador</label>
                                    <textarea
                                        name="observacoes_jogador"
                                        id="ficha-observacoes_jogador"
                                        class="form-control observacoes_jogador-personagem"
                                        placeholder="Digite aqui suas anotações estratégicas ou pessoais..."
                                        rows="10"></textarea>
                                </div>
                                <h4 class="mt-1 my-1">Personagem</h4>
                                <div class="col-md-6 mb-1">
                                    <label for="ficha-nome_jogador" class="form-label">Nome do Personagem</label>
                                    <input type="text" name="nome_jogador" id="ficha-nome_jogador" class="form-control nome_jogador-personagem" placeholder="Nome do Personagem">

                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="ficha-profissao_jogador" class="form-label">Profissão do Personagem</label>
                                    <input type="text" name="profissao_jogador" id="ficha-profissao_jogador" class="form-control profissao_jogador-personagem" placeholder="Profissão do Personagem">
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label for="ficha-descricao_jogador">Descrição e Origem do Personagem</label>
                                    <textarea name="descricao_jogador" id="ficha-descricao_jogador" class="form-control descricao_jogador-personagem" placeholder="Descrição do Personagem" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="botao-salvar">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

</script>



<?php include('footer.php'); ?>