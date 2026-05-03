<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("
    SELECT 
        c.id,
        c.nome,
        c.descricao,
        cu.papel
    FROM campanhas c
    INNER JOIN campanha_usuarios cu 
        ON cu.campanha_id = c.id
    WHERE cu.usuario_id = :usuario_id
");

$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->execute();

$campanhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'status' => 'sucesso',
    'campanhas' => $campanhas
]);