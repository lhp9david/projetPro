<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}

include('../helpers/helpers.php');
include('../models/Files.php');
include('../config/env.php');
include('../helpers/database.php');





if($_SERVER['REQUEST_METHOD'] === 'POST'){


/*
verifier la variable $_FILE['name']['error']*/

        if($_FILES['userFile']['error'] === 0){

        
            $folder = new Files();

            if(!$folder->checkFileSize()) {
            $error = 'Veuillez choisir un fichier de moins de 5mo';
            } else if (!$folder->checkFileType()) {
            $error = 'Veuillez choisir un fichier de type pdf, png, jpg, jpeg';
            } else {
            $error = 'Votre fichier a bien été téléchargé';
            $folder->saveFile();
            header('Location: controller-documents.php');
            }
    
        } else {
            $error = 'Veuillez choisir un fichier';
        }
}

$path = new Files();
$folderPath = $path->getFilePath();

if(isset($_GET['date'])){
    $date = $_GET['date'];
    $files = new Files();
    $fileList= $files->getFilesByDate($date);
    
  } else {

    $files = new Files();
    $fileList = $files->getFiles();
  }




if(isset($_GET['id'])){
    $id = $_GET['id'];
      $file = new Files();
      $file->deleteFile($id);
      header('Location: controller-documents.php');
      exit();
  }




include('../views/view-documents.php')

?>