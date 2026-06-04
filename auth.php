<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['sms'] =  "Você precisa estar logado para acessar essa sessão. ";
    header("Location: ../index.php");
} 