<?php

session_start();

require_once "../database/db.php";
require_once "../models/Model.php";
require_once "../models/User.php";
require_once "../utils/validation.php";


if (isset($_POST['register'])) {

    $username = cleanData($_POST['username']);
    $password = cleanData($_POST['password']);
    $passwordConfirmation = cleanData($_POST['password_confirmation']);

    $errors = [];
    // validation de username
    if (empty($username))
        $errors["username"] = "Le nom d'utilisateur est requis.";
    elseif (strlen($username) < 3 || strlen($username) > 100)
        $errors["username"] = "Le nom d'utilisateur doit contenir entre 3 et 100 caractères.";

    // validation de mot de passe
    if (empty($password) || empty($passwordConfirmation))
        $errors["password"] = "Le mot de passe et sa confirmation sont requis.";
    elseif ($password != $passwordConfirmation)
        $errors["password"] = "Les mots de passe ne correspondent pas.";
    elseif (strlen($password) < 8)
        $errors["password"] = "Le mot de passe doit contenir au moins 8 caractères.";


    if (count($errors) == 0) {
        // vérifier que l'username n'est pas réservé  
        $users = User::All();
        if (in_array($username, array_column($users, 'username')))
            $errors["username"] = "Le nom d'utilisateur est déjà réservé .";
        else {
            // insertion de l'utilisateur dans la BD
            // hash the password
            $password = password_hash($password, PASSWORD_BCRYPT);
            $newUser = new User($username, $password);
            $newUser->save();
            $_SESSION["auth_message"] = "l'inscription a bien réuissi veuillez maintenant s'authentifier";
            header("Location: ../../?page=login");
            exit();
        }
    }
    $_SESSION['register_username_error'] = isset($errors['username']) ? $errors['username'] : null;
    $_SESSION['register_password_error'] = isset($errors['password']) ? $errors['password'] : null;

    header("Location: ../../?page=register");
}
