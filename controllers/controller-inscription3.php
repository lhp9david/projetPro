<?php

require '../config/env.php';
require '../models/Parent.php';
require '../helpers/database.php';
session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
    $errors = [];
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST['pseudoParent2'])) {
            if (empty($_POST['pseudoParent2'])) {
                $errors['pseudoParent2'] = 'Champ obligatoire';
            }
            else if(!filter_var(($_POST['pseudoParent2']), FILTER_VALIDATE_EMAIL)) {
                $errors['pseudoParent2'] = 'Veuillez respecter le format';
            }
        }
        if (isset($_POST['passwordParent2'])) {
            if (empty($_POST['passwordParent2'])) {
                $errors['passwordParent2'] = 'Champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['passwordParent2'])) {
                $errors['passwordParent2'] = '8 caractères minimum';
            }
        }
    
    
    
        if (isset($_POST['confirmPassParent2'])) {
            if ($_POST['passwordParent2'] != $_POST['confirmPassParent2']){
                $errors['confirmPassParent2'] = 'les mots de passe ne sont pas identique';
            }
            if (empty($_POST['confirmPassParent2'])) {
                $errors['confirmPassParent2'] = 'Champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['confirmPassParent2'])) {
                $errors['confirmPassPArent2'] = 'Veuillez respecter le format';
            }
        }
     /*  si tous les champs sont remplis et que les mots de passe sont identiques, on crée le parent 2 */
        if(empty($errors)){

          $obj_parent = new Paarent();
          $obj_parent->createParent2();
        }

    }


    include('../views/view-inscription3.php');
    ?>