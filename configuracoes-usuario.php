<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: bemvindo.php');
    exit;
}

require 'backend/conexao.php';

$idUsuario = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT username, email FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $idUsuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Configurações da Conta</h2>

    <form id="form-configuracoes-usuario">
        <div class="mb-3">
            <label for="novo_username" class="form-label">Novo Nome de Usuário</label>
            <input type="text" class="form-control" id="novo_username" name="novo_username"
                   value="<?= htmlspecialchars($usuario['username']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="novo_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="novo_email" name="novo_email"
                   value="<?= htmlspecialchars($usuario['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="nova_senha" class="form-label">Nova Senha</label>
            <input type="password" class="form-control" id="nova_senha" name="nova_senha">
        </div>

        <!-- Mensagem de feedback -->
        <div id="mensagem-feedback" class="mb-3" style="display: none;"></div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
    <p class="text-muted mt-3">Sim, essa tela não recebeu muito o carinho "artistico" do desenvolvedor, bem, até agora não, pelo menos.</p>
</div>

<script>
document.getElementById('form-configuracoes-usuario').addEventListener('submit', function(e) {
    e.preventDefault();

    const username = document.getElementById('novo_username').value;
    const email = document.getElementById('novo_email').value;
    const senha = document.getElementById('nova_senha').value;
    const feedback = document.getElementById('mensagem-feedback');

    fetch('backend/atualizar_usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            novo_username: username,
            novo_email: email,
            nova_senha: senha
        })
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
