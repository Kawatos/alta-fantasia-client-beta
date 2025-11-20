<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require 'conexao.php';
require '../vendor/autoload.php'; // se usar Google Client Library

$token = $_POST['credential'] ?? '';
if (!$token) {
    echo json_encode(['success' => false, 'message' => 'Token não recebido.']);
    exit;
}

try {
    
    $client = new Google_Client(['client_id' => '']);

    
    $payload = $client->verifyIdToken($token);

    if ($payload) {
        
        echo json_encode(['success' => true, 'redirect' => 'editor.php']);

    } else {
        
        echo json_encode(['success' => false, 'message' => 'Token inválido.']);
    }

} catch (\Exception $e) {

    error_log("Google Login Error: " . $e->getMessage()); // Registra o erro completo no log do servidor
    echo json_encode(['success' => false, 'message' => 'Erro interno de verificação: ' . $e->getMessage()]);
}

if ($payload) {
    $email = $payload['email'];
    $name = $payload['name'];
    $googleId = $payload['sub'];

    // Verifica se usuário existe
    $stmt = $conn->prepare("SELECT id, username FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Cria novo usuário
        $stmt = $conn->prepare("INSERT INTO usuarios (username, email, google_id) VALUES (:username, :email, :google_id)");
        $stmt->bindParam(':username', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':google_id', $googleId);
        $stmt->execute();
        $userId = $conn->lastInsertId();
    } else {
        $userId = $user['id'];
    }

    // Cria sessão
    $_SESSION['usuario_id'] = $userId;
    $_SESSION['username'] = $name;

    echo json_encode(['success' => true, 'redirect' => 'editor.php']);
} else {
    echo json_encode(['success' => false, 'message' => 'Token inválido.']);
}
