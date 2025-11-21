<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: bemvindo.php');
    exit;
}

require 'backend/conexao.php';

$idUsuario = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT username, email, imagem FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $idUsuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Configurações da Conta</h2>

    <form id="form-configuracoes-usuario" enctype="multipart/form-data">
        <div class="row">
            <!-- Campos do usuário (esquerda) -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="novo_username" class="form-label">Novo Nome de Usuário</label>
                    <input type="text" class="form-control" id="novo_username" name="novo_username"
                        value="<?= htmlspecialchars($usuario['username']) ?>">
                </div>

                <div class="mb-3">
                    <label for="novo_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="novo_email" name="novo_email"
                        value="<?= htmlspecialchars($usuario['email'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="nova_senha" class="form-label">Nova Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="nova_senha" name="nova_senha">
                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="nova_senha">
                            <i class="fas fa-eye text-primary"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Imagem de perfil (direita) -->
            <div class="col-md-4">
                <label class="form-label">Imagem de Perfil</label>
                <div class="text-center mb-2">
                    <img id="preview_imagem_usuario"
                        src="backend/uploads_usuario/<?= !empty($_SESSION['imagem']) ? $_SESSION['imagem'] : 'perfil-vazio.png' ?>"
                        alt="Preview da Imagem"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 12px; cursor: pointer;">

                </div>
                <div class="input-group">
                    <input type="file" class="form-control" id="imagem_usuario" name="imagem_usuario" accept="image/*">
                </div>
                <small class="text-muted">Máximo 2 MB</small>
            </div>
        </div>

        <!-- Mensagem de feedback -->
        <div id="mensagem-feedback" class="mb-3" style="display: none;"></div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>

    <p class="text-muted mt-3">Sim, essa tela não recebeu muito o carinho "artistico" do desenvolvedor, bem, até agora não, pelo menos.</p>
</div>

<script>
    const inputImagem = document.getElementById('imagem_usuario');
    const previewImagem = document.getElementById('preview_imagem_usuario');

    inputImagem.addEventListener('change', function() {
        const file = this.files[0];

        if (!file) return;

        if (file.size > 2 * 1024 * 1024) { // 2 MB
            alert('A imagem deve ter no máximo 2 MB.');
            this.value = ''; // limpa o input
            /* previewImagem.src = 'uploads/perfil-vazio.png'; */
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImagem.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Abrir input ao clicar na imagem
    previewImagem.addEventListener('click', () => {
        inputImagem.click();
    });

    document.getElementById('form-configuracoes-usuario').addEventListener('submit', function(e) {
        e.preventDefault();

        const feedback = document.getElementById('mensagem-feedback');
        const formData = new FormData();

        formData.append('novo_username', document.getElementById('novo_username').value);
        formData.append('novo_email', document.getElementById('novo_email').value);
        formData.append('nova_senha', document.getElementById('nova_senha').value);

        const imagemFile = document.getElementById('imagem_usuario').files[0];
        console.log('imagemFile', imagemFile)
        if (imagemFile) {
            formData.append('imagem_usuario', imagemFile);
        }

        fetch('backend/atualizar_usuario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedback.style.display = 'block';
                if (data.success) {
                    feedback.textContent = 'Alterações salvas com sucesso!';
                    feedback.className = 'text-success mb-3';
                } else {
                    feedback.textContent = data.message || 'Erro ao atualizar usuário.';
                    feedback.className = 'text-danger mb-3';
                }
            })
            .catch(() => {
                feedback.style.display = 'block';
                feedback.textContent = 'Erro de comunicação com o servidor.';
                feedback.className = 'text-danger mb-3';
            });
    });
</script>

<?php include 'footer.php'; ?>