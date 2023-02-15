<?php
session_start();
include('../helpers/connexionBDD.php');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $connexion = connect_bd();
        $query = $connexion->prepare('SELECT * FROM parent WHERE mail = :mail');
        $query->execute(['mail' => $mail]);
        $user = $query->fetch();
        if ($user) {
            if (password_verify($password, $user['parent_password'])) {
                $_SESSION['user'] = $user;
                header('Location: controller-inscription2.php');
                exit();
            } else {
                $errors['error'] = 'Mauvais identifiant ou mot de passe';
            }
        }
    }
        
}


if(isset($_GET['logout'])) {
   
    $disconnected = true;
    session_destroy();
}
?>













<?php
include('../views/view-login.php');
?>