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

<div class="container message">
<?php foreach($childList as $child) { ?>
  <h1 class="mb-5"> <span class="fw-bold"><?= ucfirst($child['child_firstname']) ?></span>  a bien été ajouté(e) </h1> 

    <?php } ?>

<button class="addChild btn btn-success fw-bold my-2"><a href="../controllers/controller-inscription2.php">Ajouter un autre enfant</a></button>
<button class="addChild btn btn-outline-success mt-5 fw-bold"><a href="../controllers/controller-inscription3.php" class="text-black">J'ai fini</a></button>
</div>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>


</body>

</html>