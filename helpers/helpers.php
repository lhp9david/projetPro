<?php
if (isset($_GET['year']) && isset($_GET['month'])) {
    if ($_GET['year'] < 1970 || $_GET['year'] > 2037 || $_GET['month'] > 12 || $_GET['month'] < 1) {
        // au moins un champ est vide
        // redirigez l'utilisateur vers la page d'erreur
        header('Location: controller-accueil.php');
        exit;
    }

}


/**************************************************fonction pour afficher le formulaire *********************************************/
function showCalendar($month, $year)
{

    

    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    // tableau des jours fériés
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

// nombre de jours dans le mois
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    echo     '
    
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

            echo '<td class="bg-warning text-black type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-'.$i.'"">'.$i.'</td>';
            createModal($month, $i, $year, $holidays);

            
            // jours fériés en blanc
        } else if (array_key_exists(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $holidays)) {

            echo '<td class="bg-light text-black border border-dark type="button" data-bs-toggle="modal" data-bs-target="#modal-'.$i.'">' . $holidays[date('d-M-Y', mktime(00, 00, 00, $month, $i, $year))]   . '</td>';
            createModal($month, $i, $year, $holidays);
        } else {
            echo '<td class="type="button" data-bs-toggle="modal" data-bs-target="#modal-'.$i.'">' . $i . '</td>';
            createModal($month, $i, $year, $holidays);
        }

        // creation de cellules vides après le dernier du mois
        if ($dayOfWeek == 7) {
            echo '</tr>';
        } else if ($i == $daysInMonth) {
            for ($j = $dayOfWeek; $j < 7; $j++) {
                echo '<td class="bg-secondary "></td>';
                
            }
            echo '</tr>';
        }
    }
    echo "</tbody>";
    echo "</table>";

}



/******************************************Fonction pour afficher le formulaire******************************************/
function showForm($month, $year)
{
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
    $formatter->setPattern('MMMM');
    echo '  <form class="col-lg-6" action="" method="get">
            
            <label for="month">mois</label>';
    echo '  </select><a class="" href="?month=' . (($month == 1) ? 12 : $month - 1) . '&year=' . (($month == 1) ? $year - 1 : $year) . '"><img class="arrow" src="../assets/img/left.png" alt="gauche"></a>';
    echo '  <select class = ""name="month">';

    // Génère une liste de mois de janvier à décembre, ucfirst() met la première lettre en majuscule

    for ($m = 1; $m <= 12; $m++) {
        $monthlist = $formatter->format(mktime(0, 0, 0, $m, 1, date('Y')));
        if ($m == $month) {
            echo '<option selected value=' . $m . '>' . ucfirst($monthlist) . '</option>';
        } else {
            echo '<option value=' . $m . '>' . ucfirst($monthlist) . '</option>';
        }
    }
    echo '  </select><a class="" href="?month=' . (($month == 12) ? 1 : $month + 1) . '&year=' . (($month == 12) ? $year + 1 : $year) . '"><img class="arrow" src="../assets/img/right.png" alt="droite"></a>';
    echo '<label for="year" class="me-2">année</label>';
    echo '<select class="" name="year">';

    // Génère la liste des années de 1970 à 2037

    for ($y = 1970; $y <= 2037; $y++) {
        if ($y == $year) {
            echo '<option selected value=' . $y . '>' . $y . '</option>';
        } else {
            echo '<option value=' . $y . '>' . $y . '</option>';
        }
    }

    echo '  </select>
            <input class="" type="submit" value="valider">
            </form>';
}

/*****************************fonction pour creer la modal  ******************************************************/
function createModal($month, $i, $year, $holidays){ ?>
    <!-- Modal -->
<div class="modal fade" id="modal-<?=$i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?=  $i .'/'.$month. '/' .$year?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= $holidays[date('d-M-Y', mktime(00, 00, 00, $month, $i, $year))] ?? ' '?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning fw-bold "><a class="text-black" href="../views/add-event.php?<?='date='.$year.'-'.$month.'-'.$i?>">Ajouter un évènement</a> </button>
      </div>
    </div>
  </div>
</div>
 <?php } ?>

 <?php
/*********************************************fonction pour verifier la validité du fichie **************************************************/


function checkImage($inputName, $maxSize, $arrayExt)
{

    

    $response = [];


    if ($_FILES[$inputName]['error'] == 4) {
        $response = [
            'status' => false,
            'message' => 'Veuillez selectionner un document'
        ];
    } else {
        $response = [
            'status' => true,
            'message' => 'Image safe'
        ];

        if ((!preg_match('/image/', mime_content_type($_FILES[$inputName]['tmp_name']))) || (!preg_match('/application/', mime_content_type($_FILES[$inputName]['tmp_name'])))) {
            $response = [
                'status' => false,
                'message' => 'veuillez selectionner uniquement une image ou un pdf'
            ];
        }

        $mime = mime_content_type($_FILES[$inputName]['tmp_name']);
        $array = explode('/', $mime);


        if (!in_array($array[1], $arrayExt)) {

            $extension = implode('-', $arrayExt);
            $response = [
                'status' => false,
                'message' => 'Veuillez selectionner un document parmi les extensions suivantes ' . $extension
            ];
        }

        if ($_FILES[$inputName]['size'] > $maxSize * 1024 * 1024) {

            $response = [
                'status' => false,
                'message' => 'Veuillez selectionner un document inferieur à 2Mo'
            ];
        }

    }
    return $response;
}

/**********************************fonction pour ajouter un evenement  *****************************************/

function addEvent($date,$type,$heure,$note){
    
    echo'<div class=" my-3 row event">
    <p class="col-lg-3">'.$date.' </p>
    <p class="col-lg-3">'.$type.'</p>
    <p class="col-lg-4">'.$note.'</p>
    <p class="col-lg-2">'.$heure.'</p>
</div>';
}
?>

