<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_logado = $_SESSION['usuario_id'];
$usuario_remover = $_POST['usuario_id'] ?? 0;
$campanha_id = $_POST['campanha_id'] ?? 0;

/* valida dados */
if (!$usuario_remover || !$campanha_id) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

/* pega papel do usuário logado */
$stmt = $conn->prepare("
    SELECT papel 
    FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");
$stmt->execute([
    ':usuario_id' => $usuario_logado,
    ':campanha_id' => $campanha_id
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || $user['papel'] !== 'mestre') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão']);
    exit;
}

/* impede remover o próprio mestre */
if ($usuario_remover == $usuario_logado) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Você não pode remover a si mesmo']);
    exit;
}

/* verifica se o alvo existe na campanha */
$stmt = $conn->prepare("
    SELECT * FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");
$stmt->execute([
    ':usuario_id' => $usuario_remover,
    ':campanha_id' => $campanha_id
]);

$alvo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alvo) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não está na campanha']);
    exit;
}

/* remove */
$stmt = $conn->prepare("
    DELETE FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");

$ok = $stmt->execute([
    ':usuario_id' => $usuario_remover,
    ':campanha_id' => $campanha_id
]);

echo json_encode([
    'status' => $ok ? 'sucesso' : 'erro'
]);