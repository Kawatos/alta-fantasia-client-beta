<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');
// Captura dados do corpo JSON ou POST
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    $data = $_POST;
}

// Validação Cloudflare Turnstile (apenas se CLOUDFLARE_TURNSTILE_SECRET estiver configurado no .env)
$turnstileSecret = env('CLOUDFLARE_TURNSTILE_SECRET', '');
if (!empty($turnstileSecret)) {
    $cf_token = $data['cf_token'] ?? ($_POST['cf_token'] ?? '');
    if (empty($cf_token)) {
        echo json_encode([
            'success' => false,
            'message' => 'Verificação anti-bot obrigatória.'
        ]);
        exit;
    }

    $verify = file_get_contents(
        "https://challenges.cloudflare.com/turnstile/v0/siteverify",
        false,
        stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded",
                'content' => http_build_query([
                    'secret' => $turnstileSecret,
                    'response' => $cf_token
                ])
            ]
        ])
    );

    $result = json_decode($verify, true);
    if (!$result || empty($result['success'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Verificação anti-bot falhou. Tente novamente.'
        ]);
        exit;
    }
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
    echo json_encode([
        'success' => true,
        'user' => [
            'id' => (int)$user['id'],
            'username' => $username,
            'imagem' => !empty($user['imagem']) ? 'backend/uploads_usuario/' . $user['imagem'] : null
        ]
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
