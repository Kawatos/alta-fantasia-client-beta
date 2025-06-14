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
$id_item = $_POST['id_item'] ?? null;
$nome = $_POST['nome'] ?? '';
$rank = $_POST['rank'] ?? null;
$descricao = $_POST['descricao'] ?? '';
$peso = $_POST['peso'] ?? null;
$volume = $_POST['volume'] ?? '';
$equipado = $_POST['equipado'] ?? null;
$inventario_interno = $_POST['inventario_interno'] ?? '';

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha é obrigatório']);
    exit;
}

try {
    switch ($acao) {
        case 'criar':
            if (!$nome || $rank === null || !$descricao || $peso === null || !$volume) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos para criar']);
                exit;
            }

            $stmt = $conn->prepare("
                INSERT INTO itens (id_ficha, nome, rank, descricao, peso, volume, equipado, inventario_interno)
                VALUES (:id_ficha, :nome, :rank, :descricao, :peso, :volume, :equipado, :inventario_interno)
            ");
            $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':rank', $rank, PDO::PARAM_INT);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':peso', $peso, PDO::PARAM_INT);
            $stmt->bindParam(':volume', $volume);
            $stmt->bindParam(':equipado', $equipado);
            $stmt->bindParam(':inventario_interno', $inventario_interno);
            $stmt->execute();
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Item criado']);
            break;

        case 'editar':
            if (!$id_item || !$nome || $rank === null || !$descricao || $peso === null || !$volume) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos para editar']);
                exit;
            }

            $stmt = $conn->prepare("
                UPDATE itens 
                SET nome = :nome, rank = :rank, descricao = :descricao, peso = :peso, volume = :volume, equipado = :equipado, 
                    inventario_interno = :inventario_interno
                WHERE id_item = :id_item AND id_ficha = :id_ficha
            ");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':rank', $rank, PDO::PARAM_INT);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':peso', $peso, PDO::PARAM_INT);
            $stmt->bindParam(':volume', $volume);
            $stmt->bindParam(':equipado', $equipado);
            $stmt->bindParam(':inventario_interno', $inventario_interno);
            $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
            $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Item atualizado']);
            break;

        case 'excluir':
            if (!$id_item) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'ID do item é obrigatório para excluir']);
                exit;
            }

            $stmt = $conn->prepare("
                DELETE FROM itens 
                WHERE id_item = :id_item AND id_ficha = :id_ficha
            ");
            $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
            $stmt->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Item excluído']);
            break;

        default:
            echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida']);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco: ' . $e->getMessage()]);
}
