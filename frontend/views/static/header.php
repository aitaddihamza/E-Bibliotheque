<header>
  <h1><a href="./?page=">E-Bibliotheque</a></h1>
  <form action="./backend/controllers/home.php" class="search-form">
    <input type="text" name="search_value" placeholder="titre, genre, auteur" class="search-input">
    <button name="search_submit" class="black-btn">rechercher</button>
  </form>
  <nav>
    <ul>
      <li><a href="./?page=home">Acceuil</a></li>
      <?php if (isset($_SESSION["auth"])) { ?>
        <li>
          <form action="./backend/controllers/logout.php" method="POST">
            <button class="red-btn" name="logout">logout</button>
          </form>
        </li>
        <li style="font-weight: bold"><?= $_SESSION['auth']['username'] ?></li>
      <?php } else {
        echo "<li><a href='./?page=login'>se connecter</a></li> ";
        echo "<li><a href='./?page=register'>s'inscrire</a></li> ";
      } ?>
    </ul>
  </nav>
</header>