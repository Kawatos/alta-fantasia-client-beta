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
$id_magia = $_POST['id_magia'] ?? null;
$ficha_id = $_POST['id_ficha'] ?? null;
$nome_magia = $_POST['nome_magia'] ?? '';
$tipo_magia = $_POST['tipo_magia'] ?? '';
$nivel = $_POST['nivel'] ?? null;
$custo_pm = $_POST['custo_pm'] ?? '';
$alcance = $_POST['alcance'] ?? '';
$duracao = $_POST['duracao'] ?? '';
$descritor = $_POST['descritor'] ?? '';
$descricao = $_POST['descricao-magia'] ?? '';

if (!$ficha_id) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha é obrigatório']);
    exit;
}

try {
    switch ($acao) {
        case 'criar':

            $stmt = $conn->prepare("
                INSERT INTO magias (
                    nome_magia, tipo_magia, nivel, custo_pm, alcance, duracao, descritor, descricao, ficha_id
                ) VALUES (
                    :nome_magia, :tipo_magia, :nivel, :custo_pm, :alcance, :duracao, :descritor, :descricao, :ficha_id
                )
            ");
            $stmt->bindParam(':nome_magia', $nome_magia);
            $stmt->bindParam(':tipo_magia', $tipo_magia);
            $stmt->bindParam(':nivel', $nivel, PDO::PARAM_INT);
            $stmt->bindParam(':custo_pm', $custo_pm);
            $stmt->bindParam(':alcance', $alcance);
            $stmt->bindParam(':duracao', $duracao);
            $stmt->bindParam(':descritor', $descritor);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':ficha_id', $ficha_id, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Magia criada']);
            break;

        case 'editar':
            if (!$id_magia) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos para editar']);
                exit;
            }

            $stmt = $conn->prepare("
                UPDATE magias 
                SET nome_magia = :nome_magia, tipo_magia = :tipo_magia, nivel = :nivel,
                    custo_pm = :custo_pm, alcance = :alcance, duracao = :duracao,
                    descritor = :descritor, descricao = :descricao
                WHERE id_magias = :id_magia AND ficha_id = :ficha_id
            ");
            $stmt->bindParam(':nome_magia', $nome_magia);
            $stmt->bindParam(':tipo_magia', $tipo_magia);
            $stmt->bindParam(':nivel', $nivel, PDO::PARAM_INT);
            $stmt->bindParam(':custo_pm', $custo_pm);
            $stmt->bindParam(':alcance', $alcance);
            $stmt->bindParam(':duracao', $duracao);
            $stmt->bindParam(':descritor', $descritor);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':id_magia', $id_magia, PDO::PARAM_INT);
            $stmt->bindParam(':ficha_id', $ficha_id, PDO::PARAM_INT);
            $stmt->execute();



            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Magia atualizada']);
            break;

        case 'excluir':
            if (!$id_magia) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'ID da magia é obrigatório para excluir']);
                exit;
            }

            $stmt = $conn->prepare("
                DELETE FROM magias 
                WHERE id_magias = :id_magia AND ficha_id = :ficha_id
            ");
            $stmt->bindParam(':id_magia', $id_magia, PDO::PARAM_INT);
            $stmt->bindParam(':ficha_id', $ficha_id, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Magia excluída']);
            break;

        default:
            echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida']);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco: ' . $e->getMessage()]);
}
