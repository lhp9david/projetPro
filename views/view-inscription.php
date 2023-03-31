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

<body class='bloc-inscription'>
 <a class="text-dark" href="/index.php"><i class="bi bi-arrow-left-circle-fill fs-1 mx-3"></i></a> 
  <h1 class="inscription text-center fw-bold fs-1">Inscription</h1>
  <div class="container p-3">

    <form action="" method="POST" class="col-lg-6 mx-auto">
      <div class="mb-3">
        <label for="firstname" class="form-label fw-bold fs-5">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= (isset($_POST['firstname'])) ? $_POST['firstname'] : ''; ?>"><span class="text-danger fw-bold"><?= isset($errors['firstname']) ? $errors['firstname'] : '' ?></span>
      </div>
      <div class="mb-3">
        <label for="lastname" class="form-label fw-bold fs-5">Nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= (isset($_POST['lastname'])) ? $_POST['lastname'] : '';?>"><span class="text-danger fw-bold"><?= isset($errors['lastname']) ? $errors['lastname'] : '' ?></span>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label fw-bold fs-5">Adresse email</label>
        <input type="email" class="form-control" id="email" name="mail" value="<?= (isset($_POST['mail'])) ? $_POST['mail'] : ''; ?>"><span class="text-danger fw-bold"><?= isset($errors['mail']) ? $errors['mail'] : '' ?></span>
      </div>
    
      <div class="mb-3">
        <label for="password" class="form-label fw-bold  fs-5">Veuillez choisir un mot de passe</label>
        <input type="password" class="form-control" id="password" name="password"><span class="text-danger fw-bold"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
      </div>
      <div class="mb-3">
        <label for="confirmPass" class="form-label fw-bold  fs-5">Confirmer le mot de passe</label>
        <input type="password" class="form-control" id="confirmPass" name="confirmPass"><span class="text-danger fw-bold"><?= isset($errors['confirmPass']) ? $errors['confirmPass'] : '' ?><?= isset($errors['error']) ? $errors['error'] : '' ?></span>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="CGU" name="CGU">
        <label class="form-check-label fw-bold fs-5" for="CGU">Veuillez accepter les CGU</label> <br> <span class="text-danger fw-bold"><?= isset($errors['CGU']) ? $errors['CGU'] : '' ?></span>
      </div>
      <div class="g-recaptcha" data-sitekey="6LcaqjslAAAAAFXpVUVdOBY_xt5e8gmkmZxsS7w9"></div>
        <p class="text-danger fw-bold text-center"><?= $errors['captcha'] ?? '' ?></p>
      <button type="submit" class="btn btn-warning fw-bold mx-auto d-block">Valider</button>
    </form>
  </div>

 


  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="script.js"></script>

    <!-- script pour le recaptcha de google  -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
  <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
</body>

</html>