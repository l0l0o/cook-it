<?php
    require_once __DIR__ . '/parts/header.php';
    $user_id = $_SESSION['id'];

    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");
    $request = $connectDatabase->prepare("SELECT * FROM recipes WHERE user_id = $user_id");
    $request->execute();

    $recipes = $request->fetchAll();

    
?>

<div class="container-sm mt-4">
    <h1>Hello&nbsp;<?php echo $_SESSION['pseudo']; ?> !</h1>
    <h4>Alors ? Qu'est-ce qu'on prépare aujourd'hui ? </h4>

</div>
<div class="container mt-4 d-flex flex-row">
    <div class="container">
        <h3>Livre de recettes</h3>
        <div class="container">

            <?php if(isset($recipes[0])) : ?>
            <?php foreach($recipes as $recipe) :?>
            <?php 
                $ingredient_list = explode(";",$recipe['recipe_ingredients'], -1);
                $steps_list = explode(";",$recipe['recipe_steps'], -1);
                ?>

            <div class="container d-flex flex-row justify-content-start">
                <div class="card-container">
                    <?php
                        $cardTitle = $recipe['recipe_title'];
                        $cardIngredients = $recipe['recipe_ingredients'];
                        $cardSteps = $recipe['recipe_steps'];
                        $cardImg = $recipe['recipe_img'];
                        $cardId = $recipe['recipe_id'];
                    ?>

                    <a href="./scripts/recipes/recipe_delete.php?idCard=<?php echo htmlspecialchars($cardId) ?>">
                        <button class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                    </a>
                    <a
                        href="./scripts/recipes/recipe_duplicate.php?titleCard=<?php echo htmlspecialchars($cardTitle)?>&ingredientsCard=<?php echo htmlspecialchars($cardIngredients)?>&stepsCard=<?php echo htmlspecialchars($cardSteps)?>&imgCard=<?php echo htmlspecialchars($cardImg)?>">
                        <button class="duplicate-btn"><i class="fa-solid fa-clone"></i></button>
                    </a>
                    <a
                        href="./recipes_page.php?titleCard=<?php echo htmlspecialchars($cardTitle)?>&ingredientsCard=<?php echo htmlspecialchars($cardIngredients)?>&stepsCard=<?php echo htmlspecialchars($cardSteps)?>&imgCard=<?php echo htmlspecialchars($cardImg)?>&idCard=<?php echo htmlspecialchars($cardId) ?>">
                        <button class="modify-btn"><i class="fa-solid fa-pen-to-square"></i></button>
                    </a>
                    <div class="card d-flex flex-row gap-2 mb-2" style="height:250px;">
                        <img src="./images/<?= $recipe['recipe_img'] ?>" alt="">
                        <div class="container hide-scroll">
                            <div class="title mt-2">
                                <h5><?= $recipe['recipe_title'] ?></h5>
                            </div>
                            <div class="container d-flex flex-row">
                                <div class="container">
                                    <h5>Ingrédients</h5>
                                    <ul>
                                        <?php foreach($ingredient_list as $ingredient) :?>
                                        <li>
                                            <?= $ingredient ?>
                                        </li>
                                        <?php endforeach?>
                                    </ul>
                                </div>
                                <div class="container">
                                    <h5>Étapes</h5>
                                    <ol>
                                        <?php foreach($steps_list as $step) :?>
                                        <li>
                                            <?= $step ?>
                                        </li>
                                        <?php endforeach?>
                                    </ol>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <?php endforeach ?>
            <?php else:  ?>
            <h6>Ton carnet de recette est vide, tu devrais te concocter une petite recette !</h6>
            <?php endif ?>
        </div>


    </div>

    <?php 
        $card_id = @$_GET['idCard'];
        $path = !isset($_GET['titleCard']) ? "recipe_new.php" : "recipe_modify.php?idCard=$card_id";
        
    ?>

    <div class="container">
        <h3>Ajouter une recette</h3>
        <h6>Pense bien à lister tes ingrédients et tes étapes avec un ';' à la fin de chaque instruction !</h6>
        <form action="./scripts/recipes/<?php echo $path ?>" method="POST" enctype="multipart/form-data"
            class="d-flex flex-column">
            <input class="mt-2 form-control" placeholder="Titre de la recette" type="text" name="recipe-title"
                value="<?php if(isset($_GET['titleCard'])){echo $_GET['titleCard']; }?>">

            <textarea class="mt-2 form-control" rows="5" maxlength="1056" placeholder="Ingrédients"
                name="recipe-ingredients"><?php if(isset($_GET['ingredientsCard'])){echo $_GET['ingredientsCard']; }?></textarea>

            <textarea class="mt-2 form-control" rows="5" maxlength="1056" placeholder="Étapes"
                name="recipe-steps"><?php if(isset($_GET['stepsCard'])){echo $_GET['stepsCard']; }?></textarea>

            <input class="mt-2 form-control" type="file" accept="image/png, image/jpeg" name="recipe-img"
                value="<?php if(isset($_GET['imgCard'])){echo $_GET['imgCard']; }?>">

            <button class="mt-3 d-flex justify-content-center"><input type="submit"
                    value="<?php if(!isset($_GET['titleCard'])){echo "Envoyer";}else{echo "Modifier";} ?>"></button>
        </form>

        <?php if(isset($_GET['success'])) :?>
        <div class="alert alert-success mt-2">
            <?php echo $_GET['success']; ?>
        </div>
        <?php endif; ?>

        <?php if(isset($_GET['error'])) :?>
        <div class="alert alert-danger mt-2">
            <?php echo $_GET['error']; ?>
        </div>
        <?php endif; ?>
    </div>

</div>