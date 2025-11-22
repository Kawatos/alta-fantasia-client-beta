<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require 'conexao.php'; // Sua conexão com o banco de dados
require '../vendor/autoload.php';

$token = $_POST['credential'] ?? '';
if (!$token) {
    echo json_encode(['success' => false, 'message' => 'Token não recebido.']);
    exit;
}

$CLIENT_ID = 'SEU_CLIENT_ID_WEB_AQUI'; // <-- 🚨 Atenção: Insira seu Client ID Web real

$payload = null;

try {
    // 1. Configura e verifica o token
    $client = new Google_Client(['client_id' => $CLIENT_ID]);
    $payload = $client->verifyIdToken($token);

} catch (\Exception $e) {
    // Captura e loga erros de verificação do token (por exemplo: token expirado, ID inválido)
    error_log("Google Login Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro na verificação do token: ' . $e->getMessage()]);
    exit; // Importante: Sai do script em caso de erro
}

// 2. Lógica de Login/Cadastro após a verificação
if ($payload) {
    $email = $payload['email'];
    $name = $payload['name'];
    $googleId = $payload['sub'];

    try {
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
            $username = $name;
        } else {
            $userId = $user['id'];
            $username = $user['username']; // Usa o username já existente
        }

        // Cria sessão
        $_SESSION['usuario_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true; // Adicione um flag de login

        // Sucesso: Retorna o redirecionamento
        echo json_encode(['success' => true, 'redirect' => 'editor.php']);
        
    } catch (PDOException $e) {
        // Captura erros de banco de dados
        error_log("Database Login Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
    }

} else {
    // Caso o payload seja nulo por algum motivo (embora o try/catch acima já deveria pegar a maioria)
    echo json_encode(['success' => false, 'message' => 'Token inválido ou não verificado.']);
}
?>