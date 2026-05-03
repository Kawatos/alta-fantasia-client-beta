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
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';

if ($campanha_id <= 0 || $nome === '') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
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

/* ✏️ Atualiza */
$stmt = $conn->prepare("
    UPDATE campanhas
    SET nome = :nome,
        descricao = :descricao
    WHERE id = :campanha_id
");

$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao atualizar']);
}