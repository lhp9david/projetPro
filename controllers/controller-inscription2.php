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
            // else if (!preg_match('/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/', $_POST['birthdate'])) {
            //     $errors['birthdate'] = 'Veuillez respecter le format jj-mm-aaaa';
            // }
        }

        if(empty($errors)){
            include('../helpers/connexionBDD.php');

            $connexion = connect_bd();
            $sql = 'INSERT INTO child (child_lastname, child_firstname, birthdate,parent_id) VALUES (:lastname, :firstname, :birthdate)';
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':lastname', $_POST['childLastname']);
            $stmt->bindParam(':firstname', $_POST['childFirstname']);
            $stmt->bindParam(':birthdate', $_POST['birthdate']);
            $stmt->execute();
            header('Location: controller-inscription3.php');
            exit();
        }
    }

        ?>



<?php
include('../views/view-inscription2.php');
    ?>