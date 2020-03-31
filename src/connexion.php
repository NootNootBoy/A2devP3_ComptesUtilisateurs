<?php

require('php/connection.php');

if(!empty($_POST['email']) && !empty($_POST['password'])){

	// VARIABLES
	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
	$error		= 1;

	// CRYPTER LE PASSWORD
  $password = "aq1".sha1($password."1254")."25";
  
  $req = $db->prepare('SELECT * FROM users WHERE email = ?');
	$req->execute(array($email));

	while($user = $req->fetch()){

		if($password == $user['password']){
			$error = 0;
			$_SESSION['connect'] = 1;
			$_SESSION['pseudo']	 = $user['pseudo'];

			if(isset($_POST['connect'])) {
				setcookie('log', $user['secret'], time() + 365*24*3600, '/', null, false, true);
			}

			header('location: connection.php?success=1');
			exit();
		}

	}

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>
<body>
<div class="container">
  <form class="contactForm" action="connexion.php" method="post">
    <input type="text" class="contactFormText" name="pseudo" placeholder="Votre pseudo" required/>
    <input type="password" class="contactFormText" name="password" placeholder="Votre mot de passe" required />
    <div class="space">
      <p><label><input type="checkbox" name="connect" checked>Connexion automatique</label></p>
      </div>
      <div class="center">
      <a href="#">
        <button type="submit"> Se connecter </button>
      </a>
    </div>
    <a href="index.php">vous n'avez pas encore de compte?</a>
  </form>
  </div>
</body>
</html>