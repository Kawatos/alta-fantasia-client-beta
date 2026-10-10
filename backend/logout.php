<?php
session_start();

// Destrói todas as variáveis da sessão
$_SESSION = [];

// Destroi a sessão
session_destroy();

// Se for requisição AJAX/fetch, responde com JSON
if (
    (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
    (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

// Redireciona para o SPA landing
header('Location: ../#landing');
exit;
