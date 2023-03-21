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

<div class="infos container text-center">
<h2>Mes infos</h2>
<?php if(!isset($user['parent2'])) { ?>

<?php foreach($infoList as $info) { ?>
<p>Votre Identifiant : <span class="fw-bold"><?=$info['mail']?></span></p>
<p>Vos enfant(s) :
<?php foreach($childList as $child) { ?>
<span class="fw-bold">(<?=$child['child_firstname']?>) </span> 
<?php } ?></p>
<p>Calendrier partagé avec : <span class="fw-bold"><?=$info['parent2_nickname']?></span>  </p>

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


<?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>