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
    <title>Calendrier</title>
</head>

<?php include('../views/include/navbar.php')?>

<div class="infos container">
<h2 class="my-5">Mes infos</h2>
<?php if(!isset($user['parent2'])) { ?>

<?php foreach($infoList as $info) { ?>
<p>Votre Identifiant : <input class="fw-bold" value="<?=$info['mail']?>"></input></p>
<div class="infoModif">
<p>Vos enfant(s) : </p>
<?php foreach($childList as $child) { ?>
<input class="fw-bold" value="<?=$child['child_firstname']?>"></input> 
<?php } ?></p><button class="btn btn-primary ">Modifier</button>
</div>
<p>Calendrier partagé avec : <span class="fw-bold"><?=$info['parent2_nickname']?></span></p>
<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">Supprimer le compte</button>

    <?php } } else { ?>
        <?php foreach($infoList as $info) { ?>
    <p>Votre Identifiant : <span class="fw-bold"><?=$info['parent2_nickname']?></span></p>
    <p>Vos enfant(s) :
    <?php foreach($childList as $child) { ?>
    <span class="fw-bold">( <?=ucfirst($child['child_firstname'])?> )</span> 
    <?php } ?></p>
    <p>Calendrier partagé avec : <span class="fw-bold"><?=$info['mail']?></span>  </p>
  <?php  }} ?>
</div>


                <!-- Modal -->
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
                                <a href="../controllers/controller-infos.php?id=<?=$user['parent_id']?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                            </div>
                        </div>
                    </div>
                </div>

<?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>