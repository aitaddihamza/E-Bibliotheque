<?php

session_start();

require_once "../../utils/validation.php";
require_once "../../database/db.php";
require_once "../../models/Model.php";
require_once "../../models/Book.php";

// créer un nouvel book 
if (isset($_POST['add_book'])) {
    $title = cleanData($_POST['title']);
    $author = cleanData($_POST['author']);
    $category = cleanData($_POST['category']);
    $filename = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $path = "../../../frontend/images/" . $filename;

    // on suppose que l'admin a bien nous donner le valid format de l'image.
    move_uploaded_file($tmp, $path);


    // but i don't trust the user so i will have to add validation here such as for the image also the other fields.
    $errors = [];

    // on suppose que l'admin a ajouté correctement tous les infos
    $book = new Book($title, $author, $category, $filename);
    $book->save();

    $_SESSION['admin_message'] = "livre a été bien crée ! ";
    header("Location: ../../../?page=admin/books");
    exit();
}

// delete book by id
if (isset($_POST['delete_book'])) {
    $book_id = $_POST['book_id'];
    if (Book::delete($book_id)) {
        $_SESSION['admin_message'] = "livre a été bien supprimé ";
    } else
        $_SESSION['admin_error'] = "Erreur au niveau de serveur !";

    header("Location: ../../../?page=admin/books");
    exit();
}

// redirect to page edit book with book data
if (isset($_GET['edit_book'])) {
    $book_id = $_GET['book_id'];
    $book = Book::find($book_id);
    if ($book) {
        $_SESSION['book'] = $book;
        header("Location: ../../../?page=admin/edit");
        exit();
    } else
        echo "Book not found ";
}

if (isset($_POST['update_book'])) {
    $book_id = $_POST['book_id'];
    $title = cleanData($_POST['title']);
    $author = cleanData($_POST['author']);
    $category = cleanData($_POST['category']);
    // image stuff
    $file = $_FILES['image'];
    $filename = $file['name'];
    $tmp = $file['tmp_name'];
    $old_image = $_POST['old_image'];

    $newBook = [$title, $author, $category];
    if ($file['error'] == 0) {
        $newBook[] = $filename;
        $path = "../../../frontend/images/" . $filename;
        if (isset($old_image)) {
            // supprimer l'ancienne image  
            $old_image_path = "../../../frontend/images/" . $old_image;
            unlink($old_image_path);
        }
        move_uploaded_file($tmp, $path);
    } else
        $newBook[] = $old_image;

    Book::update($book_id, $newBook);
    $_SESSION['admin_message'] = "livre a été bien modifié ! ";
    header("Location: ../../../?page=admin/books");
    exit();
}
