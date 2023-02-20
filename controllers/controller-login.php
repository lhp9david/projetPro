<?php
session_start();

require '../config/env.php';
require '../helpers/database.php';
require '../models/Parent.php';

$errors = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];
       
        
// utlisation de la fonction login de la classe parent


$parent = new Paarent();

if (isset($_POST['login'])) {
    $parent->loogin($_POST['mail'], $_POST['password']);
}


    
        if ($user) {
            if (password_verify($password, $user['parent_password'])) {
                $_SESSION['user'] = $user;


                if (!$result) {
                    header('Location: controller-inscription2.php');
                    exit();
                } else {
                    header('Location: controller-accueil.php');
                }
                exit();
            } else {
                $errors['error'] = 'Mauvais identifiant ou mot de passe';
            }
        } else {
            $errors['error'] = 'Mauvais identifiant ou mot de passe';
        }
    } else {
        $errors['error'] = 'Veuillez remplir tous les champs';
    }
}


if (isset($_GET['logout'])) {

    $disconnected = true;
    session_destroy();
}

if (isset($_GET['subscribed'])) {
    $subscribed = true;
}


?>



<?php
include('../views/view-login.php');
?>