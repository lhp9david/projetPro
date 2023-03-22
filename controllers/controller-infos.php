<?php
require '../config/env.php';
require '../helpers/database.php';
require '../models/Parent.php';
require '../models/Child.php';

session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}


$infos = new Paarent();
$infoList = $infos->getAllParent($user['parent_id']);
$child = new Child();
$childList = $child->displayChild();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = new Paarent();
    $delete->deleteParent($id);
  
}







include('../views/view-infos.php');
?>