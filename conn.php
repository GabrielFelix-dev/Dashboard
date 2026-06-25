<?php

$host = 'localhost';
$dbname = ''; // Nome do banco de dados
$user = ''; // Nome de usuário do banco de dados
$pass = ''; // Senha do banco de dados

try {
    // DSN (Data Source Name)
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Configura o PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error ao conectar  ----------" . $e->getMessage());
}

?>
