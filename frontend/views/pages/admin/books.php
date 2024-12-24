<div class="container">
    <div style="padding-right: 110px; margin-bottom: 2rem;">
        <h1>Tous les livres</h1>
        <?php
        if (isset($_SESSION['admin_message']))
            echo "<p class='success'>{$_SESSION['admin_message']}</p>";
        if (isset($_SESSION['admin_error']))
            echo "<p class='error'>{$_SESSION['admin_error']}</p>";
        ?>
        <a href="./?page=admin/create" class="blue-btn" style="width: 200px;">Nouvel livre</a>
    </div>
    <?php
    if (isset($_SESSION['books']))  $books = $_SESSION['books']; ?>
    <table>
        <thead>
            <th>id</th>
            <th>titre</th>
            <th>auteur</th>
            <th>catégorie </th>
            <th>disponiblité</th>
            <th>image</th>
            <th>actions</th>
        </thead>
        <tbody>
            <?php foreach ($books  as $book) { ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['category'] ?></td>
                    <td>
                        <?php echo $book['available'] ? "oui" : "non"; ?>
                    </td>
                    <td>
                        <img src=<?php echo "./frontend/images/{$book['image_name']}" ?> alt="image" width="150">
                    </td>
                    <td>
                        <form action="./backend/controllers/admin/book.php">
                            <input type="hidden" value=<?= $book['id'] ?> name="book_id">
                            <button name="delete_book" class="red-btn">supprimer</button>
                            <button name="edit_book" class="blue-btn">Editer</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>