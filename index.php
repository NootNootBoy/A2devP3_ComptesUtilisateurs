<!doctype html>
<html lang="fr">
<head>
  <title>Titre de la page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
</head>
<body>
  <form class="contactForm" action="index.php" method="post">
    <input type="text" class="contactFormText" name="nom" placeholder="Votre Nom" />
    <input type="text" class="contactFormText" name="prenom" placeholder="Votre prenom" />
    <input type="email" class="contactFormText" name="mail" placeholder="Votre Email" />
    <!-- <textarea class="contactFormText" placeholder="Votre Message"></textarea> -->
    <div class="center">
      <a href="#">
        <button type="submit"> envoyer </button>
      </a>
    </div>
  </form>

</body>
</html>