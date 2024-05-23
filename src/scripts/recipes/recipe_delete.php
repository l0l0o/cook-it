<?php 

   $card_id = $_GET['idCard'];

    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");
    $request = $connectDatabase->prepare("DELETE FROM recipes WHERE recipe_id = :recipe_id");
    $request->bindParam(':recipe_id', $card_id);


    $request->execute();

    header('Location:../../recipes_page.php?success=Recette supprimée.')
    
?>