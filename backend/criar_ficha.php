<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}
/* ficha */
$usuario_id = $_SESSION['usuario_id'];
$nome_personagem = isset($_POST['nome_personagem']) ? trim($_POST['nome_personagem']) : '';



$stmtFicha = $conn->prepare("
    INSERT INTO fichas (
        usuario_id,
        nome_personagem
    ) VALUES (
        :usuario_id,
        :nome_personagem
    )
");

$stmtFicha->bindParam(':usuario_id',         $usuario_id, PDO::PARAM_INT);
$stmtFicha->bindParam(':nome_personagem',   $nome_personagem, PDO::PARAM_STR);


if ($stmtFicha->execute()) {

    $id_ficha = $conn->lastInsertId();

    $stmtAtributos = $conn->prepare("
    INSERT INTO atributos (
        id_ficha
    ) VALUES (
        :id_ficha
    )
");

    $stmtAtributos->bindParam(':id_ficha',         $id_ficha, PDO::PARAM_INT);
    

    if ($stmtAtributos->execute()) {

        $stmtPericias = $conn->prepare("
        INSERT INTO pericias (
            id_ficha
        ) VALUES (
            :id_ficha
        )
        ");

        $stmtPericias->bindParam(':id_ficha',         $id_ficha, PDO::PARAM_INT);
       
        if ($stmtPericias->execute()) {
            echo json_encode(['status' => 'sucesso']);
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar pericias']);
        }

    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar atributos']);
    }

} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar ficha']);
}
