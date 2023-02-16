<?php

    $errors = [];
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST['lastname'])) {
            if (empty($_POST['lastname'])) {
                $errors['lastname'] = 'champ obligatoire';
            }
            else if(!preg_match('/^[a-zA-ZÀ-ÿ-]+$/', $_POST['lastname'])) {
                $errors['lastname'] = 'Veuillez respecter le format';
            }
        }
        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['password'])) {
                $errors['password'] = '8 caractères minimum';
            }
        }
    
    
    
        if (isset($_POST['confirmPass'])) {
            if ($_POST['password'] != $_POST['confirmPass']){
                $errors['error'] = 'les mots de passe ne sont pas identique';
            }
            if (empty($_POST['confirmPass'])) {
                $errors['confirmPass'] = 'champ obligatoire';
            }
            else if (!preg_match('/^.{8,}$/', $_POST['confirmPass'])) {
                $errors['password'] = 'Veuillez respecter le format';
            }
        }

        if(empty($errors)){

            include('../helpers/connexionBDD.php');

            $connexion = connect_bd();
            $sql = "INSERT INTO parent (parent2_nickname, parent2_pass) VALUES (:pseudo, :password)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindValue(':pseudo', $_POST['pseudoParent2']);
            $stmt->bindValue(':password', password_hash($_POST['passwordParent2'], PASSWORD_DEFAULT),PDO::PARAM_STR);
            $stmt->execute();
            header('Location: controller-accueil.php');
            exit();
        }
    }