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



<body>


<?php include('../views/include/navbar.php') ?>

<div class="container">
    <?php if (isset($_GET['year']) && isset($_GET['month'])) {

        $month = $_GET['month'];
        $year = $_GET['year'];
        '<div class="row">' . showForm($month, $year) . '</div>';

        showCalendar($month, $year);
    } else {
        
        showForm(date('m'), date('Y'));
        showCalendar(date('m'), date('Y'));
    }
    

    ?>

        <div class="row mx-auto">
          

                <div class="shareDoc col-lg-6">

                    <div class="doc  my-5 mx-auto ">
                        <h3>Ajouter un événement</h3>
                        <input type="date"> <br><br>
                        <input type="submit" value="Ajouter">
                    </div>
                </div>

                <div class="AddEvent col-lg-6">

                    <div class="doc  my-5 mx-auto ">
                        <h3>Partager un document</h3>
                        <input type="file"> <br><br>
                        <input type="submit" value="Envoyer">
                    </div>
                </div>
           


        </div>

    </div>
     <?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>


