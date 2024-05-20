<?php
    require_once __DIR__ . '/parts/header.php'
?>

<div class="container-sm mt-4">
    <h1>Cook It !</h1>
    <h4 class="mt-4">Inscription</h4>
    <form action="scripts/user/user_new.php" method="POST">
        <input type="text" class="form-control" placeholder="Enter pseudo" name="pseudo">
        <button class="mt-3 d-flex justify-content-center">
            <input type="submit">
        </button>
    </form>
    <a class="mt-2" href="./index.php">Déjà inscrit ?</a>


    <?php if(isset($_GET['error'])) :?>
    <div class="alert alert-danger mt-4">
        <?php echo $_GET['error']; ?>
    </div>
    <?php endif; ?>

</div>