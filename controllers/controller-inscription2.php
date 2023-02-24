<?php
require '../config/env.php';
require '../models/Child.php';
require '../helpers/database.php';

session_start();
if(!isset($_SESSION['user'])){
    header('Location: controller-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
$errors = [];
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST['childName'])) {
            if (empty($_POST['childName'])) {
                $errors['childName'] = 'champ obligatoire';
            }
            else if(!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['childName'])) {
                $errors['childName'] = 'Veuillez respecter le format';
            }
        }
    
        if (isset($_POST['childFirstname'])) {
            if (empty($_POST['childFirstname'])) {
                $errors['childFirstname'] = 'champ obligatoire';
            }
            else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['childFirstname'])) {
                $errors['childFirstname'] = 'Veuillez respecter le format';
            }
        }

        if (isset($_POST['birthdate'])) {
            if (empty($_POST['birthdate'])) {
                $errors['birthdate'] = 'champ obligatoire';
            }
            // else if (!preg_match('/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/', $_POST['birthdate'])) {
            //     $errors['birthdate'] = 'Veuillez respecter le format jj-mm-aaaa';
            // }
        }

        

        if(empty($errors)){
            

            $child = new Child();
            $check = $child->checkChild();
            if($check){
                $errors['error'] = 'Ce nom est déjà utilisé';
            } else {
                $child->createChild();
                header('Location: controller-inscription3.php');
                exit();
            }
           
        }
    }

        ?>



<?php
include('../views/view-inscription2.php');
    ?>