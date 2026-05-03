<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$ficha_id = $_POST['ficha_id'] ?? 0;
$campanha_id = $_POST['campanha_id'] ?? 0;

/* valida dados */
if (!$ficha_id || !$campanha_id) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

/* pega papel do usuário */
$stmt = $conn->prepare("
    SELECT papel 
    FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");
$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não está na campanha']);
    exit;
}

/* pega dono da ficha */
$stmt = $conn->prepare("
    SELECT usuario_id 
    FROM fichas
    WHERE id = :ficha_id
");
$stmt->bindParam(':ficha_id', $ficha_id, PDO::PARAM_INT);
$stmt->execute();

$ficha = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Ficha não encontrada']);
    exit;
}

/* valida permissão */
$podeRemover = (
    $user['papel'] === 'mestre' ||
    $ficha['usuario_id'] == $usuario_id
);

if (!$podeRemover) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão']);
    exit;
}

/* remove vínculo */
$stmt = $conn->prepare("
    DELETE FROM campanha_fichas
    WHERE campanha_id = :campanha_id
    AND ficha_id = :ficha_id
");

$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->bindParam(':ficha_id', $ficha_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao remover']);
}