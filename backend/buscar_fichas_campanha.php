<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campanha_id = $_GET['campanha_id'] ?? 0;

/* verifica papel */
$stmt = $conn->prepare("
    SELECT papel FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->bindParam(':campanha_id', $campanha_id);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo json_encode(['status' => 'erro']);
    exit;
}

$isMestre = $usuario['papel'] === 'mestre';

/* busca fichas */
if ($isMestre) {

    $stmt = $conn->prepare("
        SELECT f.*
        FROM fichas f
        INNER JOIN campanha_fichas cf ON cf.ficha_id = f.id
        WHERE cf.campanha_id = :campanha_id
    ");

} else {

    $stmt = $conn->prepare("
        SELECT f.*
        FROM fichas f
        INNER JOIN campanha_fichas cf ON cf.ficha_id = f.id
        WHERE cf.campanha_id = :campanha_id
        AND f.usuario_id = :usuario_id
    ");

    $stmt->bindParam(':usuario_id', $usuario_id);
}

$stmt->bindParam(':campanha_id', $campanha_id);
$stmt->execute();

$fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'status' => 'sucesso',
    'fichas' => $fichas,
    'isMestre' => $isMestre
]);