<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$novoUsername = $data['novo_username'] ?? '';
$novoEmail = $data['novo_email'] ?? '';
$novaSenha = $data['nova_senha'] ?? '';

if (!$novoUsername || !$novoEmail || !$novaSenha) {
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
    exit;
}

$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE usuarios SET username = :username, email = :email, senha = :senha WHERE id = :id");
$stmt->bindParam(':username', $novoUsername);
$stmt->bindParam(':email', $novoEmail);
$stmt->bindParam(':senha', $senhaHash);
$stmt->bindParam(':id', $_SESSION['usuario_id']);

if ($stmt->execute()) {
    $_SESSION['username'] = $novoUsername;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar no banco de dados.']);
}
