<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}

include('../helpers/database.php');
include('../config/env.php');
include('../models/Child.php');
include('../models/Event.php');


if(isset($_GET['change'])){
    $id = $_GET['change'];
    $event = new Event();
    $event->updateEvent($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    /*** si les champs existe et qu'ils ne sont pas vide alors on crée un nouvel event en base de donnée  */

    if (!empty($_POST['motifEvent']) && !empty($_POST['dateEvent']) && !empty($_POST['hourEvent'])  && !empty($_POST['childname'])) {
        $event = new Event();
        $event->createEvent();
    } else {

        header('Location: ../views/add-event.php?error');
    }
}

/***recupere la liste des noms des enfants pour l'affichage des boutons de trie  */
$name = new Child();
$nameList = $name->displayChild();


/*** si un bouton prénom de l'enfant est cliqué on recupere l'id avec un GET pour afficher uniquement ses rdv  */

if (isset($_GET['idChild'])) {
    $id = $_GET['idChild'];

    /*** verifie si il y a des rdv avec cet ID  */
    $check = new Event();
    $checkList = $check->checkChildID($id);

    /*** si il n'y a pas de rdv avec cet ID on affiche tous les rdv  */
    if($checkList == false){
        header('Location: ../controllers/controller-rdv.php');

        /*** sinon on affiche les rdv de l'enfant  */
    } else {
        $event = new Event();
        $eventList = $event->showEvent($id);
    }

   
} else {
    $event = new Event();
    $eventList = $event->showAllEvent();
}


/** un get avec l'ID de l'enfant sur la corbeille permet d'effacer l'event  */

if (isset($_GET['idEvent'])) {
    $id = $_GET['idEvent'];
    $event = new Event();
    $event->deleteEvent($id);
    header('Location: controller-rdv.php');
    exit();
}





include('../views/view-rdv.php');
?>