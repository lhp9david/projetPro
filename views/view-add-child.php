<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/calendar.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/style.css">
    <title>Documents</title>
</head>

<body>
<?php foreach($childList as $child) { ?>
  <p> <?= $child['child_firstname'] ?> à bien été ajouté(e) </p> 

    <?php } ?>

<button class="addChild btn btn-success fw-bold"><a href="../controllers/controller-inscription2.php">Ajouter un enfant</a></button>
<button class="addChild btn btn-success fw-bold"><a href="../controllers/controller-inscription3.php">j'ai fini</a></button>


    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>


</body>

</html>