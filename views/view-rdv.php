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
    <?php include('../views/include/navbar.php'); ?>
    <div class="ms-5 mt-2">

    <a class="text-black text-decoration-none" href="../controllers/controller-rdv.php"><button class="btn btn-warning fw-bold">Voir tous</button></a>
        <?php foreach ($nameList as $name) { ?>
            <a class="text-black text-decoration-none" href="../controllers/controller-rdv.php?idChild=<?= $name['child_id'] ?>"><button class="btn btn-warning fw-bold"><?= $name['child_firstname'] ?? '' ?></button></a>
        <?php } ?>
    </div>




    <div class="container event-container">
        <?php foreach ($eventList as $event) { ?>
            <h3 class="text-end"><?=$event['child_firstname'] ?? ''?></h3>
            <div class="event-container1 my-3 row event">
                <p class="col-lg-3"><?= date('d-m-Y', strtotime($event['event_date'])) ?? ''; ?></p>
                <p class="col-lg-3"><?= $event['event_name'] ?? '' ?></p>
                <p class="col-lg-4"><?= $event['event_motif'] ?></p>
                <p class="col-lg-2"><?= $event['event_hour'] ?? '' ?>
                <?php if(!isset($user['parent2'])) { ?>
                    <a href="../controllers/controller-rdv.php?idEvent=<?= $event['event_id'] ?>"><img class="trash" src="../assets/img/delete.png" alt=""></a>
                    <a class="type=" button data-bs-toggle="modal" data-bs-target="#modal-<?= $event['event_id'] ?>"><img class="trash" src="../assets/img/edit.png" alt=""></a>
                <?php } ?>
                </p>
            </div>


            <div class="modal fade" id="modal-<?= $event['event_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div><input type="date" name="dateEvent" value="<?= $event['event_date'] ?>"></div>
                                <div><input type="time" name="hourEvent" value="<?= $event['event_hour'] ?? '' ?>"></div>
                                <div> <select name="childname" id="child">
                                        <option value=""><?= $name['child_firstname'] ?? '' ?></option>
                                        <?php foreach ($nameList as $name) { ?>
                                            <option value="<?= $name['child_firstname'] ?? '' ?>"> <?= $name['child_firstname'] ?? '' ?></option>
                                        <?php } ?>
                                    </select></div>
                                <div> <select name="motifEvent" id="event-select">
                                        <option value=""><?= $event['event_name'] ?? '' ?></option>
                                        <option value="rdv médical">Rendez-vous médical</option>
                                        <option value="Anniversaire">Anniversaire</option>
                                        <option value="Sortie scolaire">Sortie scolaire</option>
                                        <option value="Autre">Autre</option>
                                    </select></div>
                                <div><textarea name="noteEvenement" id="" cols="30" rows="5" value=""><?= $event['event_motif'] ?? '' ?></textarea></div>

                                                <input type="hidden" name="idEvent" value="<?= $event['event_id'] ?>">
                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="changeEvent" class="btn btn-warning fw-bold "></input>
                            </form>
                        </div>
                        <div class="modal-footer">


                        </div>
                    </div>
                </div>
            </div>
        <?php  } ?>
    </div>

    </div>




    <?= $error ?? '' ?>
    <?php include('../views/include/footer.php') ?>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>