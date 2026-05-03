<?php
session_start();
require 'conexao.php';

$usuario_logado = $_SESSION['usuario_id'];
$usuario_id = $_GET['usuario_id'];
$campanha_id = $_GET['campanha_id'];

/* papel do usuário logado na campanha */
$stmt = $conn->prepare("
    SELECT papel 
    FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");

$stmt->bindParam(':usuario_id', $usuario_logado);
$stmt->bindParam(':campanha_id', $campanha_id);
$stmt->execute();

$papel = $stmt->fetchColumn();

/* fichas do usuário na campanha */
$stmt = $conn->prepare("
    SELECT 
        f.id,
        f.nome_personagem,
        f.usuario_id,
        f.personagem_imagem
    FROM campanha_fichas cf
    JOIN fichas f ON f.id = cf.ficha_id
    WHERE cf.usuario_id = :usuario_id
    AND cf.campanha_id = :campanha_id
");

$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->bindParam(':campanha_id', $campanha_id);
$stmt->execute();

echo json_encode([
    'status' => 'sucesso',
    'papel' => $papel,
    'usuario_logado' => $usuario_logado,
    'fichas' => $stmt->fetchAll(PDO::FETCH_ASSOC)
]);