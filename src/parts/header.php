<?php 
    
    if(!isset($_SESSION)){
        session_start();
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook'it</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
    .hide-scroll::-webkit-scrollbar {
        display: none;

    }
    </style>
</head>

<body>
    <nav class="p-3">

        <?php if(!isset($_SESSION['pseudo'])) : ?>
        <a href="./index.php">Connexion</a>
        <a href="./signUp_page.php">Inscription</a>

        <?php elseif (isset($_SESSION['pseudo'])) : ?>
        <a href="./scripts/disconnect_user.php">Déconnexion</a>

        <?php endif ?>


    </nav>

    <div>

    </div>