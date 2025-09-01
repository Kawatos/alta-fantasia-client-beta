<?php
require 'conexao.php';
header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$username = $_POST['usuario'] ?? '';

if (!$email || !$username) {
    echo json_encode(['success' => false, 'message' => 'E-mail ou Usuário não informado.']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = :email AND username = :username");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':username', $username);
$stmt->execute();

$dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dadosUsuario) {
    echo json_encode(['success' => false, 'message' => 'E-mail ou Usuário não encontrado.']);
    exit;
}

// gera uma senha temporária segura (8 caracteres hexadecimais)
$novaSenha = substr(bin2hex(random_bytes(4)), 0, 8);
$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

$update = $conn->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
$update->bindParam(':senha', $senhaHash);
$update->bindParam(':id', $dadosUsuario['id']);

if ($update->execute()) {
    // TODO: futuramente enviar a senha por e-mail
    echo json_encode(['success' => true, 'nova_senha' => $novaSenha]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar senha.']);
}
