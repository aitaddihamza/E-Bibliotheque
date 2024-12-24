<form action="./backend/controllers/register.php" method="POST" class="auth-form">
    <?php
    // en cas des erreurs
    if (isset($_SESSION['register_username_error']))
        echo "<p class='error'> {$_SESSION['register_username_error']} </p>";
    if (isset($_SESSION['register_password_error']))
        echo "<p class='error'> {$_SESSION['register_password_error']} </p>";
    // en cas de success
    if (isset($_SESSION['register_message']))
        echo "<p class='success'>{$_SESSION['register_message']}</p>";
    ?>

    <h1>s'inscrire</h1>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="password_confirmation">confirmation de mot passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    <div>
        <button name="register" class="black-btn">s'incrire</button>
    </div>
</form>