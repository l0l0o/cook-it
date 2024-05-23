<?php 
session_start();
$recipe_id = $_GET['idCard'];
$recipe_title = $_POST['recipe-title'];
$recipe_ingredients = $_POST['recipe-ingredients'];
$recipe_steps = $_POST['recipe-steps'];

$recipe_img = str_replace(" ", "", $_FILES['recipe-img']['name']);


if($_FILES['recipe-img']['name']!="") {
    
    $tempname = $_FILES['recipe-img']['tmp_name'];
    $folder = '../../images/'.$recipe_img; 
};


$connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");
if($_FILES['recipe-img']['name']!="") {
    $request = $connectDatabase->prepare(
        "UPDATE recipes 
        SET (recipe_title = :recipe_title, recipe_ingredients = :recipe_ingredients, recipe_steps = :recipe_steps, recipe_img = :recipe_img) 
        WHERE recipes . recipe_id = :recipe_id"); 
} else {
    $request = $connectDatabase->prepare(
        "UPDATE recipes 
        SET (recipe_title = :recipe_title, recipe_ingredients = :recipe_ingredients, recipe_steps = :recipe_steps) 
        WHERE recipes . recipe_id = :recipe_id"); 
}

// var_dump($request);
// die();

if($_FILES['recipe-img']['name']!=""){
     if(move_uploaded_file($tempname, $folder));
     $request->bindParam(':recipe_img', $recipe_img);

 };
$request->bindParam(':recipe_title', $recipe_title);
$request->bindParam(':recipe_ingredients', $recipe_ingredients);
$request->bindParam(':recipe_steps', $recipe_steps);
$request->bindParam(':recipe_id', $recipe_id);


 $request->execute();

 header('Location:../../recipes_page.php?success=Recette modifiée.')
 
?>