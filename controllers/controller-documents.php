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



        $folder = new Files();

        if(!$folder->checkFileSize()) {
            $error = 'Veuillez choisir un fichier de moins de 5mo';
        } else if (!$folder->checkFileType()) {
            $error = 'Veuillez choisir un fichier de type pdf, png, jpg, jpeg';
        } else {
            $folder->createFolder();
            $folder->uploadFile();
            $folder->saveFile();
        }
    
}

$files = new Files();
$fileList = $files->getFiles();






include('../views/view-documents.php')


?>