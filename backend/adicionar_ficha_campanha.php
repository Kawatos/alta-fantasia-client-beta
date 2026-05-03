<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$ficha_id = $_POST['ficha_id'] ?? 0;
$campanha_id = $_POST['campanha_id'] ?? 0;

/* verifica se é mestre */
$stmt = $conn->prepare("
    SELECT papel FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->bindParam(':campanha_id', $campanha_id);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || $user['papel'] !== 'mestre') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão']);
    exit;
}

/* adiciona */
$stmt = $conn->prepare("
    INSERT IGNORE INTO campanha_fichas (campanha_id, ficha_id)
    VALUES (:campanha_id, :ficha_id)
");

$stmt->bindParam(':campanha_id', $campanha_id);
$stmt->bindParam(':ficha_id', $ficha_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro']);
}