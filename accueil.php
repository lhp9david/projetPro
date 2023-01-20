<?php
if (isset($_GET['year']) && isset($_GET['month'])) {
    if ($_GET['year'] < 1970 || $_GET['year'] > 2037 || $_GET['month'] > 12 || $_GET['month'] < 1) {
        // au moins un champ est vide
        // redirigez l'utilisateur vers la page d'erreur
        header('Location: accueil.php');
        exit;
    }

}



function showCalendar($month, $year,)
{


    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
    $holidays = [
        date("d-M-Y", mktime(0, 0, 0, 1, 1, $year)) => 'Nouvel an',
        date("d-M-Y", strtotime('+1 day', easter_date($year))) => 'Lundi de Pâques',
        date("d-M-Y", mktime(0, 0, 0, 5, 1, $year)) => 'Fête du Travail',
        date("d-M-Y", mktime(0, 0, 0, 5, 8, $year)) => 'Victoire 45',
        date("d-M-Y", strtotime('+39 days', easter_date($year))) => 'Ascension',
        date("d-M-Y", strtotime('+50 days', easter_date($year))) => 'Lundi de Pentecôte',
        date("d-M-Y", mktime(0, 0, 0, 7, 14, $year)) => 'Fête Nationale',
        date("d-M-Y", mktime(0, 0, 0, 8, 15, $year)) => 'Assomption',
        date("d-M-Y", mktime(0, 0, 0, 11, 1, $year)) => 'Toussaint',
        date("d-M-Y", mktime(0, 0, 0, 11, 11, $year)) => 'Armistice',
        date("d-M-Y", mktime(0, 0, 0, 12, 25, $year)) => 'Jour de Noël'

    ];

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    echo   '<h1 class="text-end">'  . $months[$month - 1] . ' ' . $year . '</h1>' . '
    
    <table class="col-12">
        <thead>
            <tr>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>
        </thead> 
        <tbody>
    ';

    // boucle pour parcourir les jrs du mois + fonction date() pour déterminer le jr de la semaine 
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $dayOfWeek = date('N', mktime(0, 0, 0, $month, $i, $year));
        // creation de cellules vides avant le 1er du mois
        if ($i == 1) {
            echo '<tr>';
            for ($j = 1; $j < $dayOfWeek; $j++) {
                echo '<td class="bg-secondary"></td>';
            }
        }
        // afficher les jrs du mois
        // date d'aujourd'hui en jaune
        if (date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)) == date('d-M-Y')) {

            echo '<td class="bg-warning text-black">' . $i  . '</td>';
            // jours fériés en vert
        } else if (array_key_exists(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $holidays)) {

            echo '<td class="bg-light text-black border border-dark">' . $holidays[date('d-M-Y', mktime(00, 00, 00, $month, $i, $year))]   . '</td>';
        } else {
            echo '<td>' . $i . '</td>';
        }

        // creation de cellules vides après le dernier du mois
        if ($dayOfWeek == 7) {
            echo '</tr>';
        } else if ($i == $daysInMonth) {
            for ($j = $dayOfWeek; $j < 7; $j++) {
                echo "<td class='bg-secondary'></td>";
            }
            echo '</tr>';
        }
    }
    echo "</tbody>";
    echo "</table>";
}

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/calendar.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Calendrier</title>
</head>

<?php include('../projetPro/views/include/navbar.php') ?>

<body>

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
 <?php include('../projetPro/views/include/footer.php') ?>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>

<?php
function showForm($month, $year)
{
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
    $formatter->setPattern('MMMM');
    echo '  <form class="choice mx-auto my-5 " action="" method="get">
            <div>
            <label for="month">mois</label>';
    echo '  </select><a class="" href="?month=' . (($month == 1) ? 12 : $month - 1) . '&year=' . (($month == 1) ? $year - 1 : $year) . '"><img class="arrow" src="assets/img/left.png" alt="gauche"></a>';
    echo '  <select class = "mx-auto"name="month">';

    // Génère une liste de mois de janvier à décembre, ucfirst() met la première lettre en majuscule

    for ($m = 1; $m <= 12; $m++) {
        $monthlist = $formatter->format(mktime(0, 0, 0, $m, 1, date('Y')));
        if ($m == $month) {
            echo '<option selected value=' . $m . '>' . ucfirst($monthlist) . '</option>';
        } else {
            echo '<option value=' . $m . '>' . ucfirst($monthlist) . '</option>';
        }
    }
    echo '  </select><a class="" href="?month=' . (($month == 12) ? 1 : $month + 1) . '&year=' . (($month == 12) ? $year + 1 : $year) . '"><img class="arrow" src="assets/img/right.png" alt="droite"></a><br>';
    echo '<label for="year" class="d-block mx-auto">année</label>';
    echo '<select class="mx-auto d-block" name="year">';

    // Génère la liste des années de 1970 à 2037

    for ($y = 1970; $y <= 2037; $y++) {
        if ($y == $year) {
            echo '<option selected value=' . $y . '>' . $y . '</option>';
        } else {
            echo '<option value=' . $y . '>' . $y . '</option>';
        }
    }

    echo '  </select></div>
            <input class="test mx-auto d-block mt-5 text-center" type="submit" value="valider">
            </form>';
} ?>

<?php
    // je recupere le JSON
    @$json = file_get_contents('vacanceZoneC.json');
    if ($json === false) {
        echo 'erreur technique';
        exit;
    }

    //je le transforme en tableau
    $vacanceZoneC = json_decode($json, true);
    $dateDebut = [];
    foreach ($vacanceZoneC as $value) {
       array_push($dateDebut,($value['start_date']));
    }
    
?>