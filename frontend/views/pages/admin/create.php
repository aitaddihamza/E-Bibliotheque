<form action="./backend/controllers/admin/book.php" method="POST" class="auth-form" enctype="multipart/form-data">
    <h1>Ajouter un nouvel livre </h1>
    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" required>
    </div>
    <div>
        <label for="category">Catégorie</label>
        <input type="text" name="category" id="category" required>
    </div>
    <div>
        <label for="image">L'image</label>
        <input type="file" name="image" id="image">
    </div>
    <div>
        <button class="black-btn" name="add_book">ajouter</button>
    </div>
</form>