<div class="container">
    <div style="padding-right: 110px; margin-bottom: 2rem;">
        <h1>Tous les livres empruntées</h1>
        <?php
        if (isset($_SESSION['user_message']))
            echo "<p class='success'>{$_SESSION['user_message']}</p>";
        if (isset($_SESSION['user_error']))
            echo "<p class='error'>{$_SESSION['user_error']}</p>";
        ?>
    </div>
    <?php
    if (isset($_SESSION['user_books']) && count($_SESSION['user_books']) != 0)
        $books = $_SESSION['user_books'];
    else {
        echo "<h1>Emprunter des livres <a href='./?page='>go back</a></h1>";
        return;
    }
    ?>
    <table>
        <thead>
            <th>id</th>
            <th>titre</th>
            <th>auteur</th>
            <th>catégorie </th>
            <th>date d'emprunte</th>
            <th>date de retour</th>
            <th>image</th>
        </thead>
        <tbody>
            <?php foreach ($books  as $book) { ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['category'] ?></td>
                    <td><?= $book['rented_at'] ?></td>
                    <td>
                        <?php
                        if (isset($book['returned_at']))
                            echo $book['returned_at'];
                        else { ?>
                            <form action="./backend/controllers/user/book.php" style="display: grid; place-content: center;">
                                <input type="hidden" name="book_id" value=<?= $book['id'] ?>>
                                <button class="blue-btn" name="add_date">définir</button>
                            </form>
                        <?php } ?>
                    </td>
                    <td>
                        <img src=<?php echo "./frontend/images/{$book['image_name']}" ?> alt="image" width="150">
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>