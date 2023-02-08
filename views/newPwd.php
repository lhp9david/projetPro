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

<h1 class="connexion text-center my-5 fw-bold">Modifier le mot de passe</h1>
  <div class="container">
    <div class="row">

      <form action="" method="POST" class="col-lg-6 mx-auto">

      <div class="mb-3">
        <label for="password" class="forgetMail form-label fw-bold  fs-5">Nouveau mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3">
        <label for="confirmPass" class="forgetMail form-label fw-bold  fs-5">Confirmer le nouveau mot de passe</label>
        <input type="password" class="form-control" id="confirmPass" name="confirmPass">
      </div>
        <button type="submit" class="btn btn-warning d-block mx-auto fw-bold">Valider</button>
      </form>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>


</body>

</html>