<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$codigo = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';

if ($codigo === '') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Código obrigatório']);
    exit;
}

/* buscar campanha */
$stmt = $conn->prepare("
    SELECT id FROM campanhas
    WHERE codigo_convite = :codigo
");

$stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
$stmt->execute();

$campanha = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$campanha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Código inválido']);
    exit;
}

$campanha_id = $campanha['id'];

/* inserir usuário */
$stmtInsert = $conn->prepare("
    INSERT IGNORE INTO campanha_usuarios (
        usuario_id,
        campanha_id
    ) VALUES (
        :usuario_id,
        :campanha_id
    )
");

$stmtInsert->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmtInsert->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);

if ($stmtInsert->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao entrar na campanha']);
}