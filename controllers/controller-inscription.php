<?php
require '../config/env.php';
require '../models/Parent.php';
require '../helpers/database.php';

    $errors = [];
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST['lastname'])) {
            if (empty($_POST['lastname'])) {
                $errors['lastname'] = 'champ obligatoire';
            }
            else if(!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['lastname'])) {
                $errors['lastname'] = 'Veuillez respecter le format';
            } else {{
                $lastname = ($_POST['lastname']);
            }}
        }
    
    
    
        if (isset($_POST['firstname'])) {
            if (empty($_POST['firstname'])) {
                $errors['firstname'] = 'champ obligatoire';
            }
            else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['firstname'])) {
                $errors['firstname'] = 'Veuillez respecter le format';
            } else {
               $firstname = $_POST['firstname'];
            }
        }
    
    
        if (isset($_POST['mail'])) {
    
            if (empty($_POST['mail'])) {
                $errors['mail'] = 'champ obligatoire';
            }
            else if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $errors['mail'] = 'Veuillez respecter le format';
            } else {
                $mail = $_POST['mail'];
            }
        }
    
        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['password'])) {
                $errors['password'] = '8 caractères minimum';
            } else {
               $password = $_POST['password'];
            }
        }
    
    
    
        if (isset($_POST['confirmPass'])) {
            if (isset($password) ){
                if($password != $_POST['confirmPass']){
                $errors['error'] = 'les mots de passe ne sont pas identique';
            }
        }
            if (empty($_POST['confirmPass'])) {
                $errors['confirmPass'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['confirmPass'])) {
                $errors['password'] = 'Veuillez respecter le format';
            }
        }
    
        
        if (!isset($_POST['CGU'])) {
            if (empty($_POST['CGU'])) {
                $errors['CGU'] = 'Veuillez accepter les CGU';
            }
        }

        if(empty($errors)){
/** si tous les champs sont remplis on crée le parent */
            $obj_user = new Paarent();
            $obj_user->createParent($lastname, $firstname, $mail, $password);


            }

          
        }
    

    include('../views/view-inscription.php');
?>