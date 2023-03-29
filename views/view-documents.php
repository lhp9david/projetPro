<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/calendar.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-icons-1.9.1/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/style.css">
    <title>Documents</title>
</head>

<body>
    <?php include('../views/include/navbar.php') ?>






    <div class="container mt-4 text-end mx-0">
        <a class="text-black text-decoration-none" href="../documents.php"><button class="btn <?php if (!isset($_GET['idChild'])) {
                                                                                                                            echo 'border border-3 border-dark rounded';
                                                                                                                        } else {
                                                                                                                            '';
                                                                                                                        } ?> fw-bold">Voir tous</button></a>
        <?php foreach ($nameList as $name) { ?>
            <a class="text-black text-decoration-none" href="../documents.php?idChild=<?= $name['child_id'] ?>"> <button class="btn <?php if (isset($_GET['idChild']) && $_GET['idChild'] == $name['child_id']) {
                                                                                                                                                                echo  'border border-3 border-dark rounded';
                                                                                                                                                            } else {
                                                                                                                                                                '';
                                                                                                                                                            } ?> fw-bold"><?= $name['child_firstname'] ?? '' ?></button></a>
        <?php } ?>

    </div>
    <hr>





    <div class=" event-container row mx-0">


        <div class="doc mx-auto col-lg-3">
            <p class="text-center">Partager un document</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <div> <select class="w-100 form-select mb-1" name="type" id="">
                        <option value="photo">Photo</option>
                        <option value="ecole">Ecole</option>
                        <option value="medical">Médical</option>
                        <option value="autre">Autre</option>
                    </select></div>
                <div> <select class="w-100 form-select mb-1" name="child" id="">
                        <?php foreach ($nameList as $child) { ?>
                            <option value="<?= $child['child_id'] ?>"><?= ucfirst($child['child_firstname']) ?></option>
                        <?php } ?>
                    </select></div>
                <div><input class="w-100 form-control mb-1" type="file" name="userFile">
                    <p class="text-center text-danger"><?= $error ?? '' ?></p>
                </div>
                <div class="mx-auto mt-5 text-center"> <input type="submit" class="btn btn-outline-dark border border-3 border-dark" value="Ajouter"></div>

            </form>
        </div>

        <div class=" col-lg-2 button_type_doc mx-auto">
            <button id="photo">Photos</button>
            <button id="ecole">Ecole</button>
            <button id="medical">Médical</button>
            <button id="autre">Autre</button>
        </div>
        <div class=" col-lg-7 doc_container mx-auto">
            <p class="text-center fw-bold fs-5"><?= $message ?? '' ?></p>
            <?php foreach ($fileList as $value) { ?>
                <div class="bloc-event d-flex flex-column <?php if ($value['file_type_id'] == 1) {
                                                                echo 'photo';
                                                            } else if ($value['file_type_id'] == 2) {
                                                                echo 'ecole';
                                                            } else if ($value['file_type_id'] == 3) {
                                                                echo 'medical';
                                                            } else if ($value['file_type_id'] == 4) {
                                                                echo 'autre';
                                                            } ?>">

                    <a href="../controllers/<?= $value['file_name'] ?>" target="_blank"> <img class="elt p-1" src="<?php if (preg_match('/\.pdf/', $value['file_name'])) {
                                                                                                                        echo '../assets/img/fichier-pdf.png';
                                                                                                                    } else {
                                                                                                                        echo "../controllers/" . $value['file_name'];
                                                                                                                    } ?>" alt="aperçu document"></a>
                    <?php if (!isset($user['parent2']) && $value['mail'] == $user['parent2_nickname']) { ?>
                        <a download="document" class="text-center p-1" href="../controllers/<?= $value['file_name'] ?>"><button class="btn btn-success">Télécharger</button></a>
                    <?php } else if (!isset($user['parent2']) && $value['mail'] == $user['mail']){ ?>
                        <a class="text-center p-1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value['file_id'] ?>"><button class="btn btn-danger">Supprimer</button></a>
                        <?php } ?>
                    <?php if (isset($user['parent2']) && $value['mail'] == $user['mail']) { ?>
                        <a download="document" class="text-center p-1" href="../controllers/<?= $value['file_name'] ?>"><button class="btn btn-success">Télécharger</button></a>
                    <?php } else if (isset($user['parent2']) && $value['mail'] == $user['parent2_nickname']) { ?>
                        <a class="text-center p-1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value['file_id'] ?>"><button class="btn btn-danger">Supprimer</button></a>
                    <?php } ?>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $value['file_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="../documents.php?id=<?= $value['file_id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
            ?>

        </div>

    </div>


    <?php include('../views/include/footer.php') ?>
    <script src="../script.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>

</body>

</html>