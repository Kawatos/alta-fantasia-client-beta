<?php

session_start();
require 'conexao.php';

$usuario_id = $_SESSION['usuario_id'];

$sqlFicha = "
SELECT 
    id,
    nome_personagem,
    classe,
    nivel,
    status_personagem, 
    personagem_imagem
FROM fichas
WHERE usuario_id = :usuario_id
";

$stmtFicha = $conn->prepare($sqlFicha);
$stmtFicha->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmtFicha->execute();
$resultFicha = $stmtFicha->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultFicha);
