<?php 

$pseudo = trim($_POST['pseudo']);

if(isset($pseudo) && $pseudo !== "") {
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");
    $request = $connectDatabase->prepare("INSERT INTO users (pseudo) VALUES (:pseudo)");

    $request->bindParam(':pseudo', $pseudo);

    $request->execute();

    header("Location: ../index.php?success=Compte créé !");

} else {
    header("Location: ../sign-up.php?error=Veuillez renseigner un nom d'utilisateur");
}