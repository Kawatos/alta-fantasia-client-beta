<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id_ficha = $_POST['id_ficha'] ?? null;

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha não fornecido']);
    exit;
}

$stmtFicha = $conn->prepare("SELECT * FROM fichas WHERE id = :id AND usuario_id = :usuario_id");
$stmtFicha->bindParam(':id', $id_ficha, PDO::PARAM_INT);
$stmtFicha->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmtFicha->execute();

$ficha = $stmtFicha->fetch(PDO::FETCH_ASSOC);

$stmtAtributos = $conn->prepare("SELECT * FROM atributos WHERE id_ficha = :id_ficha");
$stmtAtributos->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtAtributos->execute();

$atributos = $stmtAtributos->fetch(PDO::FETCH_ASSOC);

$stmtPericias = $conn->prepare("SELECT * FROM pericias WHERE id_ficha = :id_ficha");
$stmtPericias->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtPericias->execute();

$pericias = $stmtPericias->fetch(PDO::FETCH_ASSOC);

if ($ficha) {
    if ($atributos) {
        if ($pericias) {
            echo json_encode(['status' => 'sucesso', 'ficha' => $ficha, 'atributos' => $atributos, 'pericias' => $pericias]);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Pericias não encontradas']);
        }
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Atributos não encontrados']);
    }
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Ficha não encontrada']);
}
