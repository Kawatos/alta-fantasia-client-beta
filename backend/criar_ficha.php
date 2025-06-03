<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

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
$pontos_de_vida = $_POST['pontos_de_vida'] ?? '';
$pontos_de_mana = $_POST['pontos_de_mana'] ?? '';
$status = $_POST['status'] ?? '';

// Verificação mínima obrigatória
if (empty($nome) || empty($classe)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha nome e classe']);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO fichas (
        usuario_id,
        nome_personagem,
        classe,
        nivel,
        descricao,
        raca,
        habilidades,
        magias_arcanas,
        magias_divinas,
        itens,
        atributos_mentais,
        atributos_corporais,
        pericias_corporais,
        pericias_mentais,
        pontos_de_vida,
        pontos_de_mana,
        status_personagem
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ississssssssssiis",
    $usuario_id,
    $nome,
    $classe,
    $nivel,
    $descricao,
    $raca,
    $habilidades,
    $magias_arcanas,
    $magias_divinas,
    $itens,
    $atributos_mentais,
    $atributos_corporais,
    $pericias_corporais,
    $pericias_mentais,
    $pontos_de_vida,
    $pontos_de_mana,
    $status
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha']);
}
