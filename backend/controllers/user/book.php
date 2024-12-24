<?php

session_start();

require_once "../../database/db.php";
require_once "../../models/Model.php";
require_once "../../models/Book.php";

if (isset($_POST['emprunter'])) {
    $book_id = $_POST['book_id'];

    if (!isset($_SESSION['auth']) || $_SESSION['auth']['role'] == "admin") {
        header("Location: ../../../?page=login");
        exit();
    }

    // update the state of the book now it's not available 
    $sql = "UPDATE books SET available = ? WHERE id = ?";
    $pdo = connect();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([0, $book_id]);

    // ajouter le book emprunté dans la table rentals
    $query = "INSERT INTO rentals(user_id, book_id) VALUES(?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['auth']['id'], $book_id]);

    $_SESSION['user_message'] = "livre a été emprunté !";
    header("Location: ../../../?page=user/index");
    exit();
}

// page pour définir la date de retour
if (isset($_GET['add_date'])) {
    $book_id = $_GET['book_id'];
    $book = Book::find($book_id);
    $_SESSION['book'] = $book;

    header("Location: ../../../?page=user/add");
    exit();
}

if (isset($_POST['update_date'])) {
    $book_id = $_POST['book_id'];
    $date_retour = $_POST['returned_date'];

    $date_retour = $date_retour . " " . $current_time = date("H:i:s");

    $query = "UPDATE rentals SET returned_at = ? WHERE book_id = ?";
    $pdo = connect();
    $stmt = $pdo->prepare($query);
    $stmt->execute([$date_retour, $book_id]);

    header("Location: ../../../?page=user/index");
    exit();
}
