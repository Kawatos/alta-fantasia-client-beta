<?php
session_start();
require '../conexao.php';

header('Content-Type: application/json');

$id_ficha = $_POST['id_ficha'] ?? null;

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha não fornecido']);
    exit;
}

// Busca os itens da ficha
$stmtItens = $conn->prepare("SELECT * FROM itens WHERE id_ficha = :id_ficha");
$stmtItens->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtItens->execute();

$itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'sucesso', 'itens' => $itens]);
