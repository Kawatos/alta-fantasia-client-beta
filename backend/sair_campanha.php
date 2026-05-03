<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campanha_id = isset($_POST['campanha_id']) ? (int)$_POST['campanha_id'] : 0;

if ($campanha_id <= 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Campanha inválida']);
    exit;
}

/* 1. Verificar se o usuário é o Mestre */
$stmt = $conn->prepare("SELECT papel FROM campanha_usuarios WHERE usuario_id = :uid AND campanha_id = :cid");
$stmt->execute([':uid' => $usuario_id, ':cid' => $campanha_id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$res) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Você não faz parte desta campanha.']);
    exit;
}

if ($res['papel'] === 'mestre') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'O mestre não pode sair da campanha. Você deve excluí-la ou transferir o cargo.']);
    exit;
}

/* 2. Remover o usuário da campanha */
$stmt = $conn->prepare("DELETE FROM campanha_usuarios WHERE usuario_id = :uid AND campanha_id = :cid");

if ($stmt->execute([':uid' => $usuario_id, ':cid' => $campanha_id])) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao processar a saída.']);
}