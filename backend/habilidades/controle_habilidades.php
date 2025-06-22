<?php

session_start();
require '../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Dados enviados via POST
$acao = $_POST['acao'] ?? '';
$id_ficha = $_POST['id_ficha'] ?? null;
$id_habilidade = $_POST['id_habilidade'] ?? null;
$nome = $_POST['nome'] ?? '';
$requisitos = $_POST['requisitos'] ?? '';
$descricao = $_POST['descricao-habilidade'] ?? '';

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha é obrigatório']);
    exit;
}

try {
    switch ($acao) {
        case 'criar':

            $stmt = $conn->prepare("
                INSERT INTO habilidades (id_ficha, nome, requisitos, descricao)
                VALUES (:id_ficha, :nome, :requisitos, :descricao)
            ");
            $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':requisitos', $requisitos);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Habilidade criada']);
            break;

        case 'editar':
            if (!$id_habilidade || !$nome || !$requisitos || !$descricao) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos para editar']);
                exit;
            }

            $stmt = $conn->prepare("
                UPDATE habilidades 
                SET nome = :nome, requisitos = :requisitos, descricao = :descricao 
                WHERE id_habilidade = :id_habilidade AND id_ficha = :id_ficha
            ");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':requisitos', $requisitos);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':id_habilidade', $id_habilidade, PDO::PARAM_INT);
            $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Habilidade atualizada']);
            break;

        case 'excluir':
            if (!$id_habilidade) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'ID da habilidade é obrigatório para excluir']);
                exit;
            }

            $stmt = $conn->prepare("
                DELETE FROM habilidades 
                WHERE id_habilidade = :id_habilidade AND id_ficha = :id_ficha
            ");
            $stmt->bindParam(':id_habilidade', $id_habilidade, PDO::PARAM_INT);
            $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Habilidade excluída']);
            break;

        default:
            echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida']);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco: ' . $e->getMessage()]);
}
