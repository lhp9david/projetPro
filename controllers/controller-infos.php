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







include('../views/view-infos.php');
?>