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
  include('../models/Event.php');
  include('../models/Child.php');
  include('../helpers/database.php');
  include('../config/env.php');

  $event_date = [];
  $events = new Event;
  $event = $events->showEventDate();
  foreach ($event as $value) {

    array_push($event_date, (date('d-M-Y', strtotime($value['event_date']))));
  }

  $birthday = [];
  $birthdate = new Child;
  $date = $birthdate->displayChildBirthday();
  foreach ($date as $value) {
    array_push($birthday, date('d-M-' . $year, strtotime($value['birthdate'])));
  }

  $typeColor = [
    1 => 'eventMedecin',
    2 => 'eventAnniv',
    3 => 'eventSport',
    4 => 'eventScolaire',
    5 => 'eventAutre'
  ];


  function checkEvent($event, $date)
  {

    $result = [];
    foreach ($event as $value) {
      if (in_array($date, $value)) {
        array_push($result, $value['event_type_id']);
      }
    }
    return $result;
  }
  
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
    
    <table class="col-12 shadow table">
        <thead>
            <tr>
                <th>L</th>
                <th>M</th>
                <th>M</th>
                <th>J</th>
                <th>V</th>
                <th>S</th>
                <th>D</th>
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

        echo '<td class="grey"></td>';
      }
    }
    // si date d'aujourd'hui et evenement
    if (in_array(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $event_date) && date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)) == date('d-M-Y')) {

      echo '<td class=" text-black type="button" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<span class="number">' . $i . '</span>' . '</td>';
      createModalEvent($month, $i, $year);

      // si evenement et weekend
    } else if (!empty(checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year)))) && $dayOfWeek == 6 || !empty(checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year)))) && $dayOfWeek == 7) {

      echo '<td class="text-black grey" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<span class="number">' . $i . '</span>';
      echo '<div class="container_pastille">';

      foreach (checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year))) as $value) {
        echo '<div class="pastille my-1 ' . $typeColor[$value] . '">' . '</div>';
      }

      echo '</div>';
      echo '</td>';
      createModalEvent($month, $i, $year);


      // si evenement et jour férié
    } else if (!empty(checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year)))) && array_key_exists(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $holidays)) {

      echo '<td class="grey text-black" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' .  $holidays[date('d-M-Y', mktime(00, 00, 00, $month, $i, $year))]  ;
      echo '<div class="container_pastille">';

      foreach (checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year))) as $value) {
        echo '<div class="pastille my-1 ' . $typeColor[$value] . '">' . '</div>';
      }

      echo '</div>';
      echo '</td>';
      createModalEvent($month, $i, $year);

      // si anniversaire et jour ferie 
    } else if (in_array(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $birthday) && array_key_exists(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $holidays)) {

      echo '<td class="grey text-black" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<img class="present" src="../assets/img/cadeau.png" alt="">' . '</td>';
      createModalBirthday($month, $i, $year);

      // si anniversaire et weekend
    } else if (in_array(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $birthday) && $dayOfWeek == 6 || in_array(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $birthday) && $dayOfWeek == 7) {

      echo '<td class="grey text-black" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<img class="present" src="../assets/img/cadeau.png" alt="">' . '</td>';
      createModalBirthday($month, $i, $year);

      // si anniversaire et evenement
    } else if (in_array(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $birthday) && !empty(checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year))))) {

      echo '<td class=" text-black" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<img class="present" src="../assets/img/cadeau.png" alt="">';
      echo '<div class="container_pastille">';

      foreach (checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year))) as $value) {
        echo '<div class="pastille my-1 ' . $typeColor[$value] . '">' . '</div>';
      }

      echo '</div>';
      echo '</td>';
      createModalEvent($month, $i, $year);
      createModalBirthday($month, $i, $year);

      // si jour férié
    } else if (array_key_exists(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $holidays)) {

      echo '<td class="grey text-black border border-dark" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . $holidays[date('d-M-Y', mktime(00, 00, 00, $month, $i, $year))]   . '</td>';
      createModal($month, $i, $year, $holidays);

      // anniversaire en vert
    } else if (in_array(date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)), $birthday)) {
      echo '<td class=" text-black" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<img class="present" src="../assets/img/cadeau.png" alt="">' . '</td>';
      createModalBirthday($month, $i, $year);

      // date d'aujourd'hui en jaune
    } else if (date('d-M-Y', mktime(0, 0, 0, $month, $i, $year)) == date('d-M-Y')) {

      echo '<td class="bg-warning text-black"  data-bs-toggle="modal" data-bs-target="#modal-' . $i . '"">' . '<span class="number">' . $i . '</span>' . '</td>';
      createModal($month, $i, $year, $holidays);

      // si evenement
    } else if (!empty(checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year))))) {
      echo '<td class="text-black" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<span class="number">' . $i . '</span>';
      echo '<div class="container_pastille">';
      foreach (checkEvent($event, date('Y-m-d', mktime(0, 0, 0, $month, $i, $year))) as $value) {

        echo '<div class="pastille my-1 ' . $typeColor[$value] . '">' . '</div>';
      }
      echo '</div>';
      echo '</td>';
      createModalEvent($month, $i, $year);

      //samedi et dimanche en gris
    } else if ($dayOfWeek == 6 || $dayOfWeek == 7) {

      echo '<td class="grey" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<span class="number">' . $i . '</span>' . '</td>';
      createModal($month, $i, $year, $holidays);

    } else {

      echo '<td class="type="button" data-bs-toggle="modal" data-bs-target="#modal-' . $i . '">' . '<span class="number">' . $i . '</span>' . '</td>';
      createModal($month, $i, $year, $holidays);

    }

    // creation de cellules vides après le dernier du mois
    if ($dayOfWeek == 7) {
      echo '</tr>';
    } else if ($i == $daysInMonth) {
      for ($j = $dayOfWeek; $j < 7; $j++) {
        echo '<td class="grey"></td>';
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
  echo '  <form class="col-lg-6 mt-5" action="" method="get">
            
            <label for="month"></label>';
  echo '  </select><a class="" href="?month=' . (($month == '1') ? '12' : $month - '1') . '&year=' . (($month == '01') ? $year - 1 : $year) . '"><img class="arrow" src="../assets/img/left.png" alt="gauche"></a>';
  echo '  <select class = ""name="month">';

  // Génère une liste de mois de janvier à décembre, ucfirst() met la première lettre en majuscule

  for ($m = '1'; $m <= '12'; $m++) {
    $monthlist = $formatter->format(mktime(0, 0, 0, $m, 1, date('Y')));
    if ($m == $month) {
      echo '<option selected value=' . $m . '>' . ucfirst($monthlist) . '</option>';
    } else {
      echo '<option value=' . $m . '>' . ucfirst($monthlist) . '</option>';
    }
  }
  echo '  </select><a class="" href="?month=' . (($month == 12) ? '1' : $month + '1') . '&year=' . (($month == '12') ? $year + 1 : $year) . '"><img class="arrow" src="../assets/img/right.png" alt="droite"></a>';
  echo '<label for="year" class="me-2"></label>';
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
function createModal($month, $i, $year, $holidays)
{ ?>

  <!-- Modal -->
  <div class="modal fade " id="modal-<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $i . '/' . $month . '/' . $year ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= $holidays[date('d-M-Y', mktime(00, 00, 00, $month, $i, $year))] ?? ' ' ?>
        </div>
        <div class="modal-footer">
          <!-- <?php if ($i < 10) {
                  $i = '0' . $i;
                };
                if ($month < 10) {
                  $month = '0' . $month;
                } ?> -->
          <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-warning fw-bold "><a class="text-black" href="../views/add-event.php?<?= 'date=' . $year . '-' . $month . '-' . $i ?>">Ajouter un évènement</a> </button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


<?php
/*****************************fonction pour la modal anniversaire*********************************************** */

function createModalBirthday($month, $i, $year)
{
  /* on instancie la class child et on utilise la methode displayChild pour recuperer le prenom de l'enfant */
  $child = new Child;
  $prénom = $child->displayChild();

  $date = (date('d-M-Y', mktime(00, 00, 00, $month, $i, $year)));
?>


  <!-- Modal -->
  <div class="modal fade" id="modal-<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $i . '/' . $month . '/' . $year ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php foreach ($prénom as $value) {
            if (date('d-M-' . $year, strtotime($value['birthdate'])) == $date) { ?>
              <p><?= 'Anniversaire de ' . '<span class=fw-bold>' . $value['child_firstname'] ?></span></p>
          <?php }
          } ?>
        </div>
        <div class="modal-footer">
          <?php if ($i < 10) {
            $i = '0' . $i;
          };
          if ($month < 10) {
            $month = '0' . $month;
          } ?>
          <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-warning fw-bold "><a class="text-black" href="../views/add-event.php?<?= 'date=' . $year . '-' . $month . '-' . $i ?>">Ajouter un évènement</a> </button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php

/* fonction create modal event */
function createModalEvent($month, $i, $year)
{


  $event = new Event;
  $events = $event->showEventByDate($year . '-' . $month . '-' . $i);

?>


  <!-- Modal -->
  <div class="modal fade " id="modal-<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $i . '/' . $month . '/' . $year ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php foreach ($events as $value) { ?>
            <div>
              <p class="fw-bold"><?= $value['child_firstname'] ?></p>
              <p><?= $value['event_name'] ?></p>
              <p><?= $value['event_hour'] ?></p>
              <p><?= $value['event_motif'] ?></p>
              <hr>
            </div>

          <?php } ?>
        </div>
        <div class="modal-footer">
          <?php if ($i < 10) {
            $i = '0' . $i;
          };
          if ($month < 10) {
            $month = '0' . $month;
          } ?>
          <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-warning fw-bold "><a class="text-black" href="../views/add-event.php?<?= 'date=' . $year . '-' . $month . '-' . $i ?>">Ajouter un évènement</a> </button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>