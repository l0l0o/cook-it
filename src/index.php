<?php
    require_once __DIR__ . '/parts/header.php'
?>

<div class="container-sm mt-4">
    <h1>Cook It !</h1>
    <h4 class="mt-4">Connexion</h4>

    <form action="scripts/user/user_connect.php" method="POST">
        <input type="text" class="form-control" placeholder="Enter pseudo" name="pseudo">
        <button class="mt-3 d-flex justify-content-center">
            <input type="submit">
        </button>
    </form>
    <a class="mt-2" href="./signUp_page.php">Pas encore inscrit ?</a>

    <?php if(isset($_GET['success'])) :?>
    <div class="alert alert-success">
        <?php echo $_GET['success']; ?>
    </div>
    <?php endif; ?>
    <?php if(isset($_GET['error'])) :?>
    <div class="alert alert-danger mt-2">
        <?php echo $_GET['error']; ?>
    </div>
    <?php endif; ?>

</div>