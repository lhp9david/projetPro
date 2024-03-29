<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/img/calendar.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/style.css">
  <title>Inscription</title>
</head>

<body class='bloc-inscription'>

  <h1 class="inscription text-center fw-bold fs-1">Accès du 2eme parent</h1>


<div class="container p-3">
<form action="" method="POST" class="col-lg-6 mx-auto">

<div class="mb-3">
  <p class="inscription text-center fw-bold my-5">Veuillez indiquer ici l'adresse mail de votre ex conjoint(e) et choisissez lui un mot de passe provisoire que vous devez lui communiquer pour qu'il puisse avoir accès au calendrier. <br>
Avec ce compte il/elle aura accès aux evenements et documents que vous posterez, et pourra aussi ajouter les siens</p>
</div>
<div class="mb-3">
  <label for="pseudoParent2" class="form-label fw-bold fs-5">Mail</label>
  <input type="text" class="form-control" id="pseudoParent2" name="pseudoParent2"><span class="text-danger"><?=$errors['pseudoParent2'] ?? ''?></span>
</div>
<div class="mb-3">
  <label for="passwordParent2" class="form-label fw-bold  fs-5">Veuillez choisir un mot de passe</label>
  <input type="password" class="form-control" id="passwordParent2" name="passwordParent2"><span class="text-danger"><?=$errors['passwordParent2']?? ''?></span>
</div>
<div class="mb-3">
  <label for="confirmPassParent2" class="form-label fw-bold  fs-5">Confirmer le mot de passe</label>
  <input type="password" class="form-control" id="confirmPassParent2" name="confirmPassParent2"><span class="text-danger"><?= $errors['confirmPassParent2'] ?? '' ?></span>
</div>
<button type="submit" class="btn btn-warning fw-bold mx-auto d-block">Valider</button>
</form>
</div>

  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>