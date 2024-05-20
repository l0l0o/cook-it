<?php 
session_start();
$recipe_title = $_POST['recipe-title'];
$recipe_ingredients = $_POST['recipe-ingredients'];
$recipe_steps = $_POST['recipe-steps'];
$recipe_img = str_replace(" ", "", $_FILES['recipe-img']['name']);
$tempname = $_FILES['recipe-img']['tmp_name'];
$user_id = $_SESSION['id'];

$folder = '../../images/'.$recipe_img; 


if(isset($recipe_title) && $recipe_title !== "" && isset($recipe_ingredients) && $recipe_ingredients !== "" && isset($recipe_steps) && $recipe_steps !== "" && isset($recipe_img) && $recipe_img !== "") {
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");
    $request = $connectDatabase->prepare("INSERT INTO recipes (recipe_title, recipe_ingredients, recipe_steps, recipe_img, user_id) VALUES (:recipe_title, :recipe_ingredients, :recipe_steps, :recipe_img, :user_id)");
    
    if(move_uploaded_file($tempname, $folder))

    $request->bindParam(':recipe_title', $recipe_title);
    $request->bindParam(':recipe_ingredients', $recipe_ingredients);
    $request->bindParam(':recipe_steps', $recipe_steps);
    $request->bindParam(':recipe_img', $recipe_img);
    $request->bindParam(':user_id', $user_id);

    $request->execute();

    header("Location: ../../recipes_page.php?success=Et hop une recette de plus !");

} else {
    header("Location: ../../recipes_page.php?error=Il doit manquer un élément.");
}