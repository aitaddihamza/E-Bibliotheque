<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./frontend/css/auth.css">
    <link rel="stylesheet" href="./frontend/css/shared.css">
    <link rel="stylesheet" href="./frontend/css/home.css">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <title><?php echo $page_title[$page] ?></title>
</head>

<body>
    <?php require_once "./frontend/views/static/header.php" ?>
    <main>
        <?php if (isset($_SESSION['auth'])) {
            require_once "./frontend/views/static/sidebar.php";
        } ?>
        <?php require_once "./frontend/views/pages/" . $page . ".php" ?>
    </main>
    <?php require_once "./frontend/views/static/footer.html" ?>
</body>

</html>