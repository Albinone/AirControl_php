<?php
$host = "localhost";
$dbname = "aircontrol";
$user = "root";
$pass = ""; // altere se necessário

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
