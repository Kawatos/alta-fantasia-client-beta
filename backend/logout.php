<?php
session_start();

// Destrói todas as variáveis da sessão
$_SESSION = [];

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou home
header('Location: ../bemvindo.php');
exit;
