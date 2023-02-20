<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
require_once('../helpers/helpers.php');

?>





<?php
include('../views/view-accueil.php');
?>