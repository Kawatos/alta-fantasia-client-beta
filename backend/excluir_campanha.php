<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$campanha_id = isset($_POST['campanha_id']) ? intval($_POST['campanha_id']) : 0;

if ($campanha_id <= 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID inválido']);
    exit;
}

/* 🔒 Verifica se é mestre */
$stmtPerm = $conn->prepare("
    SELECT papel 
    FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
      AND campanha_id = :campanha_id
    LIMIT 1
");

$stmtPerm->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmtPerm->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmtPerm->execute();

$permissao = $stmtPerm->fetch(PDO::FETCH_ASSOC);

if (!$permissao || $permissao['papel'] !== 'mestre') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão']);
    exit;
}

try {

    $conn->beginTransaction();

    /* 🧹 remover mensagens */
    $stmtMsg = $conn->prepare("
        DELETE FROM mensagens
        WHERE campanha_id = :campanha_id
    ");
    $stmtMsg->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
    $stmtMsg->execute();

    /* 🧹 remover vínculos */
    $stmtUsers = $conn->prepare("
        DELETE FROM campanha_usuarios
        WHERE campanha_id = :campanha_id
    ");
    $stmtUsers->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
    $stmtUsers->execute();

    /* 🧹 remover campanha */
    $stmtCamp = $conn->prepare("
        DELETE FROM campanhas
        WHERE id = :campanha_id
    ");
    $stmtCamp->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
    $stmtCamp->execute();

    $conn->commit();

    echo json_encode(['status' => 'sucesso']);

} catch (Exception $e) {

    $conn->rollBack();

    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao excluir campanha'
    ]);
}