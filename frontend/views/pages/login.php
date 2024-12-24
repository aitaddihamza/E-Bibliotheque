<form action="./backend/controllers/login.php" method="POST" class="auth-form">
    <?php
    // en cas des erreurs
    if (isset($_SESSION['login_message_error']))
        echo "<p class='error'> {$_SESSION['login_message_error']} </p>";
    if (isset($_SESSION['login_username_error']))
        echo "<p class='error'> {$_SESSION['login_username_error']} </p>";
    if (isset($_SESSION['login_password_error']))
        echo "<p class='error'> {$_SESSION['login_password_error']} </p>";
    // en cas de success
    if (isset($_SESSION['auth_message']))
        echo "<p class='success'>{$_SESSION['auth_message']}</p>";
    ?>
    <h1>se connecter</h1>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button name="login" class="black-btn">se connecter</button>
        <a href="./?page=register" class="blue-btn">créer un compte ?</a>
    </div>
</form>