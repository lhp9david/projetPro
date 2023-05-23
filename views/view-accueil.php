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
    <title>Calendrier | Les enfants d'abord</title>
</head>



<body>


    <?php include('../views/include/navbar.php')?>

    <div class="container mb-5">
        <?php if (isset($_GET['year']) && isset($_GET['month'])) {

            $month = $_GET['month'];
            $year = $_GET['year'];
            echo '<div class="tete row mx-auto">';
            '<div class="col-lg-6">'. showForm($month, $year) .'</div>';
            echo '<h1 class="col-lg-3 text-end mt-3 ">'.$months[$month].' '.$year.'</h1>';
            echo '</div>';
            showCalendar(ltrim($month, '0'), $year);
            
        } else {
            echo '<div class="tete row mx-auto">';
            showForm(date('m'), date('Y'));
            echo '<h1 class="col-lg-3 text-end mt-3">'.$months[date('m')].' '.date('Y').'</h1>';
            echo '</div>';
            showCalendar(ltrim(date('m'), '0'), date('Y'));
        }

        ?>
<div class="legend">
<div class="legend_pastille"><img src="../assets/img/eventMedecin.png" alt=""><div>Medical</div></div>
<div class="legend_pastille"><img src="../assets/img/eventAnniv.png" alt=""><div>Anniversaire</div></div>
<div class="legend_pastille"><img src="../assets/img/eventSport.png" alt=""><div>Sport</div></div>
<div class="legend_pastille"><img src="../assets/img/eventScolaire.png" alt=""><div>Ecole</div></div>
<div class="legend_pastille"><img src="../assets/img/eventAutre.png" alt=""><div>Autre</div></div>
<div class="legend_pastille"><img src="../assets/img/red.png" alt=""><div>Zone A</div></div>
<div class="legend_pastille"><img src="../assets/img/blue.png" alt=""><div>Zone B</div></div>
<div class="legend_pastille"><img src="../assets/img/green.png" alt=""><div>Zone C</div></div>
</div>
    </div>
    
    <?php include('../views/include/footer.php') ?>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>