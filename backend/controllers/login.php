<?php

session_start();

require_once "../database/db.php";
require_once "../models/Model.php";
require_once "../models/User.php";
require_once "../utils/validation.php";

if (isset($_POST['login'])) {
    $username = cleanData($_POST['username']);
    $password = cleanData($_POST['password']);

    $errors = [];
    // validation de username
    if (empty($username))
        $errors["username"] = "Le nom d'utilisateur est requis.";

    // validation de mot de passe
    if (empty($password))
        $errors["password"] = "Le mot de passe est requis.";

    if (count($errors) == 0) {
        // $user = User::find($username, $password);
        $user = User::query("username", $username);
        if ($user) {
            $user  = $user[0];
            if (password_verify($password, $user['password'])) {
                $_SESSION["auth_message"] = "authentification a bien réuissi !";
                $role = $user['role'];
                $_SESSION['auth'] = $user;
                if ($role == "admin")
                    header("Location: ../../?page=admin/dashboard");
                else
                    header("Location: ../../?page=user/index");
                exit();
            }
        }

        $errors["login_message"] = "username ou mot de passe est incorrecte !";
    }

    if (count($errors) != 0) {
        $_SESSION['login_message_error'] = isset($errors['login_message']) ? $errors['login_message'] : null;
        $_SESSION['login_username_error'] = isset($errors['username']) ? $errors['username'] : null;
        $_SESSION['login_password_error'] = isset($errors['password']) ? $errors['password'] : null;
    }

    header("Location: ../../?page=login");
}
