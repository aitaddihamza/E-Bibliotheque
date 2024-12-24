<?php

function connect()
{
    $host = "localhost";
    $dbname = "biblio_db";
    $username = "root";
    $password = "";
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $err) {
        die("Error " . $err->getMessage());
    }
}
