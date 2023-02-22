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
<?php foreach($nameList as $name) {?>
    <h2 class="my-3"><?= $name['child_firstname'] ?? ''?></h2>
<?php } ?>

    <?php foreach($eventList as $event) { ?>
        <div class="event-container1 my-3 row event">
            <p class="col-lg-3"><?=$event['event_date'] ?? '' ?></p>
            <p class="col-lg-3"><?=$event['event_name'] ?? ''?></p>
            <p class="col-lg-4"><?=$event['event_motif']?></p>
            <p class="col-lg-2"><?=$event['event_hour'] ?? ''?><a href="../controllers/controller-rdv.php?id=<?=$event['event_id']?>"><img class="trash" src="../assets/img/delete.png" alt=""></a></p>
        </div>
      
  <?php  } ?>

</div>

<?php include('../views/include/footer.php') ?>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>