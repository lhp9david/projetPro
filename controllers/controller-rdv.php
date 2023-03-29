<?php
/* on demarre la session */
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
} else {
    $user = $_SESSION['user'];
}

/* on appelle les fichiers de config et de model */
include('../helpers/database.php');
include('../config/env.php');
include('../models/Child.php');
include('../models/Event.php');


/* si la métode POST est utilisé et que le bouton modifier est cliqué */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changeEvent'])) {
   if(!empty($_POST['motifEvent']) && !empty($_POST['dateEvent']) && !empty($_POST['hourEvent']) && !empty($_POST['noteEvenement']) && !empty($_POST['idEvent'])) {
        $motifEvent = htmlspecialchars($_POST['motifEvent']);
        $dateEvent = htmlspecialchars($_POST['dateEvent']);
        $hourEvent = htmlspecialchars($_POST['hourEvent']);
        $noteEvenement = htmlspecialchars($_POST['noteEvenement']);
        $id = htmlspecialchars(trim($_POST['idEvent']));

            /* on instancie la classe Event et on appelle la fonction updateEvent() pour modifier l'event en base de donnée */
            $event = new Event();
            $event->updateEvent($motifEvent, $dateEvent, $hourEvent, $noteEvenement, $id);
            /* on redirige vers la page rdv */
            header('Location: ../evenements.php');
    } else {
        $errors = 'Veuillez remplir tous les champs';
    }
    
}

/* si la métode POST est utilisé  */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createEvent'])) {

    /*** si les champs existe et qu'ils ne sont pas vide alors on crée un nouvel event en base de donnée  */
    if (!empty($_POST['motifEvent']) && !empty($_POST['dateEvent']) && !empty($_POST['hourEvent'])  && !empty($_POST['childname'])) {

        if ($user['parent2']) {
            $mail = $user['parent2_nickname'];
               /* on instancie la classe Event et on appelle la fonction createEvent() pour créer un nouvel event en base de donnée */
            $event = new Event();
            $event->createEvent($mail);
        } else {
            $mail = $user['mail'];
            /* on instancie la classe Event et on appelle la fonction createEvent() pour créer un nouvel event en base de donnée */
            $event = new Event();
            $event->createEvent($mail);
        }
     
    } else {

        header('Location: ../evenements.php?error');
    }
}

/***recupere la liste des noms des enfants pour l'affichage des boutons de trie  */
$name = new Child();
$nameList = $name->displayChild();


/*** si un bouton prénom de l'enfant est cliqué on recupere l'id avec un GET pour afficher uniquement ses rdv  */

if (isset($_GET['idChild'])) {
    $id = $_GET['idChild'];

    /*** on instancie la classe Event et on appelle la fonction showEvent() pour afficher les rdv de l'enfant  */
    $event = new Event();
    $eventList = $event->showEvent($id);

    /*** si la liste est vide on affiche un message  */
    if (!$eventList) {
        $message = "Aucun événement à venir";
    }
} else {

    /*** sinon on affiche tous les rdv  */
    $event = new Event();
    $eventList = $event->showAllEvent();

    /*** si la liste est vide on affiche un message  */
    if (!$eventList) {
        $message = "Aucun événement à venir";
    }
}


/** un get avec l'ID de l'enfant sur la corbeille permet d'effacer l'event  */
if (isset($_GET['idEvent'])) {
    $id = $_GET['idEvent'];
    $event = new Event();
    $event->deleteEvent($id);
    header('Location: evenements.php');
    exit();
}




/*on appelle la vue */
include('../views/view-rdv.php');
