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
            <h1 class="text-center mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

            <div class="d-grid gap-2 col-6 mx-auto mb-5">
                <button id="botaoCriarFicha" class="btn btn-primary">Criar Novo Personagem</button>
            </div>

            <h2 class="mb-4">Seus Personagens</h2>

            <?php
            require 'backend/conexao.php';

            $usuario_id = $_SESSION['usuario_id'];
            $sql = "
                SELECT 
                    id,
                    nome_personagem,
                    classe,
                    nivel,
                    descricao,
                    raca,
                    habilidades,
                    magias_arcanas,
                    magias_divinas,
                    itens,
                    atributos_mentais,
                    atributos_corporais,
                    pericias_mentais,
                    pericias_corporais,
                    pontos_de_vida,
                    pontos_de_mana,
                    status_personagem,
                    pvs_atuais,
                    pm_atuais
                FROM fichas
                WHERE usuario_id = ?
                ";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $usuario_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0): ?>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php while ($ficha = $result->fetch_assoc()): ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($ficha['nome_personagem']); ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($ficha['classe']) . ' Nível ' . htmlspecialchars($ficha['nivel']); ?></h6>
                                    <p class="card-text"><?php echo htmlspecialchars($ficha['descricao']); ?></p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-info btn-sm btn-editar"
                                            data-id="<?= $ficha['id'] ?>"
                                            data-nome="<?= htmlspecialchars($ficha['nome_personagem'] ?? '') ?>"
                                            data-classe="<?= htmlspecialchars($ficha['classe'] ?? '') ?>"
                                            data-nivel="<?= htmlspecialchars($ficha['nivel'] ?? '') ?>"
                                            data-raca="<?= htmlspecialchars($ficha['raca'] ?? '') ?>"
                                            data-descricao="<?= htmlspecialchars($ficha['descricao'] ?? '') ?>"
                                            data-habilidades="<?= htmlspecialchars($ficha['habilidades'] ?? '') ?>"
                                            data-magias_arcanas="<?= htmlspecialchars($ficha['magias_arcanas'] ?? '') ?>"
                                            data-magias_divinas="<?= htmlspecialchars($ficha['magias_divinas'] ?? '') ?>"
                                            data-itens="<?= htmlspecialchars($ficha['itens'] ?? '') ?>"
                                            data-atributos_mentais="<?= htmlspecialchars($ficha['atributos_mentais'] ?? '') ?>"
                                            data-atributos_corporais="<?= htmlspecialchars($ficha['atributos_corporais'] ?? '') ?>"
                                            data-pericias_mentais="<?= htmlspecialchars($ficha['pericias_mentais'] ?? '') ?>"
                                            data-pericias_corporais="<?= htmlspecialchars($ficha['pericias_corporais'] ?? '') ?>"
                                            data-pontos_de_vida="<?= htmlspecialchars($ficha['pontos_de_vida'] ?? '') ?>"
                                            data-pontos_de_mana="<?= htmlspecialchars($ficha['pontos_de_mana'] ?? '') ?>"
                                            data-status_personagem="<?= htmlspecialchars($ficha['status_personagem'] ?? '') ?>"
                                            data-pvs_atuais="<?= htmlspecialchars($ficha['pvs_atuais'] ?? '') ?>"
                                            data-pm_atuais="<?= htmlspecialchars($ficha['pm_atuais'] ?? '') ?>">
                                            Editar
                                        </button>

                                        <button class="btn btn-danger btn-sm excluir-ficha" data-id="<?php echo $ficha['id']; ?>">
                                            <i class="fas fa-trash-alt me-1"></i>Excluir
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
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
                    <h5 class="modal-title" id="titulo-modal">Criar Novo Personagem1</h5>
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
                            <button class="nav-link" id="tab-magias-arcanas" data-bs-toggle="tab" data-bs-target="#magias-arcanas" type="button" role="tab">Magias Arcanas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-magias-divinas" data-bs-toggle="tab" data-bs-target="#magias-divinas" type="button" role="tab">Magias Divinas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-itens" data-bs-toggle="tab" data-bs-target="#itens" type="button" role="tab">Itens</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="identificacao" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ficha-nome" class="form-label">Nome do Personagem</label>
                                    <input type="text" name="nome" id="ficha-nome" class="form-control nome-personagem" placeholder="Nome do Personagem" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-classe" class="form-label">Classe</label>
                                    <input type="text" name="classe" id="ficha-classe" class="form-control classe-personagem" placeholder="Classe" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="ficha-nivel" class="form-label">Nível</label>
                                    <input type="number" name="nivel" id="ficha-nivel" class="form-control nivel-personagem" placeholder="Nível" min="1">
                                </div>
                                <div class="col-md-4">
                                    <label for="ficha-status" class="form-label">Status</label>
                                    <input type="text" name="status" id="ficha-status" class="form-control status-personagem" placeholder="Status">
                                </div>
                                <div class="col-md-4">
                                    <label for="ficha-pontos_de_vida" class="form-label">Pontos de Vida</label>
                                    <input type="number" name="pontos_de_vida" id="ficha-pontos_de_vida" class="form-control pontos-de-vida-personagem" placeholder="Pontos de Vida">
                                </div>
                                <div class="col-md-4">
                                    <label for="ficha-pontos_de_mana" class="form-label">Pontos de Mana</label>
                                    <input type="number" name="pontos_de_mana" id="ficha-pontos_de_mana" class="form-control pontos-de-mana-personagem" placeholder="Pontos de Mana">
                                </div>
                                <div class="col-md-8">
                                    <label for="ficha-raca" class="form-label">Raça</label>
                                    <input type="text" name="raca" id="ficha-raca" class="form-control raca-personagem" placeholder="Raça">
                                </div>
                                <div class="col-12">
                                    <label for="ficha-descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="ficha-descricao" class="form-control descricao-personagem" placeholder="Descrição" rows="2"></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="atributos" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ficha-atributos_mentais" class="form-label">Atributos Mentais</label>
                                    <input type="text" name="atributos_mentais" id="ficha-atributos_mentais" class="form-control atributos-mentais-personagem" placeholder="Atributos Mentais">
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-atributos_corporais" class="form-label">Atributos Corporais</label>
                                    <input type="text" name="atributos_corporais" id="ficha-atributos_corporais" class="form-control atributos-corporais-personagem" placeholder="Atributos Corporais">
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pericias" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ficha-pericias_mentais" class="form-label">Perícias Mentais</label>
                                    <textarea name="pericias_mentais" id="ficha-pericias_mentais" class="form-control pericias-mentais-personagem" placeholder="Perícias Mentais" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="ficha-pericias_corporais" class="form-label">Perícias Corporais</label>
                                    <textarea name="pericias_corporais" id="ficha-pericias_corporais" class="form-control pericias-corporais-personagem" placeholder="Perícias Corporais" rows="2"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="habilidades" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="ficha-habilidades" class="form-label">Habilidades</label>
                                    <textarea name="habilidades" id="ficha-habilidades" class="form-control habilidades-personagem" placeholder="Habilidades" rows="2"></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="magias-arcanas" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ficha-magias_arcanas" class="form-label">Magias Arcanas</label>
                                    <textarea name="magias_arcanas" id="ficha-magias_arcanas" class="form-control magias-arcanas-personagem" placeholder="Magias Arcanas" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="magias-divinas" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="ficha-magias_divinas" class="form-label">Magias Divinas</label>
                                    <textarea name="magias_divinas" id="ficha-magias_divinas" class="form-control magias-divinas-personagem" placeholder="Magias Divinas" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="itens" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="ficha-itens" class="form-label">Itens</label>
                                    <textarea name="itens" id="ficha-itens" class="form-control itens-personagem" placeholder="Itens" rows="2"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="botao-salvar">Criar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let modoEdicao = false;

    document.addEventListener("DOMContentLoaded", function() {
        const modalFicha = new bootstrap.Modal(document.getElementById('modalFicha'));
        const form = document.getElementById('formFicha');

        // Botão para abrir em modo CRIAÇÃO
        document.querySelector('#botaoCriarFicha').addEventListener('click', function() {
            modoEdicao = false;
            document.getElementById('titulo-modal').textContent = 'Criar Novo Personagem';
            document.getElementById('botao-salvar').textContent = 'Criar';
            form.reset();
            document.getElementById('ficha-id').value = ''; // Limpa o campo ID
            modalFicha.show();
        });

        // Botões de edição
        document.querySelectorAll('.btn-editar').forEach(button => {
            button.addEventListener('click', function() {
                modoEdicao = true;
                document.getElementById('titulo-modal').textContent = 'Editar Personagem';

                document.getElementById('botao-salvar').textContent = 'Salvar';
                document.getElementById('ficha-id').value = this.dataset.id;
                document.querySelector('.nome-personagem').value = this.dataset.nome;

                document.querySelector('.classe-personagem').value = this.dataset.classe;
                document.querySelector('.nivel-personagem').value = this.dataset.nivel;
                document.querySelector('.raca-personagem').value = this.dataset.raca;
                document.querySelector('.descricao-personagem').value = this.dataset.descricao;
                document.querySelector('.habilidades-personagem').value = this.dataset.habilidades;
                document.querySelector('.magias-arcanas-personagem').value = this.dataset.magias_arcanas;
                document.querySelector('.magias-divinas-personagem').value = this.dataset.magias_divinas;
                document.querySelector('.itens-personagem').value = this.dataset.itens;
                document.querySelector('.atributos-mentais-personagem').value = this.dataset.atributos_mentais;
                document.querySelector('.atributos-corporais-personagem').value = this.dataset.atributos_corporais;
                document.querySelector('.pericias-mentais-personagem').value = this.dataset.pericias_mentais;
                document.querySelector('.pericias-corporais-personagem').value = this.dataset.pericias_corporais;
                document.querySelector('.pontos-de-vida-personagem').value = this.dataset.pontos_de_vida;
                document.querySelector('.pontos-de-mana-personagem').value = this.dataset.pontos_de_mana;
                document.querySelector('.status-personagem').value = this.dataset.status_personagem;
                document.querySelector('.pvs_atuais').value = this.dataset.pvs_atuais;
                document.querySelector('.pm_atuais').value = this.dataset.pm_atuais;


                modalFicha.show();
            });
        });

        // Enviar formulário
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const url = modoEdicao ? 'backend/editar_ficha_ajax.php' : 'backend/criar_ficha.php';

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data.status === 'sucesso') {
                        alert(modoEdicao ? 'Ficha atualizada com sucesso!' : 'Ficha criada com sucesso!');
                        location.reload();
                    } else {
                        alert(data.mensagem || 'Erro ao salvar');
                    }
                });
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".excluir-ficha").forEach(function(btn) {
            btn.addEventListener("click", function() {
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
</script>

<script>
    // Quando o modal for fechado, salva automaticamente se estiver no modo de edição
    const modalFicha = document.getElementById('modalFicha');
    modalFicha.addEventListener('hidden.bs.modal', function() {
        // Verifica se estava no modo de edição
        if (!modoEdicao) return;

        const form = document.getElementById('formFicha');
        const formData = new FormData(form);

        fetch('backend/editar_ficha_ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    location.reload();
                } else {
                    alert(data.mensagem || 'Erro ao salvar');
                }
            });
    });
</script>

<?php include('footer.php'); ?>