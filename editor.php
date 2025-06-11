<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<?php include('header.php'); ?>




<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <form action="backend/logout.php" method="post">
                <button type="submit" class="btn btn-danger m-4">Logout</button>
            </form>
            <h1 class="text-center mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

            <div class="d-grid gap-2 col-6 mx-auto mb-5">
                <button id="botaoCriarFicha" class="btn btn-primary">Criar Novo Personagem</button>
            </div>

            <h2 class="mb-4">Seus Personagens</h2>

            <?php
            require 'backend/conexao.php';

            $usuario_id = $_SESSION['usuario_id'];
            $sqlFicha = "
                SELECT 
                    id,
                    nome_personagem,
                    classe,
                    nivel,
                    status_personagem
                FROM fichas
                WHERE usuario_id = :usuario_id
                ";

            $stmtFicha = $conn->prepare($sqlFicha);
            $stmtFicha->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmtFicha->execute();
            $resultFicha = $stmtFicha->fetchAll(PDO::FETCH_ASSOC);

            if (count($resultFicha) > 0): ?>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($resultFicha as $ficha): ?>

                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($ficha['nome_personagem']); ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($ficha['classe']) . ' Nível: ' . floor(htmlspecialchars($ficha['nivel'] / 100)); ?></h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($ficha['status_personagem']); ?></h6>



                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-info btn-sm btn-editar" data-id="<?= $ficha['id'] ?>">
                                            Editar
                                        </button>

                                        <button class="btn btn-danger btn-sm excluir-ficha" data-id="<?php echo $ficha['id']; ?>">
                                            <i class="fas fa-trash-alt me-1"></i>Excluir
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">Você ainda não criou nenhum personagem.</p>
            <?php endif; ?>

        </div>
    </div>
</div>


