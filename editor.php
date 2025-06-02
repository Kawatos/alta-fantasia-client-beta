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
                    pericias_corporais
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
                                            data-pericias_corporais="<?= htmlspecialchars($ficha['pericias_corporais'] ?? '') ?>">
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
                    <div class="col-md-6">
                        <label for="ficha-nome" class="form-label">Nome do Personagem</label>
                        <input type="text" name="nome" id="ficha-nome" class="form-control" placeholder="Nome do Personagem" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-classe" class="form-label">Classe</label>
                        <input type="text" name="classe" id="ficha-classe" class="form-control" placeholder="Classe" required>
                    </div>
                    <div class="col-md-4">
                        <label for="ficha-nivel" class="form-label">Nível</label>
                        <input type="number" name="nivel" id="ficha-nivel" class="form-control" placeholder="Nível" min="1">
                    </div>
                    <div class="col-md-8">
                        <label for="ficha-raca" class="form-label">Raça</label>
                        <input type="text" name="raca" id="ficha-raca" class="form-control" placeholder="Raça">
                    </div>
                    <div class="col-12">
                        <label for="ficha-descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="ficha-descricao" class="form-control" placeholder="Descrição" rows="2"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="ficha-habilidades" class="form-label">Habilidades</label>
                        <textarea name="habilidades" id="ficha-habilidades" class="form-control" placeholder="Habilidades" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-magias_arcanas" class="form-label">Magias Arcanas</label>
                        <textarea name="magias_arcanas" id="ficha-magias_arcanas" class="form-control" placeholder="Magias Arcanas" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-magias_divinas" class="form-label">Magias Divinas</label>
                        <textarea name="magias_divinas" id="ficha-magias_divinas" class="form-control" placeholder="Magias Divinas" rows="2"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="ficha-itens" class="form-label">Itens</label>
                        <textarea name="itens" id="ficha-itens" class="form-control" placeholder="Itens" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-atributos_mentais" class="form-label">Atributos Mentais</label>
                        <input type="text" name="atributos_mentais" id="ficha-atributos_mentais" class="form-control" placeholder="Atributos Mentais">
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-atributos_corporais" class="form-label">Atributos Corporais</label>
                        <input type="text" name="atributos_corporais" id="ficha-atributos_corporais" class="form-control" placeholder="Atributos Corporais">
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-pericias_mentais" class="form-label">Perícias Mentais</label>
                        <textarea name="pericias_mentais" id="ficha-pericias_mentais" class="form-control" placeholder="Perícias Mentais" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="ficha-pericias_corporais" class="form-label">Perícias Corporais</label>
                        <textarea name="pericias_corporais" id="ficha-pericias_corporais" class="form-control" placeholder="Perícias Corporais" rows="2"></textarea>
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
                document.getElementById('ficha-nome').value = this.dataset.nome;

                console.log(this.dataset, "nome");
                document.getElementById('ficha-classe').value = this.dataset.classe;
                document.getElementById('ficha-nivel').value = this.dataset.nivel;
                document.getElementById('ficha-raca').value = this.dataset.raca;
                document.getElementById('ficha-descricao').value = this.dataset.descricao;
                document.getElementById('ficha-habilidades').value = this.dataset.habilidades;
                document.getElementById('ficha-magias_arcanas').value = this.dataset.magias_arcanas;
                document.getElementById('ficha-magias_divinas').value = this.dataset.magias_divinas;
                document.getElementById('ficha-itens').value = this.dataset.itens;
                document.getElementById('ficha-atributos_mentais').value = this.dataset.atributos_mentais;
                document.getElementById('ficha-atributos_corporais').value = this.dataset.atributos_corporais;
                document.getElementById('ficha-pericias_mentais').value = this.dataset.pericias_mentais;
                document.getElementById('ficha-pericias_corporais').value = this.dataset.pericias_corporais;


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