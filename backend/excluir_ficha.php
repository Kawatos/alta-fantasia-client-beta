<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    echo json_encode(['erro' => 'Não autorizado']);
    exit;
}

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pode receber por JSON ou $_POST
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        $data = $_POST;
    }

    $id = intval($data['id'] ?? 0);
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("DELETE FROM fichas WHERE id = :id AND usuario_id = :usuario_id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['erro' => 'Ficha não encontrada ou você não tem permissão para excluí-la.']);
        }
    } else {
        echo json_encode(['erro' => 'Erro ao executar a exclusão.']);
    }
}
