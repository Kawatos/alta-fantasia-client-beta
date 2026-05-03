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
// Adicionamos o m.usuario_id na busca para saber quem enviou
$stmt = $conn->prepare("
    SELECT 
        m.id,
        m.mensagem,
        m.data_envio,
        m.usuario_id,
        u.username
    FROM mensagens m
    JOIN usuarios u ON u.id = m.usuario_id
    WHERE m.campanha_id = :campanha_id
    ORDER BY m.id ASC
");

$stmt->bindParam(':campanha_id', $campanha_id, PDO::PARAM_INT);
$stmt->execute();

$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ================================
   DESCRIPTOGRAFIA DAS MENSAGENS
================================ */
$chave_criptografia = "CHAVE_SECRETA_RPG_ALTA_FANTASIA!"; 
$metodo = 'aes-256-cbc';
$iv_tamanho = openssl_cipher_iv_length($metodo);

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
   RESPOSTA
================================ */
// Retornamos os dados extras para o frontend usar na lógica da Lixeira
echo json_encode([
    'status' => 'sucesso',
    'mensagens' => $mensagens,
    'usuario_logado' => $usuario_id,
    'papel' => $papel_usuario_logado
]);