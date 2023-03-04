

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
    <title>Ajout des enfants</title>
</head>

<body>
    <a class="text-dark" href="/index.php"><i class="bi bi-arrow-left-circle-fill fs-1 mx-3"></i></a>
    <h1 class="inscription text-center fw-bold fs-1">Ajout de vos enfants</h1>

    <div class="container">

        <form action="" method="POST" class="col-lg-6 mx-auto">
            <div class="child">
                <div class="mb-3">
                    <label for="childFirstname" class="form-label fw-bold fs-5">Prénom</label>
                    <input type="text" class="form-control" id="childFirstname" name="childFirstname" value="<?= (isset($_POST['childFirstname'])) ? $_POST['childFirstname'] : ''; ?>"><span class="text-danger"><?= isset($errors['childFirstname']) ? $errors['childFirstname'] : '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="childName" class="form-label fw-bold fs-5">Nom</label>
                    <input type="text" class="form-control" id="childName" name="childName" value="<?= (isset($_POST['childName'])) ? $_POST['childName'] : ''; ?>"><span class="text-danger"><?= isset($errors['childName']) ? $errors['childName'] : '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label fw-bold fs-5">Date de naissance</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= (isset($_POST['birthdate'])) ? $_POST['birthdate'] : ''; ?>"><span class="text-danger"><?= isset($errors['birthdate']) ? $errors['birthdate'] : '' ?></span>
                </div>
            </div>
            <?= (isset($errors['error'])) ? '<span class="text-danger">' . $errors['error'] . '</span>' : '' ?>
            <button type="submit" class="btn btn-warning fw-bold mx-auto d-block">Valider</button>
          
        </form>
    </div>
   



    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>


</body>

</html>