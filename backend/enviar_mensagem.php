<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
$campanha_id = isset($_POST['campanha_id']) ? (int)$_POST['campanha_id'] : 0;

if ($mensagem === '' || $campanha_id <= 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

/* valida se o usuário pertence à campanha */
$stmt = $conn->prepare("
    SELECT 1 FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");

$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->execute();

if (!$stmt->fetch()) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão']);
    exit;
}

/* ================================
   CRIPTOGRAFIA DA MENSAGEM
================================ */
// IMPORTANTE: Use uma chave complexa de 32 caracteres. (Idealmente, defina isso no seu conexao.php)
$chave_criptografia = "CHAVE_SECRETA_RPG_ALTA_FANTASIA!"; 
$metodo = 'aes-256-cbc';

// Gera um IV (Initialization Vector) aleatório para esta mensagem específica
$iv_tamanho = openssl_cipher_iv_length($metodo);
$iv = openssl_random_pseudo_bytes($iv_tamanho);

// Criptografa a mensagem (usamos OPENSSL_RAW_DATA para ter os bytes puros)
$mensagem_encriptada = openssl_encrypt($mensagem, $metodo, $chave_criptografia, OPENSSL_RAW_DATA, $iv);

// Junta o IV com a mensagem e converte para base64 (para salvar como texto seguro no banco)
$mensagem_final_banco = base64_encode($iv . $mensagem_encriptada);

/* ================================
   INSERE MENSAGEM CRIPTOGRAFADA
================================ */
$stmt = $conn->prepare("
    INSERT INTO mensagens (
        campanha_id,
        usuario_id,
        mensagem
    ) VALUES (
        :campanha_id,
        :usuario_id,
        :mensagem
    )
");

$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
// Salvamos a string base64 que contém o IV + Texto Criptografado
$stmt->bindParam(':mensagem', $mensagem_final_banco, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao enviar mensagem']);
}