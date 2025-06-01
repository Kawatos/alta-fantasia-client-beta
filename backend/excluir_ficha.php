<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    echo json_encode(['erro' => 'Não autorizado']);
    exit;
}

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("DELETE FROM fichas WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $id, $usuario_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['sucesso' => true]);
    } else {
        echo json_encode(['erro' => 'Falha ao excluir ficha']);
    }

    $stmt->close();
    $conn->close();
}
