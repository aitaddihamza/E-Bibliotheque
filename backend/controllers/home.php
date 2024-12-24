<?php

session_start();

require_once "../utils/validation.php";
require_once "../database/db.php";

if (isset($_GET['search_submit'])) {
    $query = "SELECT * FROM books";
    $params = NULL;
    if (isset($_GET['search_value']) && !empty($_GET['search_value'])) {
        $search = cleanData($_GET['search_value']);
        $query = $query . " WHERE title LIKE ? OR author LIKE ? OR category LIKE ?";
        $params = ["%$search%", "%$search%", "%$search%"];
    }
    $pdo = connect();
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['books'] = $books;

    header("Location: ../../?page=");
    exit();
}
