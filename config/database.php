<?php

$host = "localhost";
$dbname = "lab4";
$username = "tarikwaleed2";
$password = getenv('DB_PASSWORD');


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
