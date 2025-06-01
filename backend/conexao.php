<?php
$conn = new mysqli("localhost", "root", "", "altafantasia");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
