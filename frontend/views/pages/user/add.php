<?php
if (isset($_SESSION['book']))
    $book = $_SESSION['book'];
else {
    header("./?page=");
    exit();
}
?>
<form action="./backend/controllers/user/book.php" method="POST" style="display: grid; place-content: center;">
    <h1>Définir la date du retour du livre#<?= $book['id'] ?></h1>
    <input type="hidden" name="book_id" value=<?= $book['id'] ?>>
    <div style="display: flex; gap: 1rem; margin-top: .5rem;">
        <img src=<?php echo "./frontend/images/{$book['image_name']}" ?> alt="iamge" style='width: 300px;'>
        <div>
            <h2><?= $book['title'] ?></h2>
            <h3>L'auteur: <?= $book['author'] ?></h3>
        </div>
    </div>
    <label for="returned_date">Date de retour</label>
    <input type="date" name="returned_date" id="returned_date" style="height: 40px; padding: .5rem;" required>
    <br>
    <button class="blue-btn" name="update_date">confirmer</button>
</form>