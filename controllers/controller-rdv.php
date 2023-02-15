<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
}

include('../helpers/helpers.php');



include('../views/view-rdv.php')
?>