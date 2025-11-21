<?php
session_start();
require '../conexao.php';

header('Content-Type: application/json');

$id_ficha = $_POST['id_ficha'] ?? null;

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha não fornecido']);
    exit;
}

// Busca as magias da ficha
$stmtMagias = $conn->prepare("SELECT * FROM magias WHERE id_ficha = :id_ficha");
$stmtMagias->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtMagias->execute();

$magias = $stmtMagias->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'sucesso', 'magias' => $magias]);
