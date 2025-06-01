<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    $data = $_POST;
}

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $senha_hash);
    $stmt->fetch();
    if (password_verify($password, $senha_hash)) {
        $_SESSION['usuario_id'] = $id;
        $_SESSION['username'] = $username;
        session_write_close();
        echo json_encode(['success' => true]);
        exit;
    }
}
echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
