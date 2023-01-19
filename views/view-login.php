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
  <title>Calendrier</title>
</head>

<body>
  <h1 class=" text-center my-5 fw-bold">Connexion</h1>
  <div class="container">
    <div class="row">
      <form action="" method="POST" class="col-lg-6 mx-auto">

        <div class="mb-3">
          <label for="email" class="form-label fw-bold fs-5">Identifiant</label>
          <input type="email" class="form-control" id="email" name="mail">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-bold fs-5">Mot de passe</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
      </form>
    </div>
    <div class="row my-5">
      <div class="col-lg-6 mx-auto">
        <button type="button" class="btn btn-success"><a class="text-decoration-none text-white" href="/inscription.php">Créer un nouveau compte</a></button>
      </div>
    </div>


  </div>


  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>