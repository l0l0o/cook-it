<?php
    require_once __DIR__ . '/parts/header.php'
?>

<div class="container-sm mt-4">
    <h1>Cook It !</h1>
    <h4 class="mt-4">Inscription</h4>
    <form action="scripts/new_user.php" method="POST">
        <input type="text" class="form-control" placeholder="Enter pseudo" name="pseudo">
        <input class="mt-2" type="submit">
    </form>

    <?php if(isset($_GET['error'])) :?>
    <div class="alert alert-danger mt-4">
        <?php echo $_GET['error']; ?>
    </div>
    <?php endif; ?>

</div>