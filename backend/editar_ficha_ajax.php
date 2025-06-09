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
$idiomas = $_POST['idiomas'] ?? '';
$carga_suportada_mod = $_POST['carga_suportada_mod'] ?? '';


/* Atributos */


$vigor_mod = $_POST['vigor_mod'] ?? 0;


$forca_mod = $_POST['forca_mod'] ?? 0;


$destreza_mod = $_POST['destreza_mod'] ?? 0;


$intelecto_mod = $_POST['intelecto_mod'] ?? 0;


$espirito_mod = $_POST['espirito_mod'] ?? 0;


$carisma_mod = $_POST['carisma_mod'] ?? 0;

$vigor_mod_nv = $_POST['vigor_mod_nv'] ?? 0;
$forca_mod_nv = $_POST['forca_mod_nv'] ?? 0;
$destreza_mod_nv = $_POST['destreza_mod_nv'] ?? 0;
$espirito_mod_nv = $_POST['espirito_mod_nv'] ?? 0;
$carisma_mod_nv = $_POST['carisma_mod_nv'] ?? 0;
$intelecto_mod_nv = $_POST['intelecto_mod_nv'] ?? 0;



/* Pericias */
$tenacidade_mod = $_POST['tenacidade_mod'] ?? 0;
$fortitude_mod = $_POST['fortitude_mod'] ?? 0;
$reflexo_mod = $_POST['reflexo_mod'] ?? 0;
$controle_mod = $_POST['controle_mod'] ?? 0;
$atletismo_mod = $_POST['atletismo_mod'] ?? 0;
$corpoacorpo_mod = $_POST['corpoacorpo_mod'] ?? 0;
$autocontrole_mod = $_POST['autocontrole_mod'] ?? 0;
$resiliencia_mod = $_POST['resiliencia_mod'] ?? 0;
$intuicao_mod = $_POST['intuicao_mod'] ?? 0;
$percepcao_mod = $_POST['percepcao_mod'] ?? 0;
$influencia_mod = $_POST['influencia_mod'] ?? 0;
$atuacao_mod = $_POST['atuacao_mod'] ?? 0;

$c_arcano_mod = $_POST['c_arcano_mod'] ?? 0;
$c_religioso_mod = $_POST['c_religioso_mod'] ?? 0;
$c_historico_mod = $_POST['c_historico_mod'] ?? 0;
$c_natureza_mod = $_POST['c_natureza_mod'] ?? 0;
$c_engenharia_mod = $_POST['c_engenharia_mod'] ?? 0;
$c_alquimia_mod = $_POST['c_alquimia_mod'] ?? 0;
$c_navegacao_mod = $_POST['c_navegacao_mod'] ?? 0;
$c_linguistico_mod = $_POST['c_linguistico_mod'] ?? 0;
$t_esgrima_mod = $_POST['t_esgrima_mod'] ?? 0;
$t_pontaria_mod = $_POST['t_pontaria_mod'] ?? 0;
$t_marcial_mod = $_POST['t_marcial_mod'] ?? 0;
$t_metalurgia_mod = $_POST['t_metalurgia_mod'] ?? 0;
$t_artesanato_mod = $_POST['t_artesanato_mod'] ?? 0;
$t_ladinagem_mod = $_POST['t_ladinagem_mod'] ?? 0;
$t_instrumentos_mod = $_POST['t_instrumentos_mod'] ?? 0;
$t_pilotagem_mod = $_POST['t_pilotagem_mod'] ?? 0;




