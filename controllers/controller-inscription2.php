<?php

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
            else if (!preg_match('/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/', $_POST['birthdate'])) {
                $errors['birthdate'] = 'Veuillez respecter le format jj-mm-aaaa';
            }
        }

        if(empty($errors)){
            $connexion = connect_bd();
            $query = $connexion->prepare('INSERT INTO child (parent_lastname, parent_firstname, parent_birthdate) VALUES (:lastname, :firstname, :birthdate)');
            $query->execute([
                'lastname' => $_POST['lastname'],
                'firstname' => $_POST['firstname'],
                'birthdate' => $_POST['birthdate']
            ]);
            header('Location: controller-accueil.php');
            exit();
        }
    }

        ?>



<?php
include('../views/view-inscription2.php');
    ?>