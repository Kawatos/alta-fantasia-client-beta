<?php
session_start();
require '../conexao.php';

header('Content-Type: application/json');


$id_ficha = $_POST['id_ficha'] ?? null;

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha não fornecido']);
    exit;
}

// Busca as habilidades da ficha
$stmtHabilidades = $conn->prepare("SELECT * FROM habilidades WHERE id_ficha = :id_ficha");
$stmtHabilidades->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtHabilidades->execute();

$habilidades = $stmtHabilidades->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'sucesso', 'habilidades' => $habilidades]);
