<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$id = $_POST['id'] ?? null;
$usuario_id = $_SESSION['usuario_id'];

if (!$id) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha ausente']);
    exit;
}

// Captura os campos da ficha
$nome = $_POST['nome'] ?? '';
$classe = $_POST['classe'] ?? '';
$nivel = intval($_POST['nivel'] ?? 1);
$descricao = $_POST['descricao'] ?? '';
$raca = $_POST['raca'] ?? '';
$habilidades = $_POST['habilidades'] ?? '';
$magias_arcanas = $_POST['magias_arcanas'] ?? '';
$magias_divinas = $_POST['magias_divinas'] ?? '';
$itens = $_POST['itens'] ?? '';
$atributos_mentais = $_POST['atributos_mentais'] ?? '';
$atributos_corporais = $_POST['atributos_corporais'] ?? '';
$pericias_corporais = $_POST['pericias_corporais'] ?? '';
$pericias_mentais = $_POST['pericias_mentais'] ?? '';


// Atualiza no banco
$stmt = $conn->prepare("
    UPDATE fichas SET
        nome_personagem = ?, classe = ?, nivel = ?, descricao = ?, raca = ?, habilidades = ?,
        magias_arcanas = ?, magias_divinas = ?, itens = ?, atributos_mentais = ?, atributos_corporais = ?,
        pericias_corporais = ?, pericias_mentais = ?
    WHERE id = ? AND usuario_id = ?
");

$stmt->bind_param(
    "ssissssssssssii",
    $nome, $classe, $nivel, $descricao, $raca, $habilidades,
    $magias_arcanas, $magias_divinas, $itens, $atributos_mentais, $atributos_corporais,
    $pericias_corporais, $pericias_mentais, $id, $usuario_id
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar ficha']);
}
