<?php
session_start();

require '../config/env.php';
require '../helpers/database.php';
require '../models/Parent.php';





if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        // utlisation de la fonction login de la classe parent

        $parent = new Paarent();
        $parent->login($mail, $password);
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