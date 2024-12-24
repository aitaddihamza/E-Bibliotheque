<div class="container">
    <div>
        <h1 style="margin-bottom: 2rem;">Tous les utilisateurs</h1>
        <?php
        if (isset($_SESSION['admin_message']))
            echo "<p class='success'>{$_SESSION['admin_message']}</p>";
        if (isset($_SESSION['admin_error']))
            echo "<p class='error'>{$_SESSION['admin_error']}</p>";
        ?>
    </div>
    <?php
    if (isset($_SESSION['users']))  $users = $_SESSION['users']; ?>
    <table>
        <thead>
            <th>id</th>
            <th>username</th>
            <th>actions</th>
        </thead>
        <tbody>
            <?php foreach ($users  as $user) { ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td>
                        <form action="./backend/controllers/admin/user.php" method="POST">
                            <input type="hidden" value=<?= $user['id'] ?> name="user_id">
                            <button name="delete_user" class="red-btn">supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>