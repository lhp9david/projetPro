<?php
require '../config/env.php';
require '../models/Child.php';
require '../helpers/database.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*verifie que les champs sont bien remplis et qu'ils respectent le format */

    if (isset($_POST['childName'])) {
        if (empty($_POST['childName'])) {
            $errors['childName'] = 'Champ obligatoire';
        } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['childName'])) {
            $errors['childName'] = 'Veuillez respecter le format';
        } else {
            $childName = ($_POST['childName']);
        }
    }

    if (isset($_POST['childFirstname'])) {
        if (empty($_POST['childFirstname'])) {
            $errors['childFirstname'] = 'Champ obligatoire';
        } else if (!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['childFirstname'])) {
            $errors['childFirstname'] = 'Veuillez respecter le format';
        } else {
            $childFirstname = $_POST['childFirstname'];
        }
    }

    if (isset($_POST['birthdate'])) {
        if (empty($_POST['birthdate'])) {
            $errors['birthdate'] = 'Champ obligatoire';
        } else {
            $birthdate = $_POST['birthdate'];
        }
    }

if (empty($errors)) {


        /* si tous les champs sont remplis, on vérifie si le prénom de l'enfant existe déjà dans la base de données */
        $child = new Child();
        $check = $child->displayChild();


        /* si le prénom n'existe pas, on crée l'enfant */
        if (empty($check)) {

            $child->createChild($childName, $childFirstname, $birthdate);
            header('Location: controller-add-child.php');
        } else {
            foreach ($check as $value) {
                if ($childFirstname == $value['child_firstname']) {
                    $errors['error'] = 'Ce prénom est déjà utilisé';
                } else {
                    $child->createChild($childName, $childFirstname, $birthdate);
                    header('Location: controller-add-child.php');
                }
            }
        }
    }
}

?>



<?php
include('../views/view-inscription2.php');
?>