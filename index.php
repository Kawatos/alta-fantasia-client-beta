<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: alta.php");
    exit;
} else {
    header("Location: alta.php");
    exit;
}