<?php
require '../config/env.php';
require '../models/Parent.php';
require '../helpers/database.php';

    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST['lastname'])) {
            if (empty($_POST['lastname'])) {
                $errors['lastname'] = 'Champ obligatoire';
            }
            else if(!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['lastname'])) {
                $errors['lastname'] = 'Veuillez respecter le format';
            } else {{
                $lastname = ($_POST['lastname']);
            }}
        }
    
        if (isset($_POST['firstname'])) {
            if (empty($_POST['firstname'])) {
                $errors['firstname'] = 'Champ obligatoire';
            }
            else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['firstname'])) {
                $errors['firstname'] = 'Veuillez respecter le format';
            } else {
               $firstname = $_POST['firstname'];
            }
        }
    
        if (isset($_POST['mail'])) {
    
            if (empty($_POST['mail'])) {
                $errors['mail'] = 'Champ obligatoire';
            }
            else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $errors['mail'] = 'Veuillez respecter le format';
            } else {
                $mail = $_POST['mail'];
                $obj_parent = new Paarent();
                $obj_parent->checkParent($mail);
                if($obj_parent->checkParent($mail) == true){
                    $errors['mail'] = 'Cet email est déjà utilisé';
                }
            }
        }
    
        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = 'Champ obligatoire';
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
                $errors['confirmPass'] = 'Champ obligatoire';
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

        
    // Vérifier si le captcha est vide
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];

        // verifier la key 
        $secretKey = "6LcaqjslAAAAAPIBLyJnvdDh7NE3uLNDClb6u1He";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        // should return JSON with success as true
        if (!$responseKeys["success"]) {
            $errors['captcha'] = 'Vous êtes un robot';
        }
    }
    if (!$captcha) {
        $errors['captcha'] = 'Veuillez cocher la case';
    }

        if(empty($errors)){
/** si tous les champs sont remplis on crée le parent */
            $obj_user = new Paarent();
            $obj_user->createParent($lastname, $firstname, $mail, $password);


            }

          
        }
    

    include('../views/view-inscription.php');
?>