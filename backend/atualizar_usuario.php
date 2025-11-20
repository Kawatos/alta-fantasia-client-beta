<?php
session_start();
require 'conexao.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

// Se vier via FormData, usamos $_POST e $_FILES
$novoUsername = $_POST['novo_username'] ?? null;
$novoEmail = $_POST['novo_email'] ?? null;
$novaSenha = $_POST['nova_senha'] ?? null;

// Monta dinamicamente a query de update
$campos = [];
$params = [];

if ($novoUsername) {
    $campos[] = "username = :username";
    $params[':username'] = $novoUsername;
}
if ($novoEmail) {
    $campos[] = "email = :email";
    $params[':email'] = $novoEmail;
}
if ($novaSenha) {
    $campos[] = "senha = :senha";
    $params[':senha'] = password_hash($novaSenha, PASSWORD_DEFAULT);
}

// Diretório da pasta de upload
$uploadDir = __DIR__ . '/uploads_usuario/';

// Cria a pasta caso não exista
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Processa imagem se enviada
if (isset($_FILES['imagem_usuario']) && $_FILES['imagem_usuario']['error'] === UPLOAD_ERR_OK) {
    $arquivoTmp = $_FILES['imagem_usuario']['tmp_name'];
    $nomeArquivo = $_FILES['imagem_usuario']['name'];
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
    $novoNomeImagem = 'perfil_' . $_SESSION['usuario_id'] . '.' . $extensao;
    $destino = $uploadDir . $novoNomeImagem;

    // Limite de 2 MB
    if ($_FILES['imagem_usuario']['size'] > 2 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'Imagem muito grande.']);
        exit;
    }

    if (move_uploaded_file($arquivoTmp, $destino)) {
        $campos[] = "imagem = :imagem";
        $params[':imagem'] = $novoNomeImagem;
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar imagem.']);
        exit;
    }
}


if (empty($campos)) {
    echo json_encode(['success' => false, 'message' => 'Nenhum campo para atualizar.']);
    exit;
}

$setClause = implode(", ", $campos);
$sql = "UPDATE usuarios SET $setClause WHERE id = :id";
$params[':id'] = $_SESSION['usuario_id'];

$stmt = $conn->prepare($sql);

if ($stmt->execute($params)) {
    // Atualiza a sessão se o username foi alterado
    if ($novoUsername) {
        $_SESSION['username'] = $novoUsername;
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar no banco de dados.']);
}
