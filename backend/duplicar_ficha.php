<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    echo json_encode(['erro' => 'Não autorizado']);
    exit;
}

require 'conexao.php';

function copiarTabela($conn, $tabela, $coluna_fk, $nome_pk, $id_original, $id_novo) {
    $stmt = $conn->prepare("SELECT * FROM `$tabela` WHERE `$coluna_fk` = :id_original");
    $stmt->execute(['id_original' => $id_original]);
    $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($linhas as $linha) {
        unset($linha[$nome_pk]); 
        $linha[$coluna_fk] = $id_novo; 

        $chaves = array_keys($linha);
        $colunas = implode(', ', array_map(function($k) { return "`$k`"; }, $chaves));
        $placeholders = ':' . implode(', :', $chaves);

        $sql = "INSERT INTO `$tabela` ($colunas) VALUES ($placeholders)";
        $conn->prepare($sql)->execute($linha);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
    $id_original = intval($data['id'] ?? 0);
    $usuario_id = $_SESSION['usuario_id'];

    if ($id_original <= 0) {
        echo json_encode(['erro' => 'ID de ficha inválido.']);
        exit;
    }

    try {
        $conn->beginTransaction();

        // 1. Busca a ficha original
        $stmtOrigem = $conn->prepare("SELECT * FROM fichas WHERE id = :id AND usuario_id = :usuario_id");
        $stmtOrigem->execute(['id' => $id_original, 'usuario_id' => $usuario_id]);
        $ficha_original = $stmtOrigem->fetch(PDO::FETCH_ASSOC);

        if (!$ficha_original) {
            echo json_encode(['erro' => 'Ficha não encontrada ou sem permissão']);
            exit;
        }

        // 2. Prepara os dados para a cópia
        unset($ficha_original['id']); 
        $ficha_original['nome_personagem'] .= ' (Cópia)';

        // ==========================================
        // CLONAGEM FÍSICA DE ARQUIVOS (IMAGEM E PDF)
        // ==========================================
        $diretorio_uploads = '../uploads/';

        // Se a imagem existir e não for a imagem padrão "perfil-vazio.png"
        if (!empty($ficha_original['personagem_imagem']) && $ficha_original['personagem_imagem'] !== 'uploads/perfil-vazio.png') {
            $caminho_img_original = '../' . $ficha_original['personagem_imagem'];
            
            if (file_exists($caminho_img_original)) {
                $ext = pathinfo($caminho_img_original, PATHINFO_EXTENSION);
                // Gera um novo nome único para a imagem da cópia
                $novo_nome_img = 'avatar_copy_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                
                if (copy($caminho_img_original, $diretorio_uploads . $novo_nome_img)) {
                    // Atualiza o array para salvar o novo caminho no banco
                    $ficha_original['personagem_imagem'] = 'uploads/' . $novo_nome_img;
                }
            }
        }

        // Se for uma ficha do tipo arquivo e tiver PDF, clona o PDF também
        if (($ficha_original['tipo_ficha'] ?? '') === 'arquivo' && !empty($ficha_original['arquivo_pdf'])) {
            $caminho_pdf_original = '../' . $ficha_original['arquivo_pdf'];
            
            if (file_exists($caminho_pdf_original)) {
                $novo_nome_pdf = 'ficha_copy_' . time() . '_' . rand(1000, 9999) . '.pdf';
                
                if (copy($caminho_pdf_original, $diretorio_uploads . $novo_nome_pdf)) {
                    // Atualiza o array para salvar o novo caminho do PDF no banco
                    $ficha_original['arquivo_pdf'] = 'uploads/' . $novo_nome_pdf;
                }
            }
        }
        // ==========================================

        // Monta a query dinâmica para a tabela 'fichas'
        $colunasFicha = implode(', ', array_map(function ($k) { return "`$k`"; }, array_keys($ficha_original)));
        $placeholdersFicha = ':' . implode(', :', array_keys($ficha_original));
        
        $sqlNovaFicha = "INSERT INTO fichas ($colunasFicha) VALUES ($placeholdersFicha)";
        $conn->prepare($sqlNovaFicha)->execute($ficha_original);
        $id_novo = $conn->lastInsertId();

        // 3. Copia tabelas relacionadas (Apenas se for 'padrao')
        $tipo_ficha = $ficha_original['tipo_ficha'] ?? 'padrao';
        if ($tipo_ficha === 'padrao') {
            copiarTabela($conn, 'atributos', 'id_ficha', 'id_atributos', $id_original, $id_novo);
            copiarTabela($conn, 'pericias', 'id_ficha', 'id_pericias', $id_original, $id_novo);
            copiarTabela($conn, 'habilidades', 'id_ficha', 'id_habilidade', $id_original, $id_novo);
            copiarTabela($conn, 'magias', 'id_ficha', 'id_magias', $id_original, $id_novo);
            copiarTabela($conn, 'itens', 'id_ficha', 'id_item', $id_original, $id_novo);
        }

        $conn->commit();
        echo json_encode(['sucesso' => true, 'id_ficha' => $id_novo]);

    } catch (PDOException $e) {
        $conn->rollBack();
        echo json_encode(['erro' => 'Erro ao duplicar ficha: ' . $e->getMessage()]);
    }
}
?>