<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}
/* ficha */
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
$pericias_corporais = $_POST['pericias_corporais'] ?? '';
$pericias_mentais = $_POST['pericias_mentais'] ?? '';
$pontos_de_vida = $_POST['pontos_de_vida'] ?? '';
$pontos_de_mana = $_POST['pontos_de_mana'] ?? '';
$status = $_POST['status_personagem'] ?? '';
$pvs_atuais = $_POST['pvs_atuais'] ?? '';
$pms_atuais = $_POST['pms_atuais'] ?? '';
$deslocamento = $_POST['deslocamento'] ?? '';
$regen_pv = $_POST['regen_pv'] ?? '';
$regen_pm = $_POST['regen_pm'] ?? '';
$observacoes_atributos = $_POST['observacoes_atributos'] ?? '';
$observacoes_pericias = $_POST['observacoes_pericias'] ?? '';
$observacoes_habilidades = $_POST['observacoes_habilidades'] ?? '';
$observacoes_magias_arcanas = $_POST['observacoes_magias_arcanas'] ?? '';
$observacoes_magias_divinas = $_POST['observacoes_magias_divinas'] ?? '';
$observacoes_itens = $_POST['observacoes_itens'] ?? '';
$observacoes_jogador = $_POST['observacoes_jogador'] ?? '';
$divindade = $_POST['divindade'] ?? '';
$escola_arcana = $_POST['escola_arcana'] ?? '';

/* atributos */

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

$vigor_mod_nv = $_POST['vigor_mod_nv'] ?? 0;
$forca_mod_nv = $_POST['forca_mod_nv'] ?? 0;
$destreza_mod_nv = $_POST['destreza_mod_nv'] ?? 0;
$espirito_mod_nv = $_POST['espirito_mod_nv'] ?? 0;
$carisma_mod_nv = $_POST['carisma_mod_nv'] ?? 0;
$intelecto_mod_nv = $_POST['intelecto_mod_nv'] ?? 0;

// Verificação mínima obrigatória
if (empty($nome) || empty($classe)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha nome e classe']);
    exit;
}

$stmtFicha = $conn->prepare("
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
        pms_atuais,
        deslocamento,
        regen_pv,
        regen_pm,
        observacoes_atributos,
        observacoes_pericias,
        observacoes_habilidades,
        observacoes_magias_arcanas,
        observacoes_magias_divinas,
        observacoes_itens,
        observacoes_jogador,
        divindade,
        escola_arcana
    ) VALUES (
        :usuario_id,
        :nome_personagem,
        :classe,
        :nivel,
        :descricao,
        :raca,
        :habilidades,
        :magias_arcanas,
        :magias_divinas,
        :itens,
        :atributos_mentais,
        :atributos_corporais,
        :pericias_corporais,
        :pericias_mentais,
        :pontos_de_vida,
        :pontos_de_mana,
        :status_personagem,
        :pvs_atuais,
        :pms_atuais,
        :deslocamento,
        :regen_pv,
        :regen_pm,
        :observacoes_atributos,
        :observacoes_pericias,
        :observacoes_habilidades,
        :observacoes_magias_arcanas,
        :observacoes_magias_divinas,
        :observacoes_itens,
        :observacoes_jogador,
        :divindade,
        :escola_arcana
    )
");

