<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
}

include('../helpers/database.php');
include('../config/env.php');
include('../models/Child.php');
include('../models/Event.php');


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $event = new Event();
    $event->createEvent();

    
}

$name = new Child();
$nameList = $name-> displayChild();


$event = new Event();
$eventList = $event-> showEvent();



include('../views/view-rdv.php')
?>