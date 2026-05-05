<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id_ficha = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$tipo_ficha = isset($_POST['tipo_ficha']) ? trim($_POST['tipo_ficha']) : '';
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';

if ($id_ficha <= 0 || empty($tipo_ficha) || empty($nome)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos.']);
    exit;
}

// 1. Verifica se a ficha pertence ao usuário
$stmt = $conn->prepare("SELECT id, personagem_imagem, arquivo_pdf FROM fichas WHERE id = :id AND usuario_id = :uid");
$stmt->execute([':id' => $id_ficha, ':uid' => $usuario_id]);
$fichaAtual = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fichaAtual) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Ficha não encontrada ou sem permissão.']);
    exit;
}

// Variáveis de controle
$caminho_imagem = $fichaAtual['personagem_imagem'];
$caminho_pdf = $fichaAtual['arquivo_pdf'];
$bloco_notas = isset($_POST['bloco_notas']) ? trim($_POST['bloco_notas']) : null;
$diretorio_uploads = '../uploads/';

if (!is_dir($diretorio_uploads)) {
    mkdir($diretorio_uploads, 0777, true);
}

// ==========================================
// 2. VALIDAÇÃO E UPLOAD DA IMAGEM
// ==========================================
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $img_tmp = $_FILES['imagem']['tmp_name'];
    $img_tamanho = $_FILES['imagem']['size'];
    $img_tipo_real = mime_content_type($img_tmp);
    
    $tipos_imagem_permitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $limite_tamanho_imagem = 2 * 1024 * 1024; // 2MB

    if ($img_tamanho > $limite_tamanho_imagem) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'A imagem não pode ser maior que 2MB.']); exit;
    }
    if (!in_array($img_tipo_real, $tipos_imagem_permitidos)) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Formato de imagem inválido. Use JPG, PNG ou WEBP.']); exit;
    }

    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nome_imagem = 'avatar_' . $id_ficha . '_' . time() . '.' . $ext;
    $caminho_temporario = $diretorio_uploads . $nome_imagem;
    
    if (move_uploaded_file($img_tmp, $caminho_temporario)) {
        // Apaga a imagem antiga do servidor (se não for a padrão) para não lotar o HD
        if (!empty($caminho_imagem) && $caminho_imagem !== 'uploads/perfil-vazio.png' && file_exists('../' . $caminho_imagem)) {
            unlink('../' . $caminho_imagem);
        }
        $caminho_imagem = 'uploads/' . $nome_imagem; 
    }
}

// ==========================================
// 3. VALIDAÇÃO E UPLOAD DO PDF
// ==========================================
if ($tipo_ficha === 'arquivo' && isset($_FILES['arquivo_pdf']) && $_FILES['arquivo_pdf']['error'] === UPLOAD_ERR_OK) {
    $pdf_tmp = $_FILES['arquivo_pdf']['tmp_name'];
    $pdf_tamanho = $_FILES['arquivo_pdf']['size'];
    $pdf_tipo_real = mime_content_type($pdf_tmp);
    
    $limite_tamanho_pdf = 5 * 1024 * 1024; // 5MB

    if ($pdf_tamanho > $limite_tamanho_pdf) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'O PDF não pode ser maior que 5MB.']); exit;
    }
    if ($pdf_tipo_real !== 'application/pdf') {
        echo json_encode(['status' => 'erro', 'mensagem' => 'O arquivo enviado não é um PDF válido!']); exit;
    }

    $nome_pdf = 'ficha_' . $id_ficha . '_' . time() . '.pdf';
    $caminho_temporario_pdf = $diretorio_uploads . $nome_pdf;
    
    if (move_uploaded_file($pdf_tmp, $caminho_temporario_pdf)) {
        // Apaga o PDF antigo do servidor para liberar espaço
        if (!empty($caminho_pdf) && file_exists('../' . $caminho_pdf)) {
            unlink('../' . $caminho_pdf);
        }
        $caminho_pdf = 'uploads/' . $nome_pdf;
    }
}

// ==========================================
// 4. ATUALIZA O BANCO DE DADOS
// ==========================================
try {
    $query = "UPDATE fichas SET 
                nome_personagem = :nome, 
                personagem_imagem = :imagem, 
                bloco_notas = :bloco, 
                arquivo_pdf = :pdf 
              WHERE id = :id";
              
    $stmtUpdate = $conn->prepare($query);
    $stmtUpdate->execute([
        ':nome' => $nome,
        ':imagem' => $caminho_imagem,
        ':bloco' => ($tipo_ficha === 'bloco' ? $bloco_notas : null),
        ':pdf' => ($tipo_ficha === 'arquivo' ? $caminho_pdf : $fichaAtual['arquivo_pdf']),
        ':id' => $id_ficha
    ]);

    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Ficha salva com sucesso!']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco de dados: ' . $e->getMessage()]);
}