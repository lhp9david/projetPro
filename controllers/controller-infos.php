<?php

/* appelle des fichier de config et de model */
require '../config/env.php';
require '../helpers/database.php';
require '../models/Parent.php';
require '../models/Child.php';

/* demarrage de la session */
session_start();

/* si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion */
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
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

/* modification du mot de passe */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pass'])) {

    if (isset($_POST['oldPass'])) {
        if (empty($_POST['oldPass'])) {
            $errors['oldPass'] = 'Champ obligatoire';
        } else if (!preg_match('/^.{8,}$/', $_POST['oldPass'])) {
            $errors['oldPass'] = 'Votre mot de passe fait 8 caractères minimum';
        } else {
            $oldPass = $_POST['oldPass'];
        }
    }

    if (isset($_POST['newPass'])) {
        if (empty($_POST['newPass'])) {
            $errors['newPass'] = 'Champ obligatoire';
        } else if (!preg_match('/^.{8,}$/', $_POST['newPass'])) {
            $errors['newPass'] = 'Votre nouveau mot de passe doit faire 8 caractères minimum';
        } else {
            $newPass = $_POST['newPass'];
        }
    }



    if (isset($_POST['confirmNewPass'])) {
        if (isset($newPass)) {
            if ($newPass != $_POST['confirmNewPass']) {
                $errors['error'] = 'les mots de passe ne sont pas identique';
            }
        }
            if (empty($_POST['confirmNewPass'])) {
                $errors['confirmNewPass'] = 'Champ obligatoire';
            } else if (!preg_match('/^.{8,}$/', $_POST['confirmNewPass'])) {
                $errors['confirmNewpass'] = 'Veuillez respecter le format';
            }
    }

    if (empty($errors) && !isset($user['parent2'])) {
        $pass = new Paarent();
        $pass->updatePassword($user['parent_id'], $oldPass, $newPass);
        header('Location: infos.php?pass');
        exit();

    } else if (empty($errors) && isset($user['parent2'])) {
        $pass = new Paarent();
        $pass->updatePassword2($user['parent_id'], $oldPass, $newPass);
        header('Location: infos.php?pass');
        exit();

    }
}






/* on appelle la vue */

include('../views/view-infos.php');
