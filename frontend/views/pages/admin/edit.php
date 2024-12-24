<?php
if (isset($_SESSION['book'])) {
    $book = $_SESSION['book'];
}
?>
<form action="./backend/controllers/admin/book.php" method="POST" class="auth-form" enctype="multipart/form-data">
    <h1>Modifier le livre #<?= $book['id'] ?></h1>
    <input type="hidden" name="book_id" value=<?= $book['id'] ?>>
    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value=<?= $book['title'] ?>>
    </div>
    <div>
        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" value=<?= $book['author'] ?>>
    </div>
    <div>
        <label for="category">Catégorie</label>
        <input type="text" name="category" id="category" value=<?= $book['author'] ?>>
    </div>
    <div>
        <label>L'ancienne image</label>
        <img src=<?php echo "./frontend/images/{$book['image_name']}" ?> alt="image" width="200" height="200" id="old_image">
        <input type="hidden" name="old_image" value=<?= $book['image_name'] ?>>
    </div>
    <div>
        <label for="image">Ajouter une image</label>
        <input type="file" name="image" id="image">
    </div>
    <div>
        <button class="black-btn" name="update_book">Modifier</button>
    </div>
</form>