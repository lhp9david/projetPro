<?php 
require '../config/env.php';
require '../models/Child.php';
require '../helpers/database.php';

session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
}


$child = new Child();
$childList = $child->displayChild();


include('../views/view-add-child.php')
?>