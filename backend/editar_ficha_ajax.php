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
$pericias_corporais = $_POST['pericias_corporais'] ?? '';
$pericias_mentais = $_POST['pericias_mentais'] ?? '';
$pontos_de_vida = $_POST['pontos_de_vida'] ?? '';
$pontos_de_mana = $_POST['pontos_de_mana'] ?? '';
$status = $_POST['status_personagem'] ?? '';
$pvs_atuais = $_POST['pvs_atuais'] ?? '';
$pms_atuais = $_POST['pms_atuais'] ?? '';


$vigor = $_POST['vigor'] ?? 0;
$vigor_mod = $_POST['vigor_mod'] ?? 0;

$forca = $_POST['forca'] ?? 0;
$forca_mod = $_POST['forca_mod'] ?? 0;

$destreza = $_POST['destreza'] ?? 0;
$destreza_mod = $_POST['destreza_mod'] ?? 0;

$inteligencia = $_POST['intelecto'] ?? 0;
$intelecto_mod = $_POST['intelecto_mod'] ?? 0;

$sabedoria = $_POST['espirito'] ?? 0;
$espirito_mod = $_POST['espirito_mod'] ?? 0;

$carisma = $_POST['carisma'] ?? 0;
$carisma_mod = $_POST['carisma_mod'] ?? 0;


$stmtFicha = $conn->prepare("
    UPDATE fichas SET
        nome_personagem = :nome_personagem,
        classe = :classe,
        nivel = :nivel,
        descricao = :descricao,
        raca = :raca,
        habilidades = :habilidades,
        magias_arcanas = :magias_arcanas,
        magias_divinas = :magias_divinas,
        itens = :itens,
        atributos_mentais = :atributos_mentais,
        atributos_corporais = :atributos_corporais,
        pericias_corporais = :pericias_corporais,
        pericias_mentais = :pericias_mentais,
        pontos_de_vida = :pontos_de_vida,
        pontos_de_mana = :pontos_de_mana,
        status_personagem = :status_personagem,
        pvs_atuais = :pvs_atuais,
        pms_atuais = :pms_atuais
    WHERE id = :id AND usuario_id = :usuario_id
");

$stmtFicha->bindParam(':nome_personagem', $nome);
$stmtFicha->bindParam(':classe', $classe);
$stmtFicha->bindParam(':nivel', $nivel);
$stmtFicha->bindParam(':id', $id);
$stmtFicha->bindParam(':usuario_id', $usuario_id);
$stmtFicha->bindParam(':descricao', $descricao);
$stmtFicha->bindParam(':raca', $raca);
$stmtFicha->bindParam(':habilidades', $habilidades);
$stmtFicha->bindParam(':magias_arcanas', $magias_arcanas);
$stmtFicha->bindParam(':magias_divinas', $magias_divinas);
$stmtFicha->bindParam(':itens', $itens);
$stmtFicha->bindParam(':atributos_mentais', $atributos_mentais);
$stmtFicha->bindParam(':atributos_corporais', $atributos_corporais);
$stmtFicha->bindParam(':pericias_corporais', $pericias_corporais);
$stmtFicha->bindParam(':pericias_mentais', $pericias_mentais);
$stmtFicha->bindParam(':pontos_de_vida', $pontos_de_vida);
$stmtFicha->bindParam(':pontos_de_mana', $pontos_de_mana);
$stmtFicha->bindParam(':status_personagem', $status);
$stmtFicha->bindParam(':pvs_atuais', $pvs_atuais);
$stmtFicha->bindParam(':pms_atuais', $pms_atuais);

if ($stmtFicha->execute()) {

    $stmtAtributos = $conn->prepare("
    UPDATE atributos SET
        vigor = :vigor,
        vigor_mod = :vigor_mod,
        forca = :forca,
        forca_mod = :forca_mod,
        destreza = :destreza,
        destreza_mod = :destreza_mod,
        espirito = :espirito,
        espirito_mod = :espirito_mod,
        carisma = :carisma,
        carisma_mod = :carisma_mod,
        intelecto = :intelecto,
        intelecto_mod = :intelecto_mod
    WHERE id_ficha = :id_ficha
    ");

    $stmtAtributos->bindParam(':id_ficha', $id);
    $stmtAtributos->bindParam(':vigor', $vigor);
    $stmtAtributos->bindParam(':vigor_mod', $vigor_mod);
    $stmtAtributos->bindParam(':forca', $forca);
    $stmtAtributos->bindParam(':forca_mod', $forca_mod);
    $stmtAtributos->bindParam(':destreza', $destreza);
    $stmtAtributos->bindParam(':destreza_mod', $destreza_mod);
    $stmtAtributos->bindParam(':espirito', $sabedoria);
    $stmtAtributos->bindParam(':espirito_mod', $espirito_mod);
    $stmtAtributos->bindParam(':carisma', $carisma);
    $stmtAtributos->bindParam(':carisma_mod', $carisma_mod);
    $stmtAtributos->bindParam(':intelecto', $inteligencia);
    $stmtAtributos->bindParam(':intelecto_mod', $intelecto_mod);

    if ($stmtAtributos->execute()) {
        echo json_encode(['status' => 'sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar atributos']);
    }

} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar ficha']);
}
