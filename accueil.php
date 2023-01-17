<?php
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}

if (isset($_GET['month'])) {
    $month = $_GET['month'];
}
$days = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
$months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'];

function showCalendar($month, $year)
{
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    echo '
    
    <table>
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
        echo '<td>' . $i . '</td>';

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

<body>

    <div class="container">
        <div class="row">
        <form class="col-lg-6 m-auto my-5" class="" method="">
            <label for="year">Choisir l'année:</label>
            <select id="year" name="year">
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
            </select>
            <br>
            <label for="month">Choisir le mois:</label>
            <select id="month" name="month">
                <option value="1">Janvier</option>
                <option value="2">Février</option>
                <option value="3">Mars</option>
                <option value="4">Avril</option>
                <option value="5">Mai</option>
                <option value="6">Juin</option>
                <option value="7">Juillet</option>
                <option value="8">Août</option>
                <option value="9">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="12">Décembre</option>
            </select>
            <br><br>
            <input type="submit" value="Envoyer">
        </form>

        <h1><?=$month.' '.$year?></h1>
        <?php if (isset($_GET['year']) && isset($_GET['month'])) {
            // if($_GET['month']>12 || )
            $month = $_GET['month'];
            $year = $_GET['year'];
            showCalendar($month, $year);
        } else {
            showCalendar(date('m'), date('Y'));
        } ?>
        </div>

    </div>

    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>