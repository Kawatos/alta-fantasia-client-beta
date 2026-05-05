<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    echo json_encode(['erro' => 'Não autorizado']);
    exit;
}

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pode receber por JSON ou $_POST
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        $data = $_POST;
    }

    $id = intval($data['id'] ?? 0);
    $usuario_id = $_SESSION['usuario_id'];

    if ($id <= 0) {
        echo json_encode(['erro' => 'ID de ficha inválido.']);
        exit;
    }

    // ==========================================
    // 1. BUSCAR ARQUIVOS ANTES DE DELETAR
    // ==========================================
    $stmtBusca = $conn->prepare("SELECT personagem_imagem, arquivo_pdf FROM fichas WHERE id = :id AND usuario_id = :usuario_id");
    $stmtBusca->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtBusca->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmtBusca->execute();
    
    $ficha = $stmtBusca->fetch(PDO::FETCH_ASSOC);

    if ($ficha) {
        // 2. Apaga a imagem física (ignorando a imagem padrão)
        if (!empty($ficha['personagem_imagem']) && $ficha['personagem_imagem'] !== 'uploads/perfil-vazio.png') {
            $caminho_imagem = '../' . $ficha['personagem_imagem'];
            if (file_exists($caminho_imagem)) {
                unlink($caminho_imagem);
            }
        }

        // 3. Apaga o PDF físico
        if (!empty($ficha['arquivo_pdf'])) {
            $caminho_pdf = '../' . $ficha['arquivo_pdf'];
            if (file_exists($caminho_pdf)) {
                unlink($caminho_pdf);
            }
        }
    }

    // ==========================================
    // 4. DELETAR DO BANCO DE DADOS (Seu código original)
    // ==========================================
    $stmt = $conn->prepare("DELETE FROM fichas WHERE id = :id AND usuario_id = :usuario_id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['erro' => 'Ficha não encontrada ou você não tem permissão para excluí-la.']);
        }
    } else {
        echo json_encode(['erro' => 'Erro ao executar a exclusão.']);
    }
}