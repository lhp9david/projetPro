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
    <title>Les enfants d'abord | Evenements</title>
</head>

<body>
    <?php include('../views/include/navbar.php'); ?>
   


    <div class="container text-end mt-4 mx-0">
        <a class="text-black text-decoration-none" href="../evenements.php"><button class="btn <?php if (!isset($_GET['idChild'])) {
                                                                                                                    echo 'border border-3 border-dark rounded';
                                                                                                                } else {
                                                                                                                    '';
                                                                                                                } ?> fw-bold">Voir tous</button></a>
        <?php foreach ($nameList as $name) { ?>
            <a class="text-black text-decoration-none" href="../evenements.php?idChild=<?= $name['child_id'] ?>"><button class="btn <?php if (isset($_GET['idChild']) && $_GET['idChild'] == $name['child_id']) {
                                                                                                                                                        echo  'border border-3 border-dark rounded';
                                                                                                                                                    } else {
                                                                                                                                                        '';
                                                                                                                                                    } ?>  fw-bold"><?= $name['child_firstname'] ?? '' ?></button></a>
        <?php } ?>
    </div>
    <hr>

    <div class=" event-container row mx-auto">

    
    <div class="doc mx-auto col-lg-3">
            <div class="ajoutEvent"><p class="fw-bold text-center">Ajouter un événement</p><i id="iconEvent" class="bi-arrow-right-circle-fill bi bi-arrow-down-circle-fill   d-block d-lg-none"></i></div>
            <form class="form-event d-none d-lg-block" action="../controllers/controller-rdv.php" method="POST">
                <div class=""> <input class="w-100 form-control mb-1" type="date" name="dateEvent" value="<?= $_GET['date'] ?? '' ?>">
                    <input class="w-100 form-control mb-1" type="time" name="hourEvent">
                </div>
                <div class=""> <select class="w-100 form-select mb-1" name="childname" id="child">
                        <option value="">--Choisir l'enfant--</option>
                        <?php foreach ($nameList as $name) { ?>
                            <option value="<?= $name['child_id'] ?? '' ?>"> <?= $name['child_firstname'] ?? '' ?></option>
                        <?php } ?>
                    </select>
                    <select class="w-100 form-select mb-1" name="motifEvent" id="event-select">
                        <option value="">--Choisir evenement--</option>
                        <option value="1">Rendez-vous médical</option>
                        <option value="2">Anniversaire</option>
                        <option value="3">Sport</option>
                        <option value="4">Sortie scolaire</option>
                        <option value="5">Autre</option>

                    </select>
                </div>
                <div class=""><textarea class="w-100 form-control mb-1" name="noteEvenement" id="" cols="30" rows="5"></textarea></div>

                <div class='text-center mx-auto'><input type="submit" class="btn btn-outline-dark border border-3 border-dark" name="createEvent" value="Ajouter"></div>
                <?php if (isset($_GET['error'])) {
                    echo '<p class="text-center text-danger">'.'Veuillez remplir tous les champs'. '</p>';
                } else {
                    '';
                } ?>
            </form>

        </div>
  
        <div class="col-lg-6 mx-auto ">
        <div class="button_type_doc ">
            <button id="medecin">Médical</button>
            <button id="anniv">Anniversaire</button>
            <button id="sport">Sport</button>
            <button id="scolaire">Sortie scolaire</button>
            <button id="other">Autre</button>
        </div>
        <p class="text-center fw-bold fs-5 mt-5"><?= $message ?? '' ?></p>
            <?php foreach ($eventList as $event) { ?>


                <div class="bloc-event mb-3 row event <?php if ($event['event_type_id'] == 1) {
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
                                                     <?php   $date = new DateTime($event['event_date']);
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);?>

                    <p class="col-lg-4"><?= $formatter->format($date) ?? ''; ?> <br> <?= $event['event_hour'] ?? '' ?></p>
                    <p class="col-lg-1"> <?php if ($event['event_type_id'] == 1) {
                                                            echo '<img src="../assets/img/eventMedecin.png" alt="">';
                                                        } elseif ($event['event_type_id'] == 2) {
                                                            echo '<img src="../assets/img/eventAnniv.png" alt="">';
                                                        } elseif ($event['event_type_id'] == 3) {
                                                            echo '<img src="../assets/img/eventSport.png" alt="">';
                                                        } elseif ($event['event_type_id'] == 4) {
                                                            echo '<img src="../assets/img/eventScolaire.png" alt="">';
                                                        } elseif ($event['event_type_id'] == 5) {
                                                            echo '<img src="../assets/img/eventAutre.png" alt="">';
                                                        } ?></p>
                    <p class="col-lg-4"><?= $event['event_motif'] ?? '' ?></p>
                    <p class="bloc-icon col-lg-3">
                        <?php if (!isset($user['parent2']) && $event['mail'] == $user['mail']) { ?>
                            <img class="trash" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $event['event_id'] ?>" src="../assets/img/delete.png" alt="">
                            <img class="trash" type=" button" data-bs-toggle="modal" data-bs-target="#modal-<?= $event['event_id'] ?>" src="../assets/img/edit.png" alt="">
                        <?php } else if (isset($user['parent2']) && $event['mail'] == $user['parent2_nickname']){ ?>
                            <img class="trash" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $event['event_id'] ?>" src="../assets/img/delete.png" alt="">
                            <img class="trash" type=" button" data-bs-toggle="modal" data-bs-target="#modal-<?= $event['event_id'] ?>" src="../assets/img/edit.png" alt="">
                        <?php } ?>
                    </p>
                </div>
               
                <!-- Modal de suppression -->
                <div class="modal fade" id="exampleModal<?= $event['event_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer l'événement</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer <span class="fw-bold"><?=$event['event_motif']?></span> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="../evenements.php?idEvent=<?= $event['event_id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- modal de modification -->
                <div class="modal fade <?= !empty($errors) ? 'openModal' : ''  ?>" id="modal-<?= $event['event_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'évènement</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div><input class="form-control" type="date" name="dateEvent" value="<?= $event['event_date'] ?? '' ?>"></div>
                                    <div><input class="form-control" type="time" name="hourEvent" value="<?= $event['event_hour'] ?? '' ?>"></div>
                                    <div> <select class="form-control" name="childname" id="child">
                                            <option value=""><?= $event['child_firstname'] ?? '' ?></option>
                                        </select></div>

                                    <div> <select class="form-control" name="motifEvent" id="event-select">

                                            <option <?= ($event['event_type_id'] == 1) ? 'selected' : '' ?> value="1">Rendez-vous médical</option>
                                            <option <?= ($event['event_type_id'] == 2) ? 'selected' : '' ?> value="2">Anniversaire</option>
                                            <option <?= ($event['event_type_id'] == 3) ? 'selected' : '' ?> value="3">Sport</option>
                                            <option <?= ($event['event_type_id'] == 4) ? 'selected' : '' ?> value="4">Sortie scolaire</option>
                                            <option <?= ($event['event_type_id'] == 5) ? 'selected' : '' ?> value="5">Autre</option>

                                        </select></div>
                                    <div><textarea class="form-control" name="noteEvenement" id="" cols="30" rows="5" value=""><?= $event['event_motif'] ?? '' ?></textarea></div>

                                    <input type="hidden" name="idEvent" value="<?= $event['event_id'] ?>">
                                    <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">Fermer</button>
                                    <input type="submit" name="changeEvent" class="btn btn-warning fw-bold " value="Modifier"></input>
                                </form>
                                <p class="text-danger fw-bold"><?=$errors ?? ''?></p>
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





    <?php include('../views/include/footer.php') ?>
    <script src="../rdv.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script>

        /* ouvre la modal au chargement de la page si il y a des erreurs */
    let modal = document.querySelector('.openModal');
    if (modal) {
        let openModal = new bootstrap.Modal(modal, {
            keyboard: false
        })
        openModal.show();
    };
  
</script>


</body>

</html>