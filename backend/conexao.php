<?php

/* try {
    $conn = new PDO("mysql:host=localhost;dbname=altafantasia;charset=utf8", "root", "");
    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Opcional: configura o modo de fetch padrão como associativo
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
} */


// abaixo a conexão usando as variáveis de ambiente do docker-compose, se você estiver rodando localmente sem docker, pode usar os valores hardcoded como no exemplo comentado acima
$host = "db"; // Nome do serviço no docker-compose
$dbname = "altafantasia";
$user = "root";
$pass = "root_password";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}