<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campanha_id = $_GET['campanha_id'] ?? 0;

/* dados da campanha */
$stmt = $conn->prepare("
    SELECT nome, descricao, codigo_convite
    FROM campanhas 
    WHERE id = :id
");
$stmt->bindParam(':id', $campanha_id, PDO::PARAM_INT);
$stmt->execute();
$campanha = $stmt->fetch(PDO::FETCH_ASSOC);

/* jogadores */
$stmt = $conn->prepare("
    SELECT u.id, u.username, cu.papel
    FROM campanha_usuarios cu
    JOIN usuarios u ON u.id = cu.usuario_id
    WHERE cu.campanha_id = :id
");
$stmt->bindParam(':id', $campanha_id, PDO::PARAM_INT);
$stmt->execute();
$jogadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* papel do usuário logado */
$stmt = $conn->prepare("
    SELECT papel 
    FROM campanha_usuarios
    WHERE campanha_id = :campanha_id
    AND usuario_id = :usuario_id
");
$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->execute();
$papel = $stmt->fetchColumn();

echo json_encode([
    'status' => 'sucesso',
    'campanha' => $campanha,
    'jogadores' => $jogadores,
    'papel' => $papel, // ← ESSENCIAL
    'usuario_logado' => $usuario_id // opcional, mas útil
]);