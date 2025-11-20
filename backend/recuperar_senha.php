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

if (!$update->execute()) {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar senha.']);
    exit;
}

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);

    // Configuração SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;
    $mail->Username   = 'altafantasiaprojectsup@gmail.com';
    $mail->Password   = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remetente e destinatário
    $mail->setFrom('altafantasiaprojectsup@gmail.com', 'Suporte - Alta Fantasia');
    $mail->addAddress($email);

    // Conteúdo
    $mail->Subject = 'Recuperacao de Senha - Alta Fantasia';
    $mail->Body    = "Uma nova senha foi gerada para sua conta.\n\nSenha temporária: {$novaSenha}\n\nRecomendamos alterar ao fazer login.";

    $mail->send();

    echo json_encode([
        'success' => true,
        'nova_senha' => "Sua nova senha foi enviada para seu E-mail!" 
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Sucesso! Senha atualizada, mas falha ao enviar e-mail: ' . $mail->ErrorInfo
    ]);
}
