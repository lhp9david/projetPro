<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['mail'])) {

        $mail = $_POST['mail'];

        if (empty($mail)) {
            $errors['mail'] = 'Veuillez entrer votre adresse mail';
        }
    }

    if (isset($_POST['password'])) {

        $password = $_POST['password'];

        if (empty($password)) {
            $errors['password'] = 'Veuillez entrer votre mot passe';
        }
    }

    if (empty($errors)) {

                    header('Location: controller-accueil.php');
                }
            } 
        
    


if(isset($_GET['logout'])) {
   
    $disconnected = true;
}
?>













<?php
include('../views/view-login.php');
?>