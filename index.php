<?php

session_start();

require_once "./backend/database/db.php";
require_once "./backend/models/Model.php";
require_once "./backend/models/User.php";
require_once "./backend/models/Book.php";

$user_pages = ['user/index', 'user/profile', 'user/add'];
$admin_pages = ['admin/dashboard', 'admin/users', 'admin/books', 'admin/create', 'admin/edit'];
$pages = ['home', 'login', 'register', ...$user_pages, ...$admin_pages];
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (!in_array($page, $pages))
        $page = "home";
} else
    $page = "home";

function getAdminData($page)
{
    if ($page == "admin/users") {
        $users = User::All();
        $_SESSION['users'] = $users;
    } elseif ($page == "admin/books") {
        $books = Book::All();
        $_SESSION['books'] = $books;
    }
}
function getUserData($page)
{
    if ($page == "user/index") {
        $books = User::books($_SESSION['auth']['id']);
        $_SESSION['user_books'] = $books;
    }
}

// middleware d'autorisation
if (in_array($page, $admin_pages)) {
    if (isset($_SESSION['auth'])) {
        $role = $_SESSION['auth']['role'];
        if ($role != "admin")
            $page = "login";
        else
            getAdminData($page);
    } else
        $page = "login";
} elseif (in_array($page, $user_pages)) {
    if (isset($_SESSION['auth'])) {
        $role = $_SESSION['auth']['role'];
        if ($role != "etudiant")
            $page = "login";
        else
            getUserData($page);
    } else
        $page = "login";
} elseif ($page == "home") {
    if (!isset($_SESSION['books']) || count($_SESSION['books']) == 0) {
        $books = Book::paginate(10);
        $_SESSION['books'] = $books;
    }
}

$page_title = [
    "home" => "Acceuil",
    "login" => 'se connecter',
    "register" => "s'inscrire",
    "user/index" => "Books",
    "user/profile" => "Profile",
    "user/add" => "Add date",
    "admin/dashboard" => "Dashboard",
    "admin/users" => "All users",
    "admin/books" => "All books",
    "admin/create" => "new book",
    "admin/edit" => "edit book"

];

require_once('./frontend/views/base.php');
// netoyer les variables de session
unset($_SESSION['register_username_error']);
unset($_SESSION['register_password_error']);
unset($_SESSION["auth_message"]);
unset($_SESSION['login_username_error']);
unset($_SESSION['login_password_error']);
unset($_SESSION['login_message_error']);
unset($_SESSION['books']);
unset($_SESSION['user_books']);
unset($_SESSION['admin_message']);
unset($_SESSION['admin_error']);
unset($_SESSION['user_message']);
unset($_SESSION['user_error']);
