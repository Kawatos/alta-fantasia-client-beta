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
$inventario_interno_mod = $_POST['inventario_interno_mod'] ?? '';
$altura = $_POST['altura'] ?? '';
$idade = $_POST['idade'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$tendencia = $_POST['tendencia'] ?? '';


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

$tenacidade_treinamentos = $_POST['tenacidade_treinamentos'] ?? 0;
$tenacidade_proeficiencias = $_POST['tenacidade_proeficiencias'] ?? 0;
$fortitude_treinamentos = $_POST['fortitude_treinamentos'] ?? 0;
$fortitude_proeficiencias = $_POST['fortitude_proeficiencias'] ?? 0;
$reflexo_treinamentos = $_POST['reflexo_treinamentos'] ?? 0;
$reflexo_proeficiencias = $_POST['reflexo_proeficiencias'] ?? 0;
$controle_treinamentos = $_POST['controle_treinamentos'] ?? 0;
$controle_proeficiencias = $_POST['controle_proeficiencias'] ?? 0;
$atletismo_treinamentos = $_POST['atletismo_treinamentos'] ?? 0;
$atletismo_proeficiencias = $_POST['atletismo_proeficiencias'] ?? 0;
$corpoacorpo_treinamentos = $_POST['corpoacorpo_treinamentos'] ?? 0;
$corpoacorpo_proeficiencias = $_POST['corpoacorpo_proeficiencias'] ?? 0;
$autocontrole_treinamentos = $_POST['autocontrole_treinamentos'] ?? 0;
$autocontrole_proeficiencias = $_POST['autocontrole_proeficiencias'] ?? 0;
$resiliencia_treinamentos = $_POST['resiliencia_treinamentos'] ?? 0;
$resiliencia_proeficiencias = $_POST['resiliencia_proeficiencias'] ?? 0;
$intuicao_treinamentos = $_POST['intuicao_treinamentos'] ?? 0;
$intuicao_proeficiencias = $_POST['intuicao_proeficiencias'] ?? 0;
$percepcao_treinamentos = $_POST['percepcao_treinamentos'] ?? 0;
$percepcao_proeficiencias = $_POST['percepcao_proeficiencias'] ?? 0;
$influencia_treinamentos = $_POST['influencia_treinamentos'] ?? 0;
$influencia_proeficiencias = $_POST['influencia_proeficiencias'] ?? 0;
$atuacao_treinamentos = $_POST['atuacao_treinamentos'] ?? 0;
$atuacao_proeficiencias = $_POST['atuacao_proeficiencias'] ?? 0;    

$c_arcano_treinamentos = $_POST['c_arcano_treinamentos'] ?? 0;
$c_arcano_proeficiencias = $_POST['c_arcano_proeficiencias'] ?? 0;
$c_religioso_treinamentos = $_POST['c_religioso_treinamentos'] ?? 0;
$c_religioso_proeficiencias = $_POST['c_religioso_proeficiencias'] ?? 0;
$c_historico_treinamentos = $_POST['c_historico_treinamentos'] ?? 0;
$c_historico_proeficiencias = $_POST['c_historico_proeficiencias'] ?? 0;
$c_natureza_treinamentos = $_POST['c_natureza_treinamentos'] ?? 0;
$c_natureza_proeficiencias = $_POST['c_natureza_proeficiencias'] ?? 0;
$c_engenharia_treinamentos = $_POST['c_engenharia_treinamentos'] ?? 0;
$c_engenharia_proeficiencias = $_POST['c_engenharia_proeficiencias'] ?? 0;
$c_alquimia_treinamentos = $_POST['c_alquimia_treinamentos'] ?? 0;
$c_alquimia_proeficiencias = $_POST['c_alquimia_proeficiencias'] ?? 0;
$c_navegacao_treinamentos = $_POST['c_navegacao_treinamentos'] ?? 0;
$c_navegacao_proeficiencias = $_POST['c_navegacao_proeficiencias'] ?? 0;
$c_linguistico_treinamentos = $_POST['c_linguistico_treinamentos'] ?? 0;
$c_linguistico_proeficiencias = $_POST['c_linguistico_proeficiencias'] ?? 0;
$t_esgrima_treinamentos = $_POST['t_esgrima_treinamentos'] ?? 0;
$t_esgrima_proeficiencias = $_POST['t_esgrima_proeficiencias'] ?? 0;
$t_pontaria_treinamentos = $_POST['t_pontaria_treinamentos'] ?? 0;
$t_pontaria_proeficiencias = $_POST['t_pontaria_proeficiencias'] ?? 0;
$t_marcial_treinamentos = $_POST['t_marcial_treinamentos'] ?? 0;
$t_marcial_proeficiencias = $_POST['t_marcial_proeficiencias'] ?? 0;
$t_metalurgia_treinamentos = $_POST['t_metalurgia_treinamentos'] ?? 0;
$t_metalurgia_proeficiencias = $_POST['t_metalurgia_proeficiencias'] ?? 0;
$t_artesanato_treinamentos = $_POST['t_artesanato_treinamentos'] ?? 0;
$t_artesanato_proeficiencias = $_POST['t_artesanato_proeficiencias'] ?? 0;  
$t_ladinagem_treinamentos = $_POST['t_ladinagem_treinamentos'] ?? 0;
$t_ladinagem_proeficiencias = $_POST['t_ladinagem_proeficiencias'] ?? 0;
$t_instrumentos_treinamentos = $_POST['t_instrumentos_treinamentos'] ?? 0;
$t_instrumentos_proeficiencias = $_POST['t_instrumentos_proeficiencias'] ?? 0;
$t_pilotagem_treinamentos = $_POST['t_pilotagem_treinamentos'] ?? 0;
$t_pilotagem_proeficiencias = $_POST['t_pilotagem_proeficiencias'] ?? 0;

// Processa imagem se enviada
$caminhoImagem = null;
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    // Verificação de tamanho da imagem (máximo 3MB)
    $tamanhoMaximo = 3 * 1024 * 1024; // 3 MB em bytes
    if ($_FILES['imagem']['size'] > $tamanhoMaximo) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Imagem excede o tamanho máximo permitido de 3 MB.']);
        exit;
    }

    $pastaWeb = 'uploads/'; // usado para exibir no navegador (salvo no banco)
    $pastaSistema = __DIR__ . '/../uploads/'; // caminho real do sistema de arquivos

    if (!is_dir($pastaSistema)) {
        mkdir($pastaSistema, 0755, true);
    }

    $nomeOriginal = $_FILES['imagem']['name'];
    $nomeTemp = $_FILES['imagem']['tmp_name'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    $nomeArquivo = uniqid('img_') . "." . $extensao;

    $caminhoImagemSistema = $pastaSistema . $nomeArquivo;
    $caminhoImagem = $pastaWeb . $nomeArquivo; // esse vai para o banco

    if (!move_uploaded_file($nomeTemp, $caminhoImagemSistema)) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar a imagem.']);
        exit;
    }
}



