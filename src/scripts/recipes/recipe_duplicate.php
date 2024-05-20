<?php 

session_start();

$card_title = $_GET['titleCard'];
$card_ingredients = $_GET['ingredientsCard'];
$card_steps = $_GET['stepsCard'];
$card_img = $_GET['imgCard'];
$user_id = $_SESSION['id'];


 $connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");
 $request = $connectDatabase->prepare("INSERT INTO recipes (recipe_title, recipe_ingredients, recipe_steps, recipe_img, user_id) VALUES (:recipe_title, :recipe_ingredients, :recipe_steps, :recipe_img, :user_id)");

 $request->bindParam(':recipe_title', $card_title);
 $request->bindParam(':recipe_ingredients', $card_ingredients);
 $request->bindParam(':recipe_steps', $card_steps);
 $request->bindParam(':recipe_img', $card_img);
 $request->bindParam(':user_id', $user_id);
 $request->execute();

 header('Location:../../recipes_page.php?success=Recette dupliquée.')
 
?>