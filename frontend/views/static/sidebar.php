<aside>
    <ul>
        <?php
        if ($_SESSION['auth']['role'] == "admin") {
        ?>
            <li>
                <a href="./?page=admin/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="./?page=admin/users">Users</a>
            </li>
            <li>
                <a href="./?page=admin/books">Books</a>
            </li>
        <?php } else { ?>
            <li>
                <a href="./?page=user/profile">Profile</a>
            </li>
            <li>
                <a href="./?page=user/index">Vos books</a>
            </li>
        <?php } ?>
    </ul>
</aside>