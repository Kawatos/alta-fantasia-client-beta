<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');

// Pega os dados do formulário (POST)
$username = $_POST['new_username'] ?? '';
$password = $_POST['new_password'] ?? '';

// Verifica se o usuário já existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();

if ($stmt->fetch()) {
    echo json_encode([
        'success' => false,
        'message' => 'Nome de usuário já está em uso.'
    ]);
    exit;
}

// Cria o hash da senha
$senha_hash = password_hash($password, PASSWORD_DEFAULT);

// Insere o novo usuário
$stmt = $conn->prepare("INSERT INTO usuarios (username, senha) VALUES (:username, :senha)");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':senha', $senha_hash);

if ($stmt->execute()) {
    // Pega o ID do usuário recém-cadastrado
    $novo_id = $conn->lastInsertId();

    // Define as variáveis de sessão
    $_SESSION['usuario_id'] = $novo_id;
    $_SESSION['username'] = $username;
    session_write_close();

    echo json_encode([
        'success' => true
    ]);
    exit;
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao cadastrar usuário. Tente novamente.'
    ]);
}
