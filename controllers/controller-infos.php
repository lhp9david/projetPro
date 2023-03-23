<?php

/* appelle des fichier de config et de model */
require '../config/env.php';
require '../helpers/database.php';
require '../models/Parent.php';
require '../models/Child.php';

/* demarrage de la session */
session_start();

/* si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion */
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
/* sinon on recupere les informations de l'utilisateur connecté */
} else {
    $user = $_SESSION['user'];
}

/* on recupere les informations de l'utilisateur connecté */
$infos = new Paarent();
$infoList = $infos->getAllParent($user['parent_id']);

/* on recupere la liste des enfants de l'utilisateur connecté */
$child = new Child();
$childList = $child->displayChild();


/* si l'utilisateur clic sur le bouton supprimer son compte, on supprime l'utilisateur et on le redirige vers la page de connexion avec un message de confirmation */
if (isset($_GET['delete'])) {
    
    $delete = new Paarent();
    $delete->deleteParent($user['parent_id']);
    header('Location: controller-login.php?deleted');
    exit();
  
}





/* on appelle la vue */

include('../views/view-infos.php');
?>