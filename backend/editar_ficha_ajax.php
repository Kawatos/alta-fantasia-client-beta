<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$classe = $_POST['classe'] ?? '';

if (!$id || empty($nome) || empty($classe)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

$stmt = $conn->prepare("UPDATE fichas SET nome_personagem = ?, classe = ? WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ssii", $nome, $classe, $id, $_SESSION['usuario_id']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar ficha']);
}
