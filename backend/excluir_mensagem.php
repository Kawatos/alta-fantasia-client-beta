<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$mensagem_id = isset($_POST['mensagem_id']) ? (int)$_POST['mensagem_id'] : 0;
$campanha_id = isset($_POST['campanha_id']) ? (int)$_POST['campanha_id'] : 0;

if ($mensagem_id <= 0 || $campanha_id <= 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

// 1. Pegar o papel do usuário na campanha
$stmt = $conn->prepare("SELECT papel FROM campanha_usuarios WHERE usuario_id = :uid AND campanha_id = :cid");
$stmt->execute([':uid' => $usuario_id, ':cid' => $campanha_id]);
$user_campanha = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_campanha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Você não está nesta campanha.']);
    exit;
}

$papel = $user_campanha['papel'];

// 2. Pegar o dono da mensagem
$stmt = $conn->prepare("SELECT usuario_id FROM mensagens WHERE id = :mid AND campanha_id = :cid");
$stmt->execute([':mid' => $mensagem_id, ':cid' => $campanha_id]);
$msg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$msg) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Mensagem não encontrada.']);
    exit;
}

$dono_mensagem = $msg['usuario_id'];

// 3. Verifica se tem permissão (é o dono OU é o mestre)
if ($dono_mensagem != $usuario_id && $papel !== 'mestre') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão para excluir esta mensagem.']);
    exit;
}

// 4. Exclui a mensagem
$stmt = $conn->prepare("DELETE FROM mensagens WHERE id = :mid AND campanha_id = :cid");
if ($stmt->execute([':mid' => $mensagem_id, ':cid' => $campanha_id])) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao excluir no banco de dados.']);
}