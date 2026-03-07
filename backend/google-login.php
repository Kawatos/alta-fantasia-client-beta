<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

session_start();

require 'conexao.php';

$CLIENT_ID = '';

$token = $_POST['credential'] ?? '';

if (!$token) {
    echo json_encode([
        'success' => false,
        'message' => 'Token não recebido'
    ]);
    exit;
}

$response = file_get_contents(
    "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token
);

if (!$response) {
    echo json_encode([
        'success' => false,
        'message' => 'Falha ao validar token'
    ]);
    exit;
}

$payload = json_decode($response, true);

if (!isset($payload['aud']) || $payload['aud'] !== $CLIENT_ID) {
    echo json_encode([
        'success' => false,
        'message' => 'Client ID inválido'
    ]);
    exit;
}

if (!isset($payload['email_verified']) || $payload['email_verified'] !== "true") {
    echo json_encode([
        'success' => false,
        'message' => 'Email não verificado'
    ]);
    exit;
}

$email = $payload['email'];
$name = $payload['name'] ?? 'Usuario';
$googleId = $payload['sub'];

try {


    $stmt = $conn->prepare(
        "SELECT id, username, imagem FROM usuarios WHERE email = :email"
    );

    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {

        $stmt = $conn->prepare(
            "INSERT INTO usuarios (username, email, google_id)
             VALUES (:username, :email, :google_id)"
        );

        $stmt->bindParam(':username', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':google_id', $googleId);

        $stmt->execute();

        $userId = $conn->lastInsertId();
        $username = $name;

    } else {
        $imagem = $user['imagem'];
        $userId = $user['id'];
        $username = $user['username'];
    
        // Atualiza google_id apenas se não existir
        $stmt = $conn->prepare(
            "UPDATE usuarios
             SET google_id = COALESCE(google_id, :google_id)
             WHERE id = :id"
        );
    
        $stmt->bindParam(':google_id', $googleId);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    $_SESSION['imagem'] = $imagem;
    $_SESSION['usuario_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;

    echo json_encode([
        'success' => true,
        'redirect' => 'editor.php'
    ]);

} catch (PDOException $e) {

    error_log("Login Google DB Error: " . $e->getMessage());

    echo json_encode([
        'success' => false,
        'message' => 'Erro no banco de dados'
    ]);

}