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

    <div class="AddEvent ">

        <div class="doc  my-5 mx-auto ">
            <h3>Ajouter un événement</h3>
            <form action="../controllers/controller-rdv.php" method="POST">
                <div><input type="date" name="dateEvenement" value="<?= $_GET['date'] ?>"></div>
                <div><input type="time" name="heureEvenement"></div>
                <div> <select name="motifEvent" id="event-select">
                        <option value="0">--Choisir evenement--</option>
                        <option value="Sortie scolaire">Sortie scolaire</option>
                        <option value="Rendez-vous médical">Rendez vous médical</option>
                        <option value="Autre">Autre</option>
                    </select></div>
                <div><textarea name="noteEvenement" id="" cols="30" rows="5"></textarea></div>

                <div><input type="submit" value="Ajouter"></div>
            </form>

        </div>
    </div>


    <?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>