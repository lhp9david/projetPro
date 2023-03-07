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
    
        if (isset($_POST['lastname'])) {
            if (empty($_POST['lastname'])) {
                $errors['lastname'] = 'champ obligatoire';
            }
            else if(!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['lastname'])) {
                $errors['lastname'] = 'Veuillez respecter le format';
            }
        }
        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['password'])) {
                $errors['password'] = '8 caractères minimum';
            }
        }
    
    
    
        if (isset($_POST['confirmPass'])) {
            if ($_POST['password'] != $_POST['confirmPass']){
                $errors['error'] = 'les mots de passe ne sont pas identique';
            }
            if (empty($_POST['confirmPass'])) {
                $errors['confirmPass'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['confirmPass'])) {
                $errors['password'] = 'Veuillez respecter le format';
            }
        }
     /*  si tous les champs sont remplis et que les mots de passe sont identiques, on crée le paren 2 */
        if(empty($errors)){

          $obj_parent = new Paarent();
          $obj_parent->createParent2();
        }

    }


    include('../views/view-inscription3.php');
    ?>