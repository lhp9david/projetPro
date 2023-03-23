<?php
/* on demarre la session */
session_start();

/* si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion */
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();

/* sinon on recupere les informations de l'utilisateur connecté */
} else {
    $user = $_SESSION['user'];
}

/* on appelle les fichiers de config et de model */
include('../helpers/helpers.php');
include('../models/Files.php');
include('../config/env.php');
include('../helpers/database.php');
include('../models/Child.php');


/* si la métode POST est utilisé */
if($_SERVER['REQUEST_METHOD'] === 'POST'){


/*On vérifie que le fichier a bien été envoyé et qu'il n'y a pas d'erreur */

        if($_FILES['userFile']['error'] === 0){

        /* on instancie la classe Files et on appelle les fonctions checkFileSize() et checkFileType() pour vérifier la taille et le type du fichier */
            $folder = new Files();

            if(!$folder->checkFileSize()) {
            $error = 'Veuillez choisir un fichier de moins de 5mo';
            } else if (!$folder->checkFileType()) {
            $error = 'Veuillez choisir un fichier de type pdf, png, jpg, jpeg';

        /* si le fichier est valide, on appelle la fonction saveFile() pour enregistrer le fichier dans le dossier uploads et on redirige vers la page documents */
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


/* recuperer l'ID de l'enfant au clic du bouton et afficher les fichiers de l'enfant  */
if(isset($_GET['idChild'])){
    $id = $_GET['idChild'];

    /*methode pour afficher les fichiers d'un enfant specifique */
    $files = new Files();
    $fileList = $files->getFilesByChildId($id);

    /* si aucun fichier n'est trouvé, afficher un message */
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



/* on appelle la vue */
include('../views/view-documents.php')
?>