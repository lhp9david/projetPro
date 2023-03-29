<?php
session_start();

require '../config/env.php';
require '../helpers/database.php';
require '../models/Parent.php';





if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];

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
                $errorsArray['captcha'] = 'vous êtes un robot';
            }
        }
        if (!$captcha) {
            $errorsArray['captcha'] = 'veuillez cocher la case';
        } else {
                    // utlisation de la fonction login de la classe parent

        $parent = new Paarent();
        $parent->login($mail, $password);
                if ($parent->_success == false) {
                         $errors['error'] = 'Identifiant ou mot de passe incorrect';
                             } else {
                $errors['error'] = 'Veuillez remplir tous les champs';
            }
                
        }}

}

/* si l'utilisateur clic sur le bouton se déconnecter, on détruit la session et on le redirige vers la page de connexion */
if (isset($_GET['logout'])) {

    $disconnected = true;
    session_destroy();
}
/* si l'inscription s'est bien déroulée, on affiche un message de confirmation */
if (isset($_GET['subscribed'])) {
    $subscribed = true;
}

/* si la suppression s'est bien déroulée, on affiche un message de confirmation */
if (isset($_GET['deleted'])) {
    $deleted = true;
}


?>



<?php
include('../views/view-login.php');
?>