<?php

$host = 'localhost';
$dbname = 'dashboard';
$user = 'root';
$pass = 'biel310107';

try {
    // DSN (Data Source Name)
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Configura o PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error ao conectar  ----------" . $e->getMessage());
}

?>