<?php
session_start();
require 'conexao.php';

$usuario_id = $_SESSION['usuario_id'];
$campanha_id = $_POST['campanha_id'];
$fichas = $_POST['fichas'] ?? [];

foreach ($fichas as $ficha_id) {

    $stmt = $conn->prepare("
        INSERT IGNORE INTO campanha_fichas (
            campanha_id, ficha_id, usuario_id
        ) VALUES (
            :campanha_id, :ficha_id, :usuario_id
        )
    ");

    $stmt->bindParam(':campanha_id', $campanha_id);
    $stmt->bindParam(':ficha_id', $ficha_id);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
}

echo json_encode(['status' => 'sucesso']);