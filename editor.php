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
            $sql = "SELECT id, nome_personagem, classe, nivel, descricao FROM fichas WHERE usuario_id = ?";
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
                                            data-id="<?php echo $ficha['id']; ?>"
                                            data-nome="<?php echo htmlspecialchars($ficha['nome_personagem']); ?>"
                                            data-classe="<?php echo htmlspecialchars($ficha['classe']); ?>">
                                            <i class="fas fa-edit me-1"></i>Editar
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

<!-- Modal de criação -->
<div class="modal fade" id="modalCriarFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCriarFicha">
                <div class="modal-header">
                    <h5 class="modal-title">Criar Novo Personagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nome" class="form-control mb-3" placeholder="Nome do Personagem" required>
                    <input type="text" name="classe" class="form-control" placeholder="Classe" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Criar</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<!-- Modal Unificado para Criar/Editar -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formFicha">
                <input type="hidden" name="id" id="ficha-id">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-modal">Criar Novo Personagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nome" id="ficha-nome" class="form-control mb-3" placeholder="Nome do Personagem" required>
                    <input type="text" name="classe" id="ficha-classe" class="form-control" placeholder="Classe" required>
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
                document.getElementById('ficha-classe').value = this.dataset.classe;

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