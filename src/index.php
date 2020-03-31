<?php

require("php/connection.php");

if(!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['passwordconfirm']) && !empty($_POST['email']) 
&& !empty($_POST['classe']) && !empty($_POST['niveau']) && !empty($_POST['guilde'])){

    $pseudo       = $_POST['pseudo'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];
    $passwordconfirm = $_POST['passwordconfirm'];
    $classe       = $_POST['classe'];
    $niveau       = $_POST['niveau'];
    $guilde       = $_POST['guilde'];


    if($password != $passwordconfirm){
        header('Location: index.php?error=1&pass=1');
            exit();

    }

    $req = $db->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
    $req->execute(array($email));

    while($email_verification = $req->fetch()){
        if($email_verification['numberEmail'] != 0) {
            header('location: index.php?error=1&email=1');
            exit();
         }
    }

    // HASH
 		$secret = sha1($email).time();
        $secret = sha1($secret).time().time();
  
         // CRYPTAGE DU PASSWORD
 		$password = "aq1".sha1($password."1254")."25";
  
         // ENVOI DE LA REQUETE
        $req = $db->prepare("INSERT INTO users(pseudo, email, password, secret, classe, niveau, guilde) VALUES(?,?,?,?,?,?,?)");
        $value = $req->execute(array($pseudo, $email, $password, $secret, $classe, $niveau, $guilde));
             
         header('location: index.php?success=1');
         exit();

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil</title>
</head>
<body>
<div class="container">
    
  <form class="contactForm" action="index.php" method="post">
    <p>Informations personnelles</p>
    <?php
		 
         if(isset($_GET['error'])){
      
             if(isset($_GET['pass'])){
                 echo '<p id="error">Les mots de passe ne correspondent pas.</p>';
             }
             else if(isset($_GET['email'])){
                 echo '<p id="error">Cette adresse email est déjà utilisée.</p>';
             }
         }
         else if(isset($_GET['success'])){
             echo '<p id="success">Inscription prise correctement en compte.</p>';
         }
      
     ?>
    <input type="text" class="contactFormText" name="pseudo" placeholder="Votre pseudo" required/>
    <input type="email" class="contactFormText" name="email" placeholder="Votre Email" required />
    <input type="password" class="contactFormText" name="password" placeholder="Votre mot de passe" required/>
    <input type="password" class="contactFormText" name="passwordconfirm" placeholder="Confirmation de votre mot de passe" required />

    <!-- <p>Dofus</p> -->
    <input type="text" class="contactFormText" name="classe" placeholder="Votre Classe" required />
    <input type="number" class="contactFormText" name="niveau" placeholder="Votre Level" required/>
    <input type="text" class="contactFormText" name="guilde" placeholder="Votre Guilde" required/>
    <!-- <textarea class="contactFormText" placeholder="Votre Message"></textarea> -->
    
    <a href="connexion.php">vous avez déja un compte?</a>

    <div class="center">
        

        <button type="submit"> Envoyer </button>

    </div>
  </form>
  </div>
</body>
</html>