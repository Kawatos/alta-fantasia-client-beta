<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$nome_personagem = isset($_POST['nome_personagem']) ? trim($_POST['nome_personagem']) : '';

// 1. Recebe o tipo da ficha (se não vier nada, assume 'padrao' por segurança)
$tipo_ficha = isset($_POST['tipo_ficha']) ? trim($_POST['tipo_ficha']) : 'padrao';

// Validação de segurança para garantir que não enviem valores malucos
$tipos_permitidos = ['padrao', 'bloco', 'arquivo'];
if (!in_array($tipo_ficha, $tipos_permitidos)) {
    $tipo_ficha = 'padrao';
}

try {
    // Inicia uma transação (se der erro no meio, ele desfaz tudo)
    $conn->beginTransaction();

    /* ================================
       CRIA A FICHA BASE
    ================================ */
    $stmtFicha = $conn->prepare("
        INSERT INTO fichas (
            usuario_id,
            nome_personagem,
            tipo_ficha
        ) VALUES (
            :usuario_id,
            :nome_personagem,
            :tipo_ficha
        )
    ");

    $stmtFicha->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmtFicha->bindParam(':nome_personagem', $nome_personagem, PDO::PARAM_STR);
    $stmtFicha->bindParam(':tipo_ficha', $tipo_ficha, PDO::PARAM_STR);
    $stmtFicha->execute();

    // Pega o ID que acabou de ser criado
    $id_ficha = $conn->lastInsertId();

    /* ================================
       ATRIBUTOS E PERÍCIAS (SÓ PARA PADRÃO)
    ================================ */
    // Só criamos registros pesados nas outras tabelas se a ficha for do tipo Completa (padrao)
    if ($tipo_ficha === 'padrao') {

        $stmtAtributos = $conn->prepare("INSERT INTO atributos (id_ficha) VALUES (:id_ficha)");
        $stmtAtributos->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
        $stmtAtributos->execute();

        $stmtPericias = $conn->prepare("INSERT INTO pericias (id_ficha) VALUES (:id_ficha)");
        $stmtPericias->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
        $stmtPericias->execute();
    }

    // Se chegou até aqui sem erros, confirma as alterações no banco!
    $conn->commit();

    echo json_encode(['status' => 'sucesso', 'id_ficha' => $id_ficha]);
} catch (PDOException $e) {
    // Se deu qualquer erro de banco de dados, cancela tudo
    $conn->rollBack();
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha: ' . $e->getMessage()]);
}
