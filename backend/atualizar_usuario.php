<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Pega os campos enviados, se existirem
$novoUsername = $data['novo_username'] ?? null;
$novoEmail = $data['novo_email'] ?? null;
$novaSenha = $data['nova_senha'] ?? null;

if (!$novoUsername && !$novoEmail && !$novaSenha) {
    echo json_encode(['success' => false, 'message' => 'Nenhum campo para atualizar.']);
    exit;
}

// Monta dinamicamente a query de update
$campos = [];
$params = [];

if ($novoUsername) {
    $campos[] = "username = :username";
    $params[':username'] = $novoUsername;
}
if ($novoEmail) {
    $campos[] = "email = :email";
    $params[':email'] = $novoEmail;
}
if ($novaSenha) {
    $campos[] = "senha = :senha";
    $params[':senha'] = password_hash($novaSenha, PASSWORD_DEFAULT);
}

$setClause = implode(", ", $campos);
$sql = "UPDATE usuarios SET $setClause WHERE id = :id";
$params[':id'] = $_SESSION['usuario_id'];

$stmt = $conn->prepare($sql);

if ($stmt->execute($params)) {
    // Atualiza a sessão se o username foi alterado
    if ($novoUsername) {
        $_SESSION['username'] = $novoUsername;
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar no banco de dados.']);
}
