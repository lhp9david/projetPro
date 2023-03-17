<?php
session_start();
include('../helpers/database.php');
include('../config/env.php');
include('../models/Child.php');
include('../models/Event.php');
$name = new Child();
$nameList = $name-> displayChild();

?>
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
    <title>Calendrier</title>
</head>



<body class="add-event">

    <?php include('../views/include/navbar.php') ?>

    <div class="AddEvent">

        <div class="doc  my-5 mx-auto ">
            <h3>Ajouter un événement</h3>
            <form action="../controllers/controller-rdv.php" method="POST">
                <div><input class="w-100" type="date" name="dateEvent" value="<?= $_GET['date'] ?? '' ?>"></div>
                <div><input class="w-100" type="time" name="hourEvent"></div>
                <div> <select class="w-100" name="childname" id="child">
                        <option value="">--Choisir l'enfant--</option>
                        <?php foreach ($nameList as $name) { ?>
                        <option value="<?= $name['child_id'] ?? '' ?>">    <?= $name['child_firstname'] ?? '' ?></option>
                        <?php } ?>
                    </select></div>
                <div> <select class="w-100" name="motifEvent" id="event-select">
                        <option value="">--Choisir evenement--</option>
                        <option value="1">Rendez-vous médical</option>
                        <option value="2">Anniversaire</option>
                        <option value="3">Sport</option>
                        <option value="4">Sortie scolaire</option>
                        <option value="5">Autre</option>

                    </select></div>
                <div><textarea class="w-100" name="noteEvenement" id="" cols="30" rows="5"></textarea></div>

                <div class='text-center'><input type="submit" value="Ajouter"></div>
                <?php if (isset($_GET['error'])) { echo 'Veuillez remplir tous les champs';} else { '';} ?>
            </form>

        </div>
    </div>


    <?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>