<!-- Modal Unificado para Criar/Editar -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formFicha">
                <input type="hidden" name="id" id="ficha-id">

                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-modal">Editar Personagem: <span class="nome-personagem-exibicao"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body row g-3">
                    <ul class="nav nav-tabs" id="fichaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-identificacao" data-bs-toggle="tab" data-bs-target="#identificacao" type="button" role="tab">Identificação</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-atributos" data-bs-toggle="tab" data-bs-target="#atributos" type="button" role="tab">Atributos</button>
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
                            <div class="row g-3">
                                <!-- Linha 1: Nome e Raça -->
                                <div class="col-md-6">
                                    <label for="ficha-nome" class="form-label">Nome do Personagem</label>
                                    <input type="text" name="nome" id="ficha-nome" class="form-control nome-personagem" placeholder="Nome do Personagem">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-raca" class="form-label">Raça</label>
                                    <select name="raca" id="ficha-raca" class="form-control raca-personagem">
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
                                        <option value="Anão">Humano</option>
                                    </select>
                                </div>

                                <!-- Linha 2: Classe e Nível -->
                                <div class="col-md-6">
                                    <label for="ficha-classe" class="form-label">Classe</label>
                                    <select name="classe" id="ficha-classe" class="form-control classe-personagem">
                                        <option value="" selected>Selecione uma Classe</option>
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

                                <!-- Linha 3: Status e Pontos de Vida -->
                                <div class="col-md-4">
                                    <label for="ficha-status" class="form-label">Status</label>
                                    <select name="status_personagem" id="'ficha-status'" class="form-control status-personagem" required>
                                        <option value="">Selecione um Status</option>
                                        <option value="Vivo" selected>Vivo</option>
                                        <option value="Morto">Morto</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="ficha-pontos_de_vida" class="form-label">Pontos de Vida</label>
                                    <input type="number" name="pontos_de_vida" id="ficha-pontos_de_vida" class="form-control pontos-de-vida-personagem" placeholder="Pontos de Vida">
                                </div>
                                <div class="col-md-4">
                                    <label for="ficha-pvs_atuais" class="form-label">Pontos de Vida Atuais</label>
                                    <input type="number" name="pvs_atuais" id="ficha-pvs_atuais" class="form-control pvs_atuais-personagem" placeholder="Pontos de Vida">
                                </div>

                                <!-- Linha 4: Pontos de Mana -->
                                <div class="col-md-6">
                                    <label for="ficha-pontos_de_mana" class="form-label">Pontos de Mana</label>
                                    <input type="number" name="pontos_de_mana" id="ficha-pontos_de_mana" class="form-control pontos-de-mana-personagem" placeholder="Pontos de Mana">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-pms_atuais" class="form-label">Pontos de Mana Atuais</label>
                                    <input type="number" name="pms_atuais" id="ficha-pms_atuais" class="form-control pms_atuais-personagem" placeholder="Pontos de Mana">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-regen_pv" class="form-label">Regeneração de Pontos de Vida</label>
                                    <input type="number" name="regen_pv" id="ficha-regen_pv" class="form-control regen_pv-personagem" placeholder="Regeneração de Pontos de Vida">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-regen_pm" class="form-label">Regeneração de Pontos de Mana</label>
                                    <input type="number" name="regen_pm" id="ficha-regen_pm" class="form-control regen_pm-personagem" placeholder="Regeneração de Pontos de Mana">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-deslocamento" class="form-label">Deslocamento</label>
                                    <input type="number" name="deslocamento" id="ficha-deslocamento" class="form-control deslocamento-personagem" placeholder="Deslocamento">
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
                                <div class="col-md-6">
                                    <label for="ficha-carga_suportada_mod" class="form-label">Carga Suportada Modificador</label>
                                    <input type="number" name="carga_suportada_mod" id="ficha-carga_suportada_mod" class="form-control carga_suportada_mod-personagem" placeholder="Carga Suportada Modificador">
                                </div>

                                <!-- Linha 5: Descrição -->
                                <div class="col-12">
                                    <label for="ficha-descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="ficha-descricao" class="form-control descricao-personagem" placeholder="Descrição" rows="2"></textarea>
                                </div>

                            </div>
                        </div>


                        <!-- Atributos -->
                        <div class="tab-pane fade" id="atributos" role="tabpanel">
                            <div class="row g-3">

                                <h5>Atributos Corporais </h5>
                                <div class="row">
                                    <!-- Exemplo: Vigor -->
                                    <div class="col-md-4">
                                        <label>Vigor</label>
                                        <div class="input-group">
                                            <input type="number" name="vigor_mod" class="form-control vigor_mod" placeholder="Mod" />
                                            <span class="input-group-text">+</span>
                                            <input type="number" name="vigor_mod_nv" class="form-control vigor_mod_nv" placeholder="Mod Nível" />
                                            <span class="input-group-text">=</span>
                                            <input type="number" name="vigor" class="form-control vigor" id="vigorId" readonly />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label>Força</label>
                                        <div class="input-group">
                                            <input type="number" name="forca_mod" class="form-control forca_mod" placeholder="Mod" />
                                            <span class="input-group-text">+</span>
                                            <input type="number" name="forca_mod_nv" class="form-control forca_mod_nv" placeholder="Mod Nível" />
                                            <span class="input-group-text">=</span>
                                            <input type="number" name="forca" class="form-control forca" id="forcaId" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Destreza</label>
                                        <div class="input-group">
                                            <input type="number" name="destreza_mod" class="form-control destreza_mod" placeholder="Mod" />
                                            <span class="input-group-text">+</span>
                                            <input type="number" name="destreza_mod_nv" class="form-control destreza_mod_nv" placeholder="Mod Nível" />
                                            <span class="input-group-text">=</span>
                                            <input type="number" name="destreza" class="form-control destreza" id="destrezaId" readonly />
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-3">Atributos Mentais</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Espírito</label>
                                        <div class="input-group">
                                            <input type="number" name="espirito_mod" class="form-control espirito_mod" placeholder="Mod" />
                                            <span class="input-group-text">+</span>
                                            <input type="number" name="espirito_mod_nv" class="form-control espirito_mod_nv" placeholder="Mod Nível" />
                                            <span class="input-group-text">=</span>
                                            <input type="number" name="espirito" class="form-control espirito" id="espiritoId" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Carisma</label>
                                        <div class="input-group">
                                            <input type="number" name="carisma_mod" class="form-control carisma_mod" placeholder="Mod" />
                                            <span class="input-group-text">+</span>
                                            <input type="number" name="carisma_mod_nv" class="form-control carisma_mod_nv" placeholder="Mod Nível" />
                                            <span class="input-group-text">=</span>
                                            <input type="number" name="carisma" class="form-control carisma" id="carismaId" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Intelecto</label>
                                        <div class="input-group">
                                            <input type="number" name="intelecto_mod" class="form-control intelecto_mod" placeholder="Mod" />
                                            <span class="input-group-text">+</span>
                                            <input type="number" name="intelecto_mod_nv" class="form-control intelecto_mod_nv" placeholder="Mod Nível" />
                                            <span class="input-group-text">=</span>
                                            <input type="number" name="intelecto" class="form-control intelecto" id="intelectoId" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <p>Estilo de cálculo (Mod + Mod Nível = Atributo)</p>
                                    <p>Total de Pontos de Modificadores de Nível: <span id="total-mod-nivel">0</span> / <span id="pontos-por-nivel">1</span></p>
                                </div>


                                <div class="col-12">
                                    <label for="ficha-observacoes_atributos" class="form-label">Observações Atributos</label>
                                    <textarea name="observacoes_atributos" id="ficha-observacoes_atributos" class="form-control observacoes_atributos-personagem" placeholder="Observações Atributos" rows="2"></textarea>
                                </div>

                            </div>
                        </div>

                        <!-- Perícias -->
                        <div class="tab-pane fade" id="pericias" role="tabpanel">

                            <div class="col-12 pericia border border-secondary-subtle rounded mb-3 p-3" data-atributo="vigor">

                                <div class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#pericia-tenacidade">
                                    <h4>Tenacidade = <span class="pericia-final"></span></h4>
                                    <h5 class="mb-3 text-muted">(T: <span class="treinado-valor">0</span> +
                                        P: <span class="proeficiente-valor">0</span> +
                                        M: <span class="modbase-valor">0</span> +
                                        A: <span class="atributotxt-valor">0</span>) </h5>
                                </div>

                                <!-- Conteúdo expandido -->
                                <div class="collapse" id="pericia-tenacidade">
                                    <div class="row g-2 align-items-end">

                                        <div class="col-6 col-md-3">
                                            <label class="form-label mb-1">Treinamentos</label>
                                            <input type="number" class="form-control form-control-sm treinado" />
                                        </div>

                                        <div class="col-6 col-md-3">
                                            <label class="form-label mb-1">Proeficiências</label>
                                            <input type="number" class="form-control form-control-sm proeficiente" />
                                        </div>

                                        <div class="col-6 col-md-3">
                                            <label class="form-label mb-1">Mod. Geral</label>
                                            <input type="number" class="form-control form-control-sm pericia-mod" />
                                        </div>

                                        <div class="col-6 col-md-3">
                                            <label class="form-label mb-1">Atributo</label>
                                            <input type="number" class="form-control form-control-sm atributo-valor" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ficha-tenacidade_mod" class="form-label">Modificador Tenacidade</label>
                                    <input type="number" name="tenacidade_mod" id="ficha-tenacidade_mod" class="form-control tenacidade_mod" placeholder="Modificador Tenacidade">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-fortitude_mod" class="form-label">Modificador Fortitude</label>
                                    <input type="number" name="fortitude_mod" id="ficha-fortitude_mod" class="form-control fortitude_mod" placeholder="Modificador Fortitude">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-reflexo_mod" class="form-label">Modificador Reflexo</label>
                                    <input type="number" name="reflexo_mod" id="ficha-reflexo_mod" class="form-control reflexo_mod" placeholder="Modificador Reflexo">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-controle_mod" class="form-label">Modificador Controle</label>
                                    <input type="number" name="controle_mod" id="ficha-controle_mod" class="form-control controle_mod" placeholder="Modificador Controle">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-atletismo_mod" class="form-label">Modificador Atletismo</label>
                                    <input type="number" name="atletismo_mod" id="ficha-atletismo_mod" class="form-control atletismo_mod" placeholder="Modificador Atletismo">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-corpoacorpo_mod" class="form-label">Modificador Corpo a Corpo</label>
                                    <input type="number" name="corpoacorpo_mod" id="ficha-corpoacorpo_mod" class="form-control corpoacorpo_mod" placeholder="Modificador Corpo a Corpo">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-autocontrole_mod" class="form-label">Modificador Autocontrole</label>
                                    <input type="number" name="autocontrole_mod" id="ficha-autocontrole_mod" class="form-control autocontrole_mod" placeholder="Modificador Autocontrole">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-resiliencia_mod" class="form-label">Modificador Resiliência</label>
                                    <input type="number" name="resiliencia_mod" id="ficha-resiliencia_mod" class="form-control resiliencia_mod" placeholder="Modificador Resiliência">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-intuicao_mod" class="form-label">Modificador Intuição</label>
                                    <input type="number" name="intuicao_mod" id="ficha-intuicao_mod" class="form-control intuicao_mod" placeholder="Modificador Intuição">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-percepcao_mod" class="form-label">Modificador Percepção</label>
                                    <input type="number" name="percepcao_mod" id="ficha-percepcao_mod" class="form-control percepcao_mod" placeholder="Modificador Percepção">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-influencia_mod" class="form-label">Modificador Influência</label>
                                    <input type="number" name="influencia_mod" id="ficha-influencia_mod" class="form-control influencia_mod" placeholder="Modificador Influência">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-atuacao_mod" class="form-label">Modificador Atuação</label>
                                    <input type="number" name="atuacao_mod" id="ficha-atuacao_mod" class="form-control atuacao_mod" placeholder="Modificador Atuação">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_arcano_mod" class="form-label">Modificador C. Arcano</label>
                                    <input type="number" name="c_arcano_mod" id="ficha-c_arcano_mod" class="form-control c_arcano_mod" placeholder="Modificador C. Arcana">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_religioso_mod" class="form-label">Modificador C. Religioso</label>
                                    <input type="number" name="c_religioso_mod" id="ficha-c_religioso_mod" class="form-control c_religioso_mod" placeholder="Modificador C. Religioso">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_historico_mod" class="form-label">Modificador C. Histórico</label>
                                    <input type="number" name="c_historico_mod" id="ficha-c_historico_mod" class="form-control c_historico_mod" placeholder="Modificador C. Histórico">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_natureza_mod" class="form-label">Modificador C. Natureza</label>
                                    <input type="number" name="c_natureza_mod" id="ficha-c_natureza_mod" class="form-control c_natureza_mod" placeholder="Modificador C. Natureza">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_engenharia_mod" class="form-label">Modificador C. Engenharia</label>
                                    <input type="number" name="c_engenharia_mod" id="ficha-c_engenharia_mod" class="form-control c_engenharia_mod" placeholder="Modificador C. Engenharia">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_alquimia_mod" class="form-label">Modificador C. Alquimia</label>
                                    <input type="number" name="c_alquimia_mod" id="ficha-c_alquimia_mod" class="form-control c_alquimia_mod" placeholder="Modificador C. Alquimia">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_navegacao_mod" class="form-label">Modificador C. Navegação</label>
                                    <input type="number" name="c_navegacao_mod" id="ficha-c_navegacao_mod" class="form-control c_navegacao_mod" placeholder="Modificador C. Navegação">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-c_linguistico_mod" class="form-label">Modificador C. Linguístico</label>
                                    <input type="number" name="c_linguistico_mod" id="ficha-c_linguistico_mod" class="form-control c_linguistico_mod" placeholder="Modificador C. Linguístico">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_esgrima_mod" class="form-label">Modificador T. Esgrima</label>
                                    <input type="number" name="t_esgrima_mod" id="ficha-t_esgrima_mod" class="form-control t_esgrima_mod" placeholder="Modificador T. Esgrima">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_pontaria_mod" class="form-label">Modificador T. Pontaria</label>
                                    <input type="number" name="t_pontaria_mod" id="ficha-t_pontaria_mod" class="form-control t_pontaria_mod" placeholder="Modificador T. Pontaria">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_marcial_mod" class="form-label">Modificador T. Marcial</label>
                                    <input type="number" name="t_marcial_mod" id="ficha-t_marcial_mod" class="form-control t_marcial_mod" placeholder="Modificador T. Marcial">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_metalurgia_mod" class="form-label">Modificador T. Metalurgia</label>
                                    <input type="number" name="t_metalurgia_mod" id="ficha-t_metalurgia_mod" class="form-control t_metalurgia_mod" placeholder="Modificador T. Metalurgia">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_artesanato_mod" class="form-label">Modificador T. Artesanato</label>
                                    <input type="number" name="t_artesanato_mod" id="ficha-t_artesanato_mod" class="form-control t_artesanato_mod" placeholder="Modificador T. Artesanato">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_ladinagem_mod" class="form-label">Modificador T. Ladinagem</label>
                                    <input type="number" name="t_ladinagem_mod" id="ficha-t_ladinagem_mod" class="form-control t_ladinagem_mod" placeholder="Modificador T. Ladinagem">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_instrumentos_mod" class="form-label">Modificador T. Instrumentos</label>
                                    <input type="number" name="t_instrumentos_mod" id="ficha-t_instrumentos_mod" class="form-control t_instrumentos_mod" placeholder="Modificador T. Instrumentos">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-t_pilotagem_mod" class="form-label">Modificador T. Pilotagem</label>
                                    <input type="number" name="t_pilotagem_mod" id="ficha-t_pilotagem_mod" class="form-control t_pilotagem_mod" placeholder="Modificador T. Pilotagem">
                                </div>

                                <div class="col-12">
                                    <label for="ficha-observacoes_pericias" class="form-label">Observações Perícias</label>
                                    <textarea name="observacoes_pericias" id="ficha-observacoes_pericias" class="form-control observacoes_pericias-personagem" placeholder="Observações Perícias" rows="2"></textarea>
                                </div>

                            </div>
                        </div>

                        <!-- Habilidades -->
                        <div class="tab-pane fade" id="habilidades" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary criar-habilidade" id="criar-habilidade" data-bs-toggle="collapse" data-bs-target="#collapseHabilidade">Criar Nova Habilidade</button>
                                    <button type="button" class="btn-close float-end" data-bs-toggle="collapse" data-bs-target="#collapseHabilidade" aria-label="Fechar"></button>
                                    <div class="collapse mt-3" id="collapseHabilidade">
                                        <div class="card card-body">

                                            <div class="col-md-6">
                                                <label for="habilidade-nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="habilidade-nome" name="nome-habilidade">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="habilidade-requisitos" class="form-label">Requisitos</label>
                                                <input type="text" class="form-control" id="habilidade-requisitos" name="requisitos">
                                            </div>
                                            <div class="col-12">
                                                <label for="habilidade-descricao" class="form-label">Descrição</label>
                                                <textarea class="form-control" id="habilidade-descricao" name="descricao" rows="3"></textarea>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="button" class="btn btn-success" id="salvar-habilidade-nova">Salvar Habilidade</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    // Fecha o collapse ao clicar fora dele
                                    $(document).on('click', function(e) {
                                        if (!$(e.target).closest('#collapseHabilidade, #criar-habilidade').length) {
                                            $('#collapseHabilidade').collapse('hide');
                                        }
                                    });
                                </script>

                            </div>


                            <div class="col-12 mt-3">
                                <label for="ficha-habilidades" class="form-label">Habilidades</label>
                                <div id="habilidadesContainer"></div>
                            </div>
                            <div class="col-12">
                                <label for="ficha-observacoes_habilidades" class="form-label">Observações Habilidades</label>
                                <textarea name="observacoes_habilidades" id="ficha-observacoes_habilidades" class="form-control observacoes_habilidades-personagem" placeholder="Observações Habilidades" rows="2"></textarea>
                            </div>

                        </div>
                        <!-- Magias -->
                        <div class="tab-pane fade" id="magias" role="tabpanel">
                            <div class="row g-3">
                                <!-- Botão Criar Magia -->
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary criar-magia" id="criar-magia" data-bs-toggle="collapse" data-bs-target="#collapseMagia">Criar Nova Magia</button>
                                    <button type="button" class="btn-close float-end" data-bs-toggle="collapse" data-bs-target="#collapseMagia" aria-label="Fechar"></button>
                                    <div class="collapse mt-3" id="collapseMagia">
                                        <div class="card card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="magia-nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="magia-nome">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="magia-tipo" class="form-label">Tipo</label>
                                                    <select class="form-control" id="magia-tipo">
                                                        <option value="arcana">Arcana</option>
                                                        <option value="divina">Divina</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="magia-nivel" class="form-label">Nível</label>
                                                    <input type="number" class="form-control" id="magia-nivel">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="magia-custo" class="form-label">Custo (PM)</label>
                                                    <input type="number" class="form-control" id="magia-custo">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="magia-alcance" class="form-label">Alcance</label>
                                                    <input type="text" class="form-control" id="magia-alcance">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="magia-duracao" class="form-label">Duração</label>
                                                    <input type="text" class="form-control" id="magia-duracao">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="magia-descritor" class="form-label">Descritor</label>
                                                    <input type="text" class="form-control" id="magia-descritor">
                                                </div>
                                                <div class="col-12">
                                                    <label for="magia-descricao" class="form-label">Descrição</label>
                                                    <textarea class="form-control" id="magia-descricao" rows="3"></textarea>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="button" class="btn btn-success" id="salvar-magia-nova">Salvar Magia</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha o collapse ao clicar fora -->
                                <script>
                                    $(document).on('click', function(e) {
                                        if (!$(e.target).closest('#collapseMagia, #criar-magia').length) {
                                            $('#collapseMagia').collapse('hide');
                                        }
                                    });
                                </script>

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
                                                <textarea name="observacoes_magias_arcanas" id="ficha-observacoes_magias_arcanas" class="form-control observacoes_magias_arcanas-personagem" placeholder="Observações Magias Arcanas" rows="2"></textarea>
                                            </div>
                                        </div>

                                        <!-- Aba de Magias Divinas -->
                                        <div class="tab-pane fade" id="tab-divina" role="tabpanel">
                                            <div id="magias-divinas"></div> <!-- Aqui o JS renderiza as magias divinas -->
                                            <div class="col-12 mt-3">
                                                <label for="ficha-observacoes_magias_divinas" class="form-label">Observações Magias Divinas</label>
                                                <textarea name="observacoes_magias_divinas" id="ficha-observacoes_magias_divinas" class="form-control observacoes_magias_divinas-personagem" placeholder="Observações Magias Divinas" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>



                        <!-- Itens -->
                        <div class="tab-pane fade" id="itens" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary criar-item" id="criar-item" data-bs-toggle="collapse" data-bs-target="#collapseItem">Criar Novo Item</button>
                                    <button type="button" class="btn-close float-end" data-bs-toggle="collapse" data-bs-target="#collapseItem" aria-label="Fechar"></button>

                                    <div class="collapse mt-3" id="collapseItem">
                                        <div class="card card-body">
                                            <div class="col-md-6">
                                                <label for="item-nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="item-nome" name="nome-item">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="item-rank" class="form-label">Rank</label>
                                                <input type="number" class="form-control" id="item-rank" name="rank">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="item-peso" class="form-label">Peso</label>
                                                <input type="number" class="form-control" id="item-peso" name="peso">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="item-volume" class="form-label">Volume</label>
                                                <input type="text" class="form-control" id="item-volume" name="volume">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="item-equipado" class="form-label">Equipado</label>
                                                <select class="form-control" id="item-equipado" name="equipado">
                                                    <option value="">Selecione</option>
                                                    <option value="sim">Sim</option>
                                                    <option value="nao">Não</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="item-descricao" class="form-label">Descrição</label>
                                                <textarea class="form-control" id="item-descricao" name="descricao" rows="3"></textarea>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="button" class="btn btn-success" id="salvar-item-novo">Salvar Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    // Fecha o collapse ao clicar fora dele
                                    $(document).on('click', function(e) {
                                        if (!$(e.target).closest('#collapseItem, #criar-item').length) {
                                            $('#collapseItem').collapse('hide');
                                        }
                                    });
                                </script>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="ficha-itens" class="form-label">Itens</label>
                                <div id="itensContainer"></div>
                            </div>

                            <div class="col-12">
                                <label for="ficha-observacoes_itens" class="form-label">Observações Itens</label>
                                <textarea name="observacoes_itens" id="ficha-observacoes_itens" class="form-control observacoes_itens-personagem" placeholder="Observações Itens" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="jogador" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="ficha-observacoes_jogador" class="form-label">Observações Jogador</label>
                                    <textarea name="observacoes_jogador" id="ficha-observacoes_jogador" class="form-control observacoes_jogador-personagem" placeholder="Observações Jogador" rows="2"></textarea>
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