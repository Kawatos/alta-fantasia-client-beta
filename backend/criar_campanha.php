<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';

if ($nome === '') {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Nome obrigatório']);
    exit;
}

/* gerar código */
function gerarCodigo($length = 8) {
    return strtoupper(substr(bin2hex(random_bytes(10)), 0, $length));
}

$codigo = gerarCodigo();

/* inserir campanha */
$stmt = $conn->prepare("
    INSERT INTO campanhas (
        nome,
        descricao,
        codigo_convite,
        criado_por
    ) VALUES (
        :nome,
        :descricao,
        :codigo,
        :criado_por
    )
");

$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
$stmt->bindParam(':criado_por', $usuario_id, PDO::PARAM_INT);

if ($stmt->execute()) {

    $campanha_id = $conn->lastInsertId();

    /* inserir criador como mestre */
    $stmtUser = $conn->prepare("
        INSERT INTO campanha_usuarios (
            usuario_id,
            campanha_id,
            papel
        ) VALUES (
            :usuario_id,
            :campanha_id,
            'mestre'
        )
    ");

    $stmtUser->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmtUser->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);

    if ($stmtUser->execute()) {
        echo json_encode([
            'status' => 'sucesso',
            'codigo' => $codigo
        ]);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao vincular usuário']);
    }

} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao criar campanha']);
}