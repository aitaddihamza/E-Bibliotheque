<?php

session_start();

require_once "../../database/db.php";
require_once "../../models/Model.php";
require_once "../../models/User.php";


if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    if (User::delete($user_id)) {
        $_SESSION['admin_message'] = "l'utilisateur a été bien supprimé ";
    } else
        $_SESSION['admin_error'] = "Erreur au niveau de serveur !";

    header("Location: ../../../?page=admin/users");
    exit();
}
