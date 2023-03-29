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
    <title>Mes infos</title>
</head>

<?php include('../views/include/navbar.php') ?>

<div class="infos row mx-0">
    <h2 class="my-3 text-center">Mes infos</h2>
    <?php if (!isset($user['parent2'])) { ?>

        <?php foreach ($infoList as $info) { ?>

            <div class="infosParent col-lg-4 text-center ">
                <div><img src="../assets/img/user.png" alt=""></div>
                <p class="fw-bold"><?= $info['mail'] ?></p>
            </div>
            <div class="infosEnfant col-lg-4  text-center">
                <div><img src="../assets/img/boy.png" alt=""></div>
                <?php foreach ($childList as $child) { ?>
                    <p class="fw-bold"><?= ucfirst($child['child_firstname']) ?></p>
                <?php } ?>
            </div>
            <div class="infosParent2 col-lg-4 text-center">
                <div><img src="../assets/img/user.png" alt=""></div>
                <p class="fw-bold"><?= $info['parent2_nickname'] ?></p>
            </div>
            <div class="mx-auto">
                <div class="mx-auto text-center mb-2 col-lg-6"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalPass">Modifier mon mot de passe</button></div>
                <div class="mx-auto text-center mb-2 col-lg-6"><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">Supprimer le compte</button></div>
            </div>



        <?php }
    } else { ?>
        <?php foreach ($infoList as $info) { ?>
            <div class="infosParent col-lg-4 text-center ">
                <div><img src="../assets/img/user.png" alt=""></div>
                <p class="fw-bold"><?= $info['parent2_nickname'] ?></p>
            </div>
            <div class="infosEnfant col-lg-4  text-center">
                <div><img src="../assets/img/boy.png" alt=""></div>
                <?php foreach ($childList as $child) { ?>
                    <p class="fw-bold"><?= ucfirst($child['child_firstname']) ?></p>
                <?php } ?>
            </div>
            <div class="infosParent2 col-lg-4 text-center">
                <div><img src="../assets/img/user.png" alt=""></div>
                <p class="fw-bold"><?= $info['mail'] ?></p>
            </div>
            <div class="mx-auto text-center mb-2 col-lg-6"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalPass">Modifier mon mot de passe</button></div>
    <?php  }
    } ?>
</div>


<!-- Modal de suppression du compte  -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer votre compte</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Attention la suppression de votre compte est définitive. Vos données seront perdues.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="../controllers/controller-infos.php?delete"><button type="button" class="btn btn-danger">Supprimer</button></a>
            </div>
        </div>
    </div>
</div>
<!-- Modal de modif de password  -->
<div class="modal fade <?= !empty($errors) ? 'openModal' : ''  ?>" id="exampleModalPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier votre mot de passe</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div>
                        <label class="fw-bold" for="oldPass">Mot de passe actuel</label>
                        <input class="w-100 " type="password" name="oldPass">
                        <p class="text-danger fw-bold"><?= $errors['oldPass'] ?? '' ?> </p>
                        
                    </div>
                    <div>
                        <label class=" fw-bold" for="newPass">Nouveau mot de passe</label>
                        <input class="w-100" type="password" name="newPass">
                        <p class="text-danger fw-bold"><?= $errors['newPass'] ?? '' ?></p>
                    </div>
                    <div>
                        <label class="fw-bold" for="confirmNewPass">Confirmer le nouveau mot de passe</label>
                        <input class="w-100 fw-bold" type="password" name="confirmNewPass">
                        <p class="text-danger fw-bold"><?= $errors['confirmNewPass'] ?? '' ?></p>
                        <p class="text-danger fw-bold"><?= $errors['error'] ?? '' ?></p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <input type="submit" name="pass" value="Modifier" class="btn btn-warning"></input>
            </div>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_GET['pass'])) { ?>


<?php } ?>


<?php include('../views/include/footer.php') ?>
<script src="../assets/js/bootstrap.bundle.js"></script>

<script>
    let modal = document.querySelector('.openModal');
    if (modal) {
        let openModal = new bootstrap.Modal(modal, {
            keyboard: false
        })
        openModal.show();
    };
  
</script>
<script src="../script.js"></script>
</body>

</html>