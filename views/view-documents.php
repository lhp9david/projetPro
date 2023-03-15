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

    <div class="container ">
        <div class="doc mt-2">
            <p>Partager un document</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <select name="type" id="">
                    <option value="photo">photo</option>
                    <option value="ecole">ecole</option>
                    <option value="medical">medical</option>
                    <option value="autre">autre</option>
                </select>
                <select name="child" id="">
                    <?php foreach ($nameList as $child) { ?>
                        <option value="<?= $child['child_id'] ?>"><?= ucfirst($child['child_firstname']) ?></option>
                    <?php } ?>
                    <input multiple="multiple" type="file" name="userFile"> <span><?= $error ?? '' ?></span>
                    <input type="submit" value="Envoyer">

            </form>
        </div>
    </div>

    <?php ?>

    <div class="container mx-0">
        <p class="yearDoc"><?= $firstname['child_firstname'] ?? '' ?></p>
    </div>
    <hr>
    <div class="ms-5 mt-2">
    <a class="text-black text-decoration-none" href="../controllers/controller-documents.php"><button class="btn btn-warning fw-bold">Voir tous</button></a>
        <?php foreach ($nameList as $name) { ?>
            <a class="text-black text-decoration-none" href="../controllers/controller-documents.php?idChild=<?= $name['child_id'] ?>"> <button class="btn btn-warning fw-bold"><?= $name['child_firstname'] ?? '' ?></button></a>
        <?php } ?>
    </div>


    <div class="container-doc mt-5">
    <p class="text-center fw-bold fs-5"><?=$message ?? '' ?></p>
        <?php foreach ($fileList as $value) { ?>
            <div class="border border-dark d-flex flex-column-reverse">
                <img class="elt" src="../controllers/<?=$value['file_name'] ?>" alt="">

            </div>
        <?php }
        ?>
    </div>


    <?php include('../views/include/footer.php') ?>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>