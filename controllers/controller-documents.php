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
$files = new Files();
$fileList = $files->getFiles();





include('../views/view-documents.php')

?>