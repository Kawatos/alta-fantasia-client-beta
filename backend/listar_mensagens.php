<?php
session_start();
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$campanha_id = isset($_GET['campanha_id']) ? (int)$_GET['campanha_id'] : 0;
// NOVA VARIÁVEL: Pega o ID da última mensagem que o frontend já tem
$ultimo_id = isset($_GET['ultimo_id']) ? (int)$_GET['ultimo_id'] : 0;

if ($campanha_id <= 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Campanha inválida']);
    exit;
}

/* ================================
   VALIDAR ACESSO E PEGAR O PAPEL
================================ */
$stmt = $conn->prepare("
    SELECT papel 
    FROM campanha_usuarios
    WHERE usuario_id = :usuario_id
    AND campanha_id = :campanha_id
");

$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->execute();

$user_campanha = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_campanha) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Sem permissão']);
    exit;
}

$papel_usuario_logado = $user_campanha['papel'];

/* ================================
   BUSCAR MENSAGENS NO BANCO
================================ */
// A Query base
$sql = "
    SELECT 
        m.id,
        m.mensagem,
        m.data_envio,
        m.usuario_id,
        u.username
    FROM mensagens m
    JOIN usuarios u ON u.id = m.usuario_id
    WHERE m.campanha_id = :campanha_id
";

// Se o frontend informou o último ID, buscamos apenas as MAIORES (mais novas) que ele
if ($ultimo_id > 0) {
    $sql .= " AND m.id > :ultimo_id";
}

$sql .= " ORDER BY m.id ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);

// Faz o bind do ultimo_id se ele existir
if ($ultimo_id > 0) {
    $stmt->bindParam(':ultimo_id', $ultimo_id, PDO::PARAM_INT);
}

$stmt->execute();
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ================================
   DESCRIPTOGRAFIA DAS MENSAGENS
================================ */
$chave_criptografia = "CHAVE_SECRETA_RPG_ALTA_FANTASIA!"; 
$metodo = 'aes-256-cbc';
$iv_tamanho = openssl_cipher_iv_length($metodo);

// ATENÇÃO: Só vai descriptografar as NOVAS, poupando muita CPU do seu servidor!
foreach ($mensagens as &$m) {
    $dados_brutos = base64_decode($m['mensagem'], true);
    
    if ($dados_brutos !== false && strlen($dados_brutos) > $iv_tamanho) {
        $iv = substr($dados_brutos, 0, $iv_tamanho);
        $texto_encriptado = substr($dados_brutos, $iv_tamanho);
        
        $mensagem_decifrada = openssl_decrypt($texto_encriptado, $metodo, $chave_criptografia, OPENSSL_RAW_DATA, $iv);
        
        if ($mensagem_decifrada !== false) {
            $m['mensagem'] = $mensagem_decifrada;
        }
    }
}
unset($m);
/* ================================
   CONTAGEM TOTAL PARA SINCRONIZAÇÃO
================================ */
$stmtCount = $conn->prepare("SELECT COUNT(id) as total FROM mensagens WHERE campanha_id = :campanha_id");
$stmtCount->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmtCount->execute();
$rowCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
$total_bd = (int)$rowCount['total'];
/* ================================
   RESPOSTA
================================ */
echo json_encode([
    'status' => 'sucesso',
    'mensagens' => $mensagens,
    'total_mensagens' => $total_bd,
    'usuario_logado' => $usuario_id,
    'papel' => $papel_usuario_logado
]);