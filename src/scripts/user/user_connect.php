<?php
$pseudo = $_POST['pseudo'];

if(!empty($pseudo)) {

    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress","root", "admin");

    $request = $connectDatabase->prepare("SELECT * FROM users WHERE pseudo = :pseudo");

    $request->bindParam(':pseudo', $pseudo);

    $request->execute();

    $result = $request ->fetch(PDO::FETCH_ASSOC);

    
    if($result == false){
        header('Location: ../../index.php?error=Cet utilisateur n\'existe pas');
                
    } else {
        session_start();

        $_SESSION['id'] = $result['id'];
        $_SESSION['pseudo'] = $result['pseudo'];
        
        header('Location: ../../recipes_page.php?succes=Bienvenue brozer');

    }


} else {
    header("Location: ../../index.php?error=Veuillez renseigner un nom d'utilisateur");
}
var_dump($pseudo);