$stmtFicha->bindParam(':usuario_id',         $usuario_id, PDO::PARAM_INT);
$stmtFicha->bindParam(':nome_personagem',    $nome, PDO::PARAM_STR);
$stmtFicha->bindParam(':classe',             $classe, PDO::PARAM_STR);
$stmtFicha->bindParam(':nivel',              $nivel, PDO::PARAM_INT);
$stmtFicha->bindParam(':descricao',          $descricao, PDO::PARAM_STR);
$stmtFicha->bindParam(':raca',               $raca, PDO::PARAM_STR);
$stmtFicha->bindParam(':habilidades',        $habilidades, PDO::PARAM_STR);
$stmtFicha->bindParam(':magias_arcanas',     $magias_arcanas, PDO::PARAM_STR);
$stmtFicha->bindParam(':magias_divinas',     $magias_divinas, PDO::PARAM_STR);
$stmtFicha->bindParam(':itens',              $itens, PDO::PARAM_STR);
$stmtFicha->bindParam(':atributos_mentais',  $atributos_mentais, PDO::PARAM_STR);
$stmtFicha->bindParam(':atributos_corporais', $atributos_corporais, PDO::PARAM_STR);
$stmtFicha->bindParam(':pericias_corporais', $pericias_corporais, PDO::PARAM_STR);
$stmtFicha->bindParam(':pericias_mentais',   $pericias_mentais, PDO::PARAM_STR);
$stmtFicha->bindParam(':pontos_de_vida',     $pontos_de_vida, PDO::PARAM_INT);
$stmtFicha->bindParam(':pontos_de_mana',     $pontos_de_mana, PDO::PARAM_INT);
$stmtFicha->bindParam(':status_personagem',  $status, PDO::PARAM_STR);
$stmtFicha->bindParam(':pvs_atuais',         $pvs_atuais, PDO::PARAM_INT);
$stmtFicha->bindParam(':pms_atuais',         $pms_atuais, PDO::PARAM_INT);
$stmtFicha->bindParam(':deslocamento',       $deslocamento, PDO::PARAM_INT);
$stmtFicha->bindParam(':regen_pv',           $regen_pv, PDO::PARAM_INT);
$stmtFicha->bindParam(':regen_pm',           $regen_pm, PDO::PARAM_INT);
$stmtFicha->bindParam(':observacoes_atributos', $observacoes_atributos, PDO::PARAM_STR);
$stmtFicha->bindParam(':observacoes_pericias', $observacoes_pericias, PDO::PARAM_STR);
$stmtFicha->bindParam(':observacoes_habilidades', $observacoes_habilidades, PDO::PARAM_STR);
$stmtFicha->bindParam(':observacoes_magias_arcanas', $observacoes_magias_arcanas, PDO::PARAM_STR);
$stmtFicha->bindParam(':observacoes_magias_divinas', $observacoes_magias_divinas, PDO::PARAM_STR);
$stmtFicha->bindParam(':observacoes_itens', $observacoes_itens, PDO::PARAM_STR);
$stmtFicha->bindParam(':observacoes_jogador', $observacoes_jogador, PDO::PARAM_STR);
$stmtFicha->bindParam(':divindade', $divindade, PDO::PARAM_STR);
$stmtFicha->bindParam(':escola_arcana', $escola_arcana, PDO::PARAM_STR);






if ($stmtFicha->execute()) {

    $ficha_id = $conn->lastInsertId();

    $stmtAtributos = $conn->prepare("
    INSERT INTO atributos (
        id_ficha,
        vigor,
        vigor_mod,
        forca,
        forca_mod,
        destreza,
        destreza_mod,
        espirito,
        espirito_mod,
        carisma,
        carisma_mod,
        intelecto,
        intelecto_mod
        vigor_mod_nv,
        forca_mod_nv,
        destreza_mod_nv,
        espirito_mod_nv,
        carisma_mod_nv,
        intelecto_mod_nv
    ) VALUES (
        :id_ficha,
        :vigor,
        :vigor_mod,
        :forca,
        :forca_mod,
        :destreza,
        :destreza_mod,
        :espirito,
        :espirito_mod,
        :carisma,
        :carisma_mod,
        :intelecto,
        :intelecto_mod,
        :vigor_mod_nv,
        :forca_mod_nv,
        :destreza_mod_nv,
        :espirito_mod_nv,
        :carisma_mod_nv,
        :intelecto_mod_nv
    )
");

    $stmtAtributos->bindParam(':id_ficha',         $ficha_id, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':vigor',             $vigor, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':vigor_mod',         $vigor_mod, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':forca',             $forca, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':forca_mod',         $forca_mod, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':destreza',         $destreza, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':destreza_mod',     $destreza_mod, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':espirito',         $sabedoria, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':espirito_mod',     $espirito_mod, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':carisma',         $carisma, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':carisma_mod',     $carisma_mod, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':intelecto',         $inteligencia, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':intelecto_mod',     $intelecto_mod, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':vigor_mod_nv',     $vigor_mod_nv, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':forca_mod_nv',     $forca_mod_nv, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':destreza_mod_nv',     $destreza_mod_nv, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':espirito_mod_nv',     $espirito_mod_nv, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':carisma_mod_nv',     $carisma_mod_nv, PDO::PARAM_INT);
    $stmtAtributos->bindParam(':intelecto_mod_nv',     $intelecto_mod_nv, PDO::PARAM_INT);

    if ($stmtAtributos->execute()) {
        echo json_encode(['status' => 'sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar atributos']);
    }

} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha']);
}
