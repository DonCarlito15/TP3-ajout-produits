<?php

$dbHost = 'localhost';
$dbName = 'majproduits';
$dbUser = 'root';
$dbPass = '';

try {

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

} catch (PDOException $e) {
    
   die("Erreur de connexion");
}