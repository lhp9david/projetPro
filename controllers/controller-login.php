<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['mail'])) {

        $mail = $_POST['mail'];

        if (empty($mail)) {
            $errors['mail'] = 'Veuillez entrer votre adresse mail';
        }
    }

    if (isset($_POST['password'])) {

        $password = $_POST['password'];

        if (empty($password)) {
            $errors['password'] = 'Veuillez entrer votre mot passe';
        }
    }

    if (empty($errors)) {

        foreach ($users as $key => $value) {
            $userMail =  $value['mail'];
            $userPassword = $value['password'];
            $userPseudo = $value['pseudo'];
            $userQuota = $value['quota'];

            if ($userMail === $mail) {

                if (password_verify($password, $userPassword)) {

                    $_SESSION['user'] = [
                        'quota' => $userQuota,
                        'mail' => $userMail,
                        'pseudo' => $userPseudo
                    ];
                 

                    header('Location: controller-gallery.php');
                }
            } else if ($userMail != $mail || $password = !$userPassword) {
                $errors['erreur'] = 'Erreur mail ou mot de passe';
            }
        }
    }
}

if(isset($_GET['logout'])) {
    session_destroy();
    $disconnected = true;
}
?>













<?php
include('../views/view-login.php');
?>