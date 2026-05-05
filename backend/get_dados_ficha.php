<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$id_ficha = $_POST['id_ficha'] ?? null;

if (!$id_ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID da ficha não fornecido']);
    exit;
}

// 1. Busca os dados principais da ficha
$stmtFicha = $conn->prepare("SELECT * FROM fichas WHERE id = :id");
$stmtFicha->bindParam(':id', $id_ficha, PDO::PARAM_INT);
$stmtFicha->execute();

$ficha = $stmtFicha->fetch(PDO::FETCH_ASSOC);

if (!$ficha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Ficha não encontrada']);
    exit;
}

// Descobre qual é o formato da ficha (se for null, assume 'padrao')
$tipo_ficha = $ficha['tipo_ficha'] ?? 'padrao';

// 2. Se a ficha for do tipo simples (Bloco ou PDF), devolve só ela e finaliza
if ($tipo_ficha === 'bloco' || $tipo_ficha === 'arquivo') {
    echo json_encode([
        'status' => 'sucesso', 
        'ficha' => $ficha
    ]);
    exit;
}

// 3. Se for do tipo 'padrao', busca o restante das informações (Atributos e Perícias)
$stmtAtributos = $conn->prepare("SELECT * FROM atributos WHERE id_ficha = :id_ficha");
$stmtAtributos->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtAtributos->execute();
$atributos = $stmtAtributos->fetch(PDO::FETCH_ASSOC);

$stmtPericias = $conn->prepare("SELECT * FROM pericias WHERE id_ficha = :id_ficha");
$stmtPericias->bindParam(':id_ficha', $id_ficha, PDO::PARAM_INT);
$stmtPericias->execute();
$pericias = $stmtPericias->fetch(PDO::FETCH_ASSOC);

// Verifica se os dados secundários da ficha padrão existem
if (!$atributos) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Atributos não encontrados para esta ficha padrão']);
    exit;
}

if (!$pericias) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Perícias não encontradas para esta ficha padrão']);
    exit;
}

// 4. Se tudo estiver certo com a ficha padrão, devolve o pacotão completo
echo json_encode([
    'status' => 'sucesso', 
    'ficha' => $ficha, 
    'atributos' => $atributos, 
    'pericias' => $pericias
]);