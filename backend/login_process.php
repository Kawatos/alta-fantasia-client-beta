<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');

// Captura dados do corpo JSON ou POST
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    $data = $_POST;
}

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// Prepara a consulta com PDO
$stmt = $conn->prepare("SELECT id, senha, imagem FROM usuarios WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();

// Obtém o resultado
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['senha'])) {
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['username'] = $username;
    $_SESSION['imagem'] = $user['imagem'];

    session_write_close();
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
