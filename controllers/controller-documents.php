<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}

require_once('../helpers/helpers.php');

$arrayExt = ['jpg', 'jpeg', 'png', 'pdf'];

if(isset($_POST['submit'])){

    $file = $_FILES['userFile'];
    $size = $file['size'];


    checkImage($file,$size,$arrayExt);
}









include('../views/view-documents.php')


?>