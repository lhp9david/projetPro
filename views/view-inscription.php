<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/img/calendar.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/style.css">
  <title>Inscription</title>
</head>

<body>
 <a class="text-dark" href="/index.php"><i class="bi bi-arrow-left-circle-fill fs-1 mx-3"></i></a> 
  <h1 class="inscription text-center fw-bold fs-1">Inscription</h1>
  <div class="container">

    <form action="" method="POST" class="col-lg-6 mx-auto">
      <div class="mb-3">
        <label for="firstname" class="form-label fw-bold fs-5">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label fw-bold fs-5">Nom</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label fw-bold fs-5">Adresse email</label>
        <input type="email" class="form-control" id="email" name="mail">
      </div>
      <div class="mb-3">
        <label for="confirmMail" class="form-label fw-bold  fs-5">Confirmer votre email</label>
        <input type="email" class="form-control" id="confirmMail" name="confirMmail">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label fw-bold  fs-5">Veuillez choisir un mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3">
        <label for="confirmPass" class="form-label fw-bold  fs-5">Confirmer le mot de passe</label>
        <input type="password" class="form-control" id="confirmPass" name="confirmPass">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="CGU" name="CGU">
        <label class="form-check-label fw-bold fs-5" for="CGU">Veuillez accepter les CGU</label>
      </div>
      <button type="submit" class="btn btn-warning">Valider</button>
    </form>
  </div>




  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>