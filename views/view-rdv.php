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
    

        



    <div class="container text-end mt-5 mx-0">
    <a class="text-black text-decoration-none" href="../controllers/controller-rdv.php"><button class="btn btn-warning fw-bold">Voir tous</button></a>
        <?php foreach ($nameList as $name) { ?>
            <a class="text-black text-decoration-none" href="../controllers/controller-rdv.php?idChild=<?= $name['child_id'] ?>"><button class="btn btn-warning fw-bold"><?= $name['child_firstname'] ?? '' ?></button></a>
        <?php } ?>
    </div>
    <hr>

    <div class=" event-container row mx-auto">
    <p class="text-center fw-bold fs-5"><?= $message ?? '' ?></p>
        <div class="col-lg-2 button_type_doc">
            <button id="medecin">Médical</button>
            <button id="anniv">Anniversaire</button>
            <button id="sport">Sport</button>
            <button id="scolaire">Sortie scolaire</button>
            <button id="other">Autre</button>
        </div>
        <div class="col-lg-6 mx-auto">
            <?php foreach ($eventList as $event) { ?>
               

                <div class="my-3 row event <?php if ($event['event_type_id'] == 1) {
                                                echo 'medecin';
                                            } elseif ($event['event_type_id'] == 2) {
                                                echo 'anniv';
                                            } elseif ($event['event_type_id'] == 3) {
                                                echo 'sport';
                                            } elseif ($event['event_type_id'] == 4) {
                                                echo 'scolaire';
                                            } elseif ($event['event_type_id'] == 5) {
                                                echo 'other';
                                            } ?>">
                    <p class="col-lg-3"><?= date('d-m-Y', strtotime($event['event_date'])) ?? ''; ?></p>
                    <p class="col-lg-3"><?= ucfirst($event['event_name']) ?? '' ?></p>
                    <p class="col-lg-4"><?= $event['event_motif'] ?? '' ?></p>
                    <p class="col-lg-2"><?= $event['event_hour'] ?? '' ?>
                        <?php if (!isset($user['parent2'])) { ?>
                            <img class="trash" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $event['event_id'] ?>" src="../assets/img/delete.png" alt="">
                            <a class="type=" button data-bs-toggle="modal" data-bs-target="#modal-<?= $event['event_id'] ?>"><img class="trash" src="../assets/img/edit.png" alt=""></a>
                        <?php } ?>
                    </p>
                </div>

                <!-- Modal de suppression -->
                <div class="modal fade" id="exampleModal<?= $event['event_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer le fichier</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer ce fichier ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="../controllers/controller-rdv.php?idEvent=<?= $event['event_id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- modal de modification -->
                <div class="modal fade" id="modal-<?= $event['event_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div><input type="date" name="dateEvent" value="<?= $event['event_date'] ?? '' ?>"></div>
                                    <div><input type="time" name="hourEvent" value="<?= $event['event_hour'] ?? '' ?>"></div>
                                    <div> <select name="childname" id="child">
                                            <option value=""><?= $event['child_firstname'] ?? '' ?></option>
                                        </select></div>

                                    <div> <select name="motifEvent" id="event-select">

                                            <option <?= ($event['event_type_id'] == 1) ? 'selected' : '' ?> value="1">Rendez-vous médical</option>
                                            <option <?= ($event['event_type_id'] == 2) ? 'selected' : '' ?> value="2">Anniversaire</option>
                                            <option <?= ($event['event_type_id'] == 3) ? 'selected' : '' ?> value="3">Sport</option>
                                            <option <?= ($event['event_type_id'] == 4) ? 'selected' : '' ?> value="4">Sortie scolaire</option>
                                            <option <?= ($event['event_type_id'] == 5) ? 'selected' : '' ?> value="5">Autre</option>

                                        </select></div>
                                    <div><textarea name="noteEvenement" id="" cols="30" rows="5" value=""><?= $event['event_motif'] ?? '' ?></textarea></div>

                                    <input type="hidden" name="idEvent" value="<?= $event['event_id'] ?>">
                                    <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Fermer</button>
                                    <input type="submit" name="changeEvent" class="btn btn-warning fw-bold " value="Modifier"></input>
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

    </div>




    <?= $error ?? '' ?>
    <?php include('../views/include/footer.php') ?>
    <script src="../rdv.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>

</body>

</html>