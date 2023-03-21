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



<body>


    <?php include('../views/include/navbar.php')?>

    <div class="container mb-5">
        <?php if (isset($_GET['year']) && isset($_GET['month'])) {

            $month = $_GET['month'];
            $year = $_GET['year'];
            echo '<div class="row">';
            showForm($month, $year);
            echo '<h1 class="col-lg-6 text-end mt-5">'.$months[$month].' '.$year.'</h1>';
            echo '</div>';
            showCalendar($month, $year);
            
        } else {
            echo '<div class="row">';
            showForm(date('m'), date('Y'));
            echo '<h1 class="col-lg-6 text-end mt-5">'.$months[date('m')].' '.date('Y').'</h1>';
            echo '</div>';
            showCalendar(date('m'), date('Y'));
        }

        ?>
<div class="legend">
<div class="legend_pastille"><div class="pastille eventMedecin"></div><div>Medical</div></div>
<div class="legend_pastille"><div class="pastille eventAnniv"></div><div>Anniversaire</div></div>
<div class="legend_pastille"><div class="pastille eventSport"></div><div>Sport</div></div>
<div class="legend_pastille"><div class="pastille eventScolaire"></div><div>Ecole</div></div>
<div class="legend_pastille"><div class="pastille eventAutre"></div><div>Autre</div></div>
</div>
    </div>
    <?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>