$stmtFicha = $conn->prepare("
    UPDATE fichas SET
        nome_personagem = :nome_personagem,
        classe = :classe,
        nivel = :nivel,
        descricao = :descricao,
        raca = :raca,
        pontos_de_vida = :pontos_de_vida,
        pontos_de_mana = :pontos_de_mana,
        status_personagem = :status_personagem,
        pvs_atuais = :pvs_atuais,
        pms_atuais = :pms_atuais,
        deslocamento = :deslocamento,
        regen_pv = :regen_pv,
        regen_pm = :regen_pm,
        observacoes_atributos = :observacoes_atributos,
        observacoes_pericias = :observacoes_pericias,
        observacoes_habilidades = :observacoes_habilidades,
        observacoes_magias_arcanas = :observacoes_magias_arcanas,
        observacoes_magias_divinas = :observacoes_magias_divinas,
        observacoes_itens = :observacoes_itens,
        observacoes_jogador = :observacoes_jogador,
        divindade = :divindade,
        escola_arcana = :escola_arcana,
        idiomas = :idiomas,
        carga_suportada_mod = :carga_suportada_mod
    WHERE id = :id AND usuario_id = :usuario_id
");

$stmtFicha->bindParam(':nome_personagem', $nome);
$stmtFicha->bindParam(':classe', $classe);
$stmtFicha->bindParam(':nivel', $nivel);
$stmtFicha->bindParam(':id', $id);
$stmtFicha->bindParam(':usuario_id', $usuario_id);
$stmtFicha->bindParam(':descricao', $descricao);
$stmtFicha->bindParam(':raca', $raca);
$stmtFicha->bindParam(':pontos_de_vida', $pontos_de_vida);
$stmtFicha->bindParam(':pontos_de_mana', $pontos_de_mana);
$stmtFicha->bindParam(':status_personagem', $status);
$stmtFicha->bindParam(':pvs_atuais', $pvs_atuais);
$stmtFicha->bindParam(':pms_atuais', $pms_atuais);
$stmtFicha->bindParam(':deslocamento', $deslocamento);
$stmtFicha->bindParam(':regen_pv', $regen_pv);
$stmtFicha->bindParam(':regen_pm', $regen_pm);
$stmtFicha->bindParam(':observacoes_atributos', $observacoes_atributos);
$stmtFicha->bindParam(':observacoes_pericias', $observacoes_pericias);
$stmtFicha->bindParam(':observacoes_habilidades', $observacoes_habilidades);
$stmtFicha->bindParam(':observacoes_magias_arcanas', $observacoes_magias_arcanas);
$stmtFicha->bindParam(':observacoes_magias_divinas', $observacoes_magias_divinas);
$stmtFicha->bindParam(':observacoes_itens', $observacoes_itens);
$stmtFicha->bindParam(':observacoes_jogador', $observacoes_jogador);
$stmtFicha->bindParam(':divindade', $divindade);
$stmtFicha->bindParam(':escola_arcana', $escola_arcana);
$stmtFicha->bindParam(':idiomas', $idiomas);
$stmtFicha->bindParam(':carga_suportada_mod', $carga_suportada_mod);

if ($stmtFicha->execute()) {

    $stmtAtributos = $conn->prepare("
    UPDATE atributos SET
        vigor_mod = :vigor_mod,
        forca_mod = :forca_mod,
        destreza_mod = :destreza_mod,
        espirito_mod = :espirito_mod,
        carisma_mod = :carisma_mod,
        intelecto_mod = :intelecto_mod,
        vigor_mod_nv = :vigor_mod_nv,
        forca_mod_nv = :forca_mod_nv,
        destreza_mod_nv = :destreza_mod_nv,
        espirito_mod_nv = :espirito_mod_nv,
        carisma_mod_nv = :carisma_mod_nv,
        intelecto_mod_nv = :intelecto_mod_nv
    WHERE id_ficha = :id_ficha
    ");

    $stmtAtributos->bindParam(':id_ficha', $id);
    $stmtAtributos->bindParam(':vigor_mod', $vigor_mod);
    $stmtAtributos->bindParam(':forca_mod', $forca_mod);
    $stmtAtributos->bindParam(':destreza_mod', $destreza_mod);
    $stmtAtributos->bindParam(':espirito_mod', $espirito_mod);
    $stmtAtributos->bindParam(':carisma_mod', $carisma_mod);
    $stmtAtributos->bindParam(':intelecto_mod', $intelecto_mod);
    $stmtAtributos->bindParam(':vigor_mod_nv', $vigor_mod_nv);
    $stmtAtributos->bindParam(':forca_mod_nv', $forca_mod_nv);
    $stmtAtributos->bindParam(':destreza_mod_nv', $destreza_mod_nv);
    $stmtAtributos->bindParam(':espirito_mod_nv', $espirito_mod_nv);
    $stmtAtributos->bindParam(':carisma_mod_nv', $carisma_mod_nv);
    $stmtAtributos->bindParam(':intelecto_mod_nv', $intelecto_mod_nv);

    if ($stmtAtributos->execute()) {

        $stmtPericias = $conn->prepare("
        UPDATE pericias SET
        tenacidade_mod = :tenacidade_mod,
        fortitude_mod = :fortitude_mod,
        reflexo_mod = :reflexo_mod,
        controle_mod = :controle_mod,
        atletismo_mod = :atletismo_mod,
        corpoacorpo_mod = :corpoacorpo_mod,
        autocontrole_mod = :autocontrole_mod,
        resiliencia_mod = :resiliencia_mod,
        intuicao_mod = :intuicao_mod,
        percepcao_mod = :percepcao_mod,
        influencia_mod = :influencia_mod,
        atuacao_mod = :atuacao_mod,
        c_arcano_mod = :c_arcano_mod,
        c_religioso_mod = :c_religioso_mod,
        c_historico_mod = :c_historico_mod,
        c_natureza_mod = :c_natureza_mod,
        c_engenharia_mod = :c_engenharia_mod,
        c_alquimia_mod = :c_alquimia_mod,
        c_navegacao_mod = :c_navegacao_mod,
        c_linguistico_mod = :c_linguistico_mod,
        t_esgrima_mod = :t_esgrima_mod,
        t_pontaria_mod = :t_pontaria_mod,
        t_marcial_mod = :t_marcial_mod,
        t_metalurgia_mod = :t_metalurgia_mod,
        t_artesanato_mod = :t_artesanato_mod,
        t_ladinagem_mod = :t_ladinagem_mod,
        t_instrumentos_mod = :t_instrumentos_mod,
        t_pilotagem_mod = :t_pilotagem_mod
        WHERE id_ficha = :id_ficha
        ");

        $stmtPericias->bindParam(':id_ficha', $id);
        $stmtPericias->bindParam(':tenacidade_mod', $tenacidade_mod);
        $stmtPericias->bindParam(':fortitude_mod', $fortitude_mod);
        $stmtPericias->bindParam(':reflexo_mod', $reflexo_mod);
        $stmtPericias->bindParam(':controle_mod', $controle_mod);
        $stmtPericias->bindParam(':atletismo_mod', $atletismo_mod);
        $stmtPericias->bindParam(':corpoacorpo_mod', $corpoacorpo_mod);
        $stmtPericias->bindParam(':autocontrole_mod', $autocontrole_mod);
        $stmtPericias->bindParam(':resiliencia_mod', $resiliencia_mod);
        $stmtPericias->bindParam(':intuicao_mod', $intuicao_mod);
        $stmtPericias->bindParam(':percepcao_mod', $percepcao_mod);
        $stmtPericias->bindParam(':influencia_mod', $influencia_mod);
        $stmtPericias->bindParam(':atuacao_mod', $atuacao_mod);
        $stmtPericias->bindParam(':c_arcano_mod', $c_arcano_mod);
        $stmtPericias->bindParam(':c_religioso_mod', $c_religioso_mod);
        $stmtPericias->bindParam(':c_historico_mod', $c_historico_mod);
        $stmtPericias->bindParam(':c_natureza_mod', $c_natureza_mod);
        $stmtPericias->bindParam(':c_engenharia_mod', $c_engenharia_mod);
        $stmtPericias->bindParam(':c_alquimia_mod', $c_alquimia_mod);
        $stmtPericias->bindParam(':c_navegacao_mod', $c_navegacao_mod);
        $stmtPericias->bindParam(':c_linguistico_mod', $c_linguistico_mod);
        $stmtPericias->bindParam(':t_esgrima_mod', $t_esgrima_mod);
        $stmtPericias->bindParam(':t_pontaria_mod', $t_pontaria_mod);
        $stmtPericias->bindParam(':t_marcial_mod', $t_marcial_mod);
        $stmtPericias->bindParam(':t_metalurgia_mod', $t_metalurgia_mod);
        $stmtPericias->bindParam(':t_artesanato_mod', $t_artesanato_mod);
        $stmtPericias->bindParam(':t_ladinagem_mod', $t_ladinagem_mod);
        $stmtPericias->bindParam(':t_instrumentos_mod', $t_instrumentos_mod);
        $stmtPericias->bindParam(':t_pilotagem_mod', $t_pilotagem_mod);

        if ($stmtPericias->execute()) {
            echo json_encode(['status' => 'sucesso']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar pericias']);
        }
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar atributos']);
    }

} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao editar ficha']);
}
