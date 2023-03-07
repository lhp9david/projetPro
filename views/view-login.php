<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/assets/img/calendar.png">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/style.css">
  <title>Connexion</title>
</head>

<body>


<?php if (isset($subscribed)) { ?>
   <div class="container message">
   <p>Vous êtes bien Inscrit, vous allez recevoir un mail de confirmation</p>
   <button class="return btn btn-warning d-block mx-auto fw-bold"><a class="text-decoration-none text-black" href="../controllers/controller-login.php">Se connecter</a></button> 
   </div>

<?php  } else if (isset($disconnected)) { ?>
  <div class="container message" >
  <p>Vous êtes bien déconnecté</p>
   <button class="return btn btn-warning d-block mx-auto fw-bold"><a class="text-decoration-none text-black" href="../controllers/controller-login.php">Retour à l'accueil</a></button> 
  </div>
<?php } else { ?>

  <h1 class="connexion text-center my-5 fw-bold">Connexion</h1>
  <div class="container">
    <div class="row">

      <form action="/controllers/controller-login.php" method="POST" class="col-lg-6 mx-auto">

        <div class="mb-3">
          <label for="email" class="form-label fw-bold fs-5 text-center">Identifiant</label>
         <input class="form-control" value="<?= $_POST['mail'] ?? '' ?>" type="text" name="mail" id="mail"><span class='text-danger'><?= $errors['mail'] ?? '' ?></span>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-bold fs-5 text-end">Mot de passe</label>
          <input type="password" class="form-control" name="password" id="password"><span class="text-danger"><?= $errors['error'] ?? '' ?></span>
        </div>

        <button type="submit" class="btn btn-warning d-block mx-auto fw-bold">Valider</button>
      </form>
      <a class="text-center mt-5" href="../views/forget.php">Mot de passe oublié</a>
    </div>
    <div class="row my-5">
      <div class="col-lg-6 mx-auto">
      <div >
        <p class="text-center fw-bold">
       <img class="guillemetGauche" src="/assets/img/signe-de-guillemets-a-gauche.png" alt="guillemet"> Bienvenue sur notre plateforme pour parents divorcés! Partagez en toute sécurité des photos et évènements importants de vos enfants. Connectez-vous dès maintenant. <img class="guillemetDroit" src="/assets/img/symbole-des-guillemets-droits.png" alt="guillemet">
        </p>
      </div>
        <button type="button" class="btn btn-dark d-block mx-auto fw-bold"><a class="text-decoration-none text-white" href="../controllers/controller-inscription.php">Créer un nouveau compte</a></button>
      </div>
    </div>


  </div>


  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="script.js"></script>

  <?php } ?>
</body>

</html>