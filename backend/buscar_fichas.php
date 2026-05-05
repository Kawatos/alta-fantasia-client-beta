<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campanha_id = $_GET['campanha_id'] ?? null;

/* Busca fichas do usuário (agora incluindo o tipo_ficha) */
$stmt = $conn->prepare("
    SELECT 
        f.id, 
        f.nome_personagem, 
        f.personagem_imagem, 
        f.classe, 
        f.nivel, 
        f.status_personagem,
        f.tipo_ficha, 
        cf.campanha_id IS NOT NULL AS na_campanha
    FROM fichas f
    LEFT JOIN campanha_fichas cf 
        ON cf.ficha_id = f.id 
        AND cf.campanha_id = :campanha_id
    WHERE f.usuario_id = :usuario_id
");

$stmt->execute([
    ':usuario_id' => $usuario_id,
    ':campanha_id' => $campanha_id
]);

$fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($fichas);