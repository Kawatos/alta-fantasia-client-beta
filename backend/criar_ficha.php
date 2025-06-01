<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$nome = $_POST['nome'] ?? '';
$classe = $_POST['classe'] ?? '';

if (empty($nome) || empty($classe)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha todos os campos']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO fichas (usuario_id, nome_personagem, classe, nivel, descricao) VALUES (?, ?, ?, 1, '')");
$stmt->bind_param("iss", $_SESSION['usuario_id'], $nome, $classe);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha']);
}
