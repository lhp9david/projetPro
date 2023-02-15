<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/calendar.png">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Evenements</title>
</head>

<body>

<?php include('../views/include/navbar.php');
  

    
?>


<div class="container event-container">
    <h2 class="my-3">Mattéo</h2>
        <div class=" my-3 row event">
            <p class="col-lg-3">10/04/2023 </p>
            <p class="col-lg-3">rendez vous medecin</p>
            <p class="col-lg-4">non renseigné</p>
            <p class="col-lg-2">14h</p>
        </div>
        <div class=" my-3 row event">
            <p class="col-lg-3">11/07/2023</p>
            <p class="col-lg-3">Anniversaire</p>
            <p class="col-lg-4">Sa cousine</p>
            <p class="col-lg-2">15h</p>
        </div>
        <div class=" my-3 row event">
            <p class="col-lg-3">19/09/2023 </p>
            <p class="col-lg-3">Match de foot</p>
            <p class="col-lg-4">contre harfleur</p>
            <p class="col-lg-2">14h</p>
        </div>
        <div class=" my-3 row event">
            <p class="col-lg-3">12/11/2023 </p>
            <p class="col-lg-3">rendez vous medecin</p>
            <p class="col-lg-4">suivi orl</p>
            <p class="col-lg-2">14h</p>
        </div>
        <?php   
       
          echo  addEvent($_POST['dateEvenement'],$_POST['typeEvenement'],$_POST['heureEvenement'],$_POST['noteEvenement']);
          
        
    ?>
</div>

<?php include('../views/include/footer.php') ?>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>