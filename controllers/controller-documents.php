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
include('../models/Child.php');




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
            $id = $_POST['child'];
            $folder->saveFile($id);
            header('Location: controller-documents.php');
            }
    
        } else {
            $error = 'Veuillez choisir un fichier';
        }
}

/* appelle  la fonction displayChild() pour afficher la liste des enfants sur les boutons  */
$name = new Child();
$nameList = $name->displayChild();

/* recuperer le chemin du fichier  */
$path = new Files();
$folderPath = $path->getFilePath();

/* recuperer l'ID de l'enfant au clic du bouton et afficher les fichiers de l'enfant  */

if(isset($_GET['idChild'])){
    $id = $_GET['idChild'];
    $files = new Files();
    $folderPath = $files->getFolderPath($id);
    $fileList = $files->getFilesByChildId($id);
    $names = new Child();
    $firstname = $names->displayChildInfo($id);
    if(!$fileList){
      $message = "Aucun document à afficher";
    }
  

    
    /*sinon afficher tous les fichiers  */
  } else {

    $files = new Files();
    $fileList = $files->getFiles();
    if(!$fileList){
      $message = "Aucun document à afficher"; 
    }
 
  }




/* supprimer  un fichier au clic de la corbeille en recuperant l' ID */

if(isset($_GET['id'])){
    $id = $_GET['id'];
      $file = new Files();
      $file->deleteFile($id);
  
      header('Location: controller-documents.php');
      exit();
  }




include('../views/view-documents.php')

?>