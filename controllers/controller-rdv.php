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

    if(!empty($_POST['motifEvent']) && !empty($_POST['dateEvent']) && !empty($_POST['hourEvent'])  && !empty($_POST['childname'])){
        $event = new Event();
        $event->createEvent();
    }
    else{
        
        header('Location: ../views/add-event.php?error');
          
    }
    
}

$name = new Child();
$nameList = $name-> displayChild();

$event = new Event();
$eventList = $event-> showAllEvent();


if(isset($_GET['id'])){
  $id = $_GET['id'];
    $event = new Event();
    $event->deleteEvent($id);
    header('Location: controller-rdv.php');
    exit();
}

include('../views/view-rdv.php');

?>