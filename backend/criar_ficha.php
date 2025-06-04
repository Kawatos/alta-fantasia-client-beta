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
/* $atributos_mentais_cru = $_POST['atributos_mentais'] ?? '';
$atributos_mentais = json_encode($atributos_mentais_cru);
$atributos_corporais_cru = $_POST['atributos_corporais'] ?? '';
$atributos_corporais = json_encode($atributos_corporais_cru); */
$pericias_corporais = $_POST['pericias_corporais'] ?? '';
$pericias_mentais = $_POST['pericias_mentais'] ?? '';
$pontos_de_vida = $_POST['pontos_de_vida'] ?? '';
$pontos_de_mana = $_POST['pontos_de_mana'] ?? '';
$status = $_POST['status_personagem'] ?? '';
$pvs_atuais = $_POST['pvs_atuais'] ?? '';
$pms_atuais = $_POST['pms_atuais'] ?? '';

$vigor = $_POST['vigor'] ?? 0;
$mod_vigor = $_POST['mod_vigor'] ?? 0;

$forca = $_POST['forca'] ?? 0;
$mod_forca = $_POST['mod_forca'] ?? 0;

$destreza = $_POST['destreza'] ?? 0;
$mod_destreza = $_POST['mod_destreza'] ?? 0;

$inteligencia = $_POST['intelecto'] ?? 0;
$mod_inteligencia = $_POST['mod_intelecto'] ?? 0;

$sabedoria = $_POST['espirito'] ?? 0;
$mod_sabedoria = $_POST['mod_espirito'] ?? 0;

$carisma = $_POST['carisma'] ?? 0;
$mod_carisma = $_POST['mod_carisma'] ?? 0;

$atributos_corporais = json_encode([
    'vigor' => $vigor,
    'mod_vigor' => $mod_vigor,
    'forca' => $forca,
    'mod_forca' => $mod_forca,
    'destreza' => $destreza,
    'mod_destreza' => $mod_destreza
]);

$atributos_mentais = json_encode([
    'intelecto' => $inteligencia,
    'mod_intelecto' => $mod_inteligencia,
    'espirito' => $sabedoria,
    'mod_espirito' => $mod_sabedoria,
    'carisma' => $carisma,
    'mod_carisma' => $mod_carisma
]);



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
        status_personagem,
        pvs_atuais,
        pms_atuais
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

// Certifique-se de que os tipos batem com os dados.
// i = inteiro, s = string

if (!$stmt) {
    die("Erro ao preparar a query: " . $conn->error);
}

$stmt->bind_param(
    "ississssssssssiisii", // agora com 19 caracteres
    $usuario_id,           // i
    $nome,                 // s
    $classe,               // s
    $nivel,                // i
    $descricao,            // s
    $raca,                 // s
    $habilidades,          // s
    $magias_arcanas,       // s
    $magias_divinas,       // s
    $itens,                // s
    $atributos_mentais,    // s
    $atributos_corporais,  // s
    $pericias_corporais,   // s
    $pericias_mentais,     // s
    $pontos_de_vida,       // i
    $pontos_de_mana,       // i
    $status,               // s
    $pvs_atuais,           // i
    $pms_atuais            // i
);


if ($stmt->execute()) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha']);
}
