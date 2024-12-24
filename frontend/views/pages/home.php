<div class="home-container">
    <h1>Tous les livres</h1>
    <div class="books">
        <?php
        if (isset($_SESSION['books'])) {
            $books = $_SESSION['books'];
            $i = 0;
            foreach ($books as $book) {
                $i++; ?>
                <form action="./backend/controllers/user/book.php" class="book" method="POST">
                    <input type="hidden" name="book_id" value=<?= $book['id'] ?>>
                    <img src="./frontend/images/<?= $book['image_name'] ?>" alt="image">
                    <div>
                        <h2><?= $book['title'] ?></h2>
                        <p>Catégorie: <?= $book['category'] ?></p>
                        <p>Auteur: <?= $book['author'] ?></p>
                        <?php if ($book['available']) { ?>
                            <button class="blue-btn" style="margin: 1rem auto;" name="emprunter">emprunter</button>
                        <?php } else { ?>
                            <b style="color: red; text-decoration: line-through">n'est pas disponible</b>
                        <?php } ?>
                    </div>
                </form>
        <?php }
        } else
            echo "<h1>no books available </h1>";
        ?>
    </div>
</div>