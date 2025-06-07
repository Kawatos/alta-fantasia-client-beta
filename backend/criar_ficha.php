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
        intelecto_mod,
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

        $stmtPericias = $conn->prepare("
        INSERT INTO pericias (
            id_ficha,
            tenacidade_mod,
            fortitude_mod,
            reflexo_mod,
            controle_mod,
            atletismo_mod,
            corpoacorpo_mod,
            autocontrole_mod,
            resiliencia_mod,
            intuicao_mod,
            percepcao_mod,
            influencia_mod,
            atuacao_mod,
            c_arcano_mod,
            c_religioso_mod,
            c_historico_mod,
            c_natureza_mod,
            c_engenharia_mod,
            c_alquimia_mod,
            c_navegacao_mod,
            c_linguistico_mod,
            t_esgrima_mod,
            t_pontaria_mod,
            t_marcial_mod,
            t_metalurgia_mod,
            t_artesanato_mod,
            t_ladinagem_mod,
            t_instrumentos_mod,
            t_pilotagem_mod
        ) VALUES (
            :id_ficha,
            :tenacidade_mod,
            :fortitude_mod,
            :reflexo_mod,
            :controle_mod,
            :atletismo_mod,
            :corpoacorpo_mod,
            :autocontrole_mod,
            :resiliencia_mod,
            :intuicao_mod,
            :percepcao_mod,
            :influencia_mod,
            :atuacao_mod,
            :c_arcano_mod,
            :c_religioso_mod,
            :c_historico_mod,
            :c_natureza_mod,
            :c_engenharia_mod,
            :c_alquimia_mod,
            :c_navegacao_mod,
            :c_linguistico_mod,
            :t_esgrima_mod,
            :t_pontaria_mod,
            :t_marcial_mod,
            :t_metalurgia_mod,
            :t_artesanato_mod,
            :t_ladinagem_mod,
            :t_instrumentos_mod,
            :t_pilotagem_mod
        )
        ");

        $stmtPericias->bindParam(':id_ficha',         $ficha_id, PDO::PARAM_INT);
        $stmtPericias->bindParam(':tenacidade_mod',     $tenacidade_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':fortitude_mod',     $fortitude_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':reflexo_mod',     $reflexo_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':controle_mod',     $controle_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':atletismo_mod',     $atletismo_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':corpoacorpo_mod',     $corpoacorpo_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':autocontrole_mod',     $autocontrole_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':resiliencia_mod',     $resiliencia_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':intuicao_mod',     $intuicao_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':percepcao_mod',     $percepcao_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':influencia_mod',     $influencia_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':atuacao_mod',     $atuacao_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_arcano_mod',     $c_arcano_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_religioso_mod',     $c_religioso_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_historico_mod',     $c_historico_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_natureza_mod',     $c_natureza_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_engenharia_mod',     $c_engenharia_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_alquimia_mod',     $c_alquimia_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_navegacao_mod',     $c_navegacao_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':c_linguistico_mod',     $c_linguistico_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_esgrima_mod',     $t_esgrima_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_pontaria_mod',     $t_pontaria_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_marcial_mod',     $t_marcial_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_metalurgia_mod',     $t_metalurgia_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_artesanato_mod',     $t_artesanato_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_ladinagem_mod',     $t_ladinagem_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_instrumentos_mod',     $t_instrumentos_mod, PDO::PARAM_INT);
        $stmtPericias->bindParam(':t_pilotagem_mod',     $t_pilotagem_mod, PDO::PARAM_INT);

        if ($stmtPericias->execute()) {
            echo json_encode(['status' => 'sucesso']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar pericias']);
        }

    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar atributos']);
    }

} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha']);
}