$sqlImagem = '';
if ($caminhoImagem) {
    $sqlImagem = ', personagem_imagem = :personagem_imagem';
}



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
        carga_suportada_mod = :carga_suportada_mod,
        inventario_interno_mod = :inventario_interno_mod,
        altura = :altura,
        idade = :idade,
        sexo = :sexo,
        tendencia = :tendencia
        $sqlImagem
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
$stmtFicha->bindParam(':inventario_interno_mod', $inventario_interno_mod);
$stmtFicha->bindParam(':altura', $altura);
$stmtFicha->bindParam(':idade', $idade);
$stmtFicha->bindParam(':sexo', $sexo);
$stmtFicha->bindParam(':tendencia', $tendencia);
if ($caminhoImagem) {
    $stmtFicha->bindParam(':personagem_imagem', $caminhoImagem);
}


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
        t_pilotagem_mod = :t_pilotagem_mod,
        tenacidade_treinamentos = :tenacidade_treinamentos,
        tenacidade_proeficiencias = :tenacidade_proeficiencias,
        fortitude_treinamentos = :fortitude_treinamentos,
        fortitude_proeficiencias = :fortitude_proeficiencias,
        reflexo_treinamentos = :reflexo_treinamentos,
        reflexo_proeficiencias = :reflexo_proeficiencias,
        controle_treinamentos = :controle_treinamentos,
        controle_proeficiencias = :controle_proeficiencias,
        atletismo_treinamentos = :atletismo_treinamentos,
        atletismo_proeficiencias = :atletismo_proeficiencias,
        corpoacorpo_treinamentos = :corpoacorpo_treinamentos,
        corpoacorpo_proeficiencias = :corpoacorpo_proeficiencias,
        autocontrole_treinamentos = :autocontrole_treinamentos,
        autocontrole_proeficiencias = :autocontrole_proeficiencias,
        resiliencia_treinamentos = :resiliencia_treinamentos,
        resiliencia_proeficiencias = :resiliencia_proeficiencias,
        intuicao_treinamentos = :intuicao_treinamentos,
        intuicao_proeficiencias = :intuicao_proeficiencias,
        percepcao_treinamentos = :percepcao_treinamentos,
        percepcao_proeficiencias = :percepcao_proeficiencias,
        influencia_treinamentos = :influencia_treinamentos,
        influencia_proeficiencias = :influencia_proeficiencias,
        atuacao_treinamentos = :atuacao_treinamentos,
        atuacao_proeficiencias = :atuacao_proeficiencias,
        c_arcano_treinamentos = :c_arcano_treinamentos,
        c_arcano_proeficiencias = :c_arcano_proeficiencias,
        c_religioso_treinamentos = :c_religioso_treinamentos,
        c_religioso_proeficiencias = :c_religioso_proeficiencias,
        c_historico_treinamentos = :c_historico_treinamentos,
        c_historico_proeficiencias = :c_historico_proeficiencias,
        c_natureza_treinamentos = :c_natureza_treinamentos,
        c_natureza_proeficiencias = :c_natureza_proeficiencias,
        c_engenharia_treinamentos = :c_engenharia_treinamentos,
        c_engenharia_proeficiencias = :c_engenharia_proeficiencias,
        c_alquimia_treinamentos = :c_alquimia_treinamentos,
        c_alquimia_proeficiencias = :c_alquimia_proeficiencias,
        c_navegacao_treinamentos = :c_navegacao_treinamentos,
        c_navegacao_proeficiencias = :c_navegacao_proeficiencias,
        c_linguistico_treinamentos = :c_linguistico_treinamentos,
        c_linguistico_proeficiencias = :c_linguistico_proeficiencias,
        t_esgrima_treinamentos = :t_esgrima_treinamentos,
        t_esgrima_proeficiencias = :t_esgrima_proeficiencias,
        t_pontaria_treinamentos = :t_pontaria_treinamentos,
        t_pontaria_proeficiencias = :t_pontaria_proeficiencias,
        t_marcial_treinamentos = :t_marcial_treinamentos,
        t_marcial_proeficiencias = :t_marcial_proeficiencias,
        t_metalurgia_treinamentos = :t_metalurgia_treinamentos,
        t_metalurgia_proeficiencias = :t_metalurgia_proeficiencias,
        t_artesanato_treinamentos = :t_artesanato_treinamentos,
        t_artesanato_proeficiencias = :t_artesanato_proeficiencias,
        t_ladinagem_treinamentos = :t_ladinagem_treinamentos,
        t_ladinagem_proeficiencias = :t_ladinagem_proeficiencias,
        t_instrumentos_treinamentos = :t_instrumentos_treinamentos,
        t_instrumentos_proeficiencias = :t_instrumentos_proeficiencias,
        t_pilotagem_treinamentos = :t_pilotagem_treinamentos,
        t_pilotagem_proeficiencias = :t_pilotagem_proeficiencias
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
        $stmtPericias->bindParam(':tenacidade_treinamentos', $tenacidade_treinamentos);
        $stmtPericias->bindParam(':tenacidade_proeficiencias', $tenacidade_proeficiencias);
        $stmtPericias->bindParam(':fortitude_treinamentos', $fortitude_treinamentos);
        $stmtPericias->bindParam(':fortitude_proeficiencias', $fortitude_proeficiencias);
        $stmtPericias->bindParam(':reflexo_treinamentos', $reflexo_treinamentos);
        $stmtPericias->bindParam(':reflexo_proeficiencias', $reflexo_proeficiencias);
        $stmtPericias->bindParam(':controle_treinamentos', $controle_treinamentos);
        $stmtPericias->bindParam(':controle_proeficiencias', $controle_proeficiencias);
        $stmtPericias->bindParam(':atletismo_treinamentos', $atletismo_treinamentos);
        $stmtPericias->bindParam(':atletismo_proeficiencias', $atletismo_proeficiencias);
        $stmtPericias->bindParam(':corpoacorpo_treinamentos', $corpoacorpo_treinamentos);
        $stmtPericias->bindParam(':corpoacorpo_proeficiencias', $corpoacorpo_proeficiencias);
        $stmtPericias->bindParam(':autocontrole_treinamentos', $autocontrole_treinamentos);
        $stmtPericias->bindParam(':autocontrole_proeficiencias', $autocontrole_proeficiencias);
        $stmtPericias->bindParam(':resiliencia_treinamentos', $resiliencia_treinamentos);
        $stmtPericias->bindParam(':resiliencia_proeficiencias', $resiliencia_proeficiencias);
        $stmtPericias->bindParam(':intuicao_treinamentos', $intuicao_treinamentos);
        $stmtPericias->bindParam(':intuicao_proeficiencias', $intuicao_proeficiencias);
        $stmtPericias->bindParam(':percepcao_treinamentos', $percepcao_treinamentos);
        $stmtPericias->bindParam(':percepcao_proeficiencias', $percepcao_proeficiencias);
        $stmtPericias->bindParam(':influencia_treinamentos', $influencia_treinamentos);
        $stmtPericias->bindParam(':influencia_proeficiencias', $influencia_proeficiencias);
        $stmtPericias->bindParam(':atuacao_treinamentos', $atuacao_treinamentos);
        $stmtPericias->bindParam(':atuacao_proeficiencias', $atuacao_proeficiencias);
        $stmtPericias->bindParam(':c_arcano_treinamentos', $c_arcano_treinamentos);
        $stmtPericias->bindParam(':c_arcano_proeficiencias', $c_arcano_proeficiencias);
        $stmtPericias->bindParam(':c_religioso_treinamentos', $c_religioso_treinamentos);
        $stmtPericias->bindParam(':c_religioso_proeficiencias', $c_religioso_proeficiencias);
        $stmtPericias->bindParam(':c_historico_treinamentos', $c_historico_treinamentos);
        $stmtPericias->bindParam(':c_historico_proeficiencias', $c_historico_proeficiencias);
        $stmtPericias->bindParam(':c_natureza_treinamentos', $c_natureza_treinamentos);
        $stmtPericias->bindParam(':c_natureza_proeficiencias', $c_natureza_proeficiencias);
        $stmtPericias->bindParam(':c_engenharia_treinamentos', $c_engenharia_treinamentos);
        $stmtPericias->bindParam(':c_engenharia_proeficiencias', $c_engenharia_proeficiencias);
        $stmtPericias->bindParam(':c_alquimia_treinamentos', $c_alquimia_treinamentos);
        $stmtPericias->bindParam(':c_alquimia_proeficiencias', $c_alquimia_proeficiencias);
        $stmtPericias->bindParam(':c_navegacao_treinamentos', $c_navegacao_treinamentos);
        $stmtPericias->bindParam(':c_navegacao_proeficiencias', $c_navegacao_proeficiencias);
        $stmtPericias->bindParam(':c_linguistico_treinamentos', $c_linguistico_treinamentos);
        $stmtPericias->bindParam(':c_linguistico_proeficiencias', $c_linguistico_proeficiencias);
        $stmtPericias->bindParam(':t_esgrima_treinamentos', $t_esgrima_treinamentos);
        $stmtPericias->bindParam(':t_esgrima_proeficiencias', $t_esgrima_proeficiencias);
        $stmtPericias->bindParam(':t_pontaria_treinamentos', $t_pontaria_treinamentos);
        $stmtPericias->bindParam(':t_pontaria_proeficiencias', $t_pontaria_proeficiencias);
        $stmtPericias->bindParam(':t_marcial_treinamentos', $t_marcial_treinamentos);
        $stmtPericias->bindParam(':t_marcial_proeficiencias', $t_marcial_proeficiencias);
        $stmtPericias->bindParam(':t_metalurgia_treinamentos', $t_metalurgia_treinamentos);
        $stmtPericias->bindParam(':t_metalurgia_proeficiencias', $t_metalurgia_proeficiencias);
        $stmtPericias->bindParam(':t_artesanato_treinamentos', $t_artesanato_treinamentos);
        $stmtPericias->bindParam(':t_artesanato_proeficiencias', $t_artesanato_proeficiencias);
        $stmtPericias->bindParam(':t_ladinagem_treinamentos', $t_ladinagem_treinamentos);
        $stmtPericias->bindParam(':t_ladinagem_proeficiencias', $t_ladinagem_proeficiencias);
        $stmtPericias->bindParam(':t_instrumentos_treinamentos', $t_instrumentos_treinamentos);
        $stmtPericias->bindParam(':t_instrumentos_proeficiencias', $t_instrumentos_proeficiencias);
        $stmtPericias->bindParam(':t_pilotagem_treinamentos', $t_pilotagem_treinamentos);
        $stmtPericias->bindParam(':t_pilotagem_proeficiencias', $t_pilotagem_proeficiencias);

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
