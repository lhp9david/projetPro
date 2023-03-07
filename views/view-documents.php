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
                <input multiple="multiple" type="file" name="userFile"> <span><?= $error ?? '' ?></span>
                <input type="submit" value="Envoyer">
               
            </form>
        </div>
    </div>
    
    <?php $year = date('Y'); ?>
 
    <div class="container mx-0"> <p class="yearDoc"><?=$year?></p></div>
    <hr>
    <div class="container box-doc my-2">
        <div class="month-side mt-5">
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=01-<?=$year?>">Janvier</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=02-<?=$year?>">Février</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=03-<?=$year?>">Mars</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=04-<?=$year?>">Avril</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=05-<?=$year?>">Mai</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=06-<?=$year?>">Juin</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=07-<?=$year?>">Juillet</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=08-<?=$year?>">Août</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=09-<?=$year?>">Septembre</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=10-<?=$year?>">Octobre</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=11-<?=$year?>">Novembre</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="../controllers/controller-documents.php?date=12-<?=$year?>">Décembre</a></button>
        </div>


        <div class="container-doc mt-5">
            <?php foreach ($fileList as $value) { ?>
                <img class="elt" src="../controllers/<?= $folderPath . '/' . $value['file_name'] ?>" alt="">
                <?php if (!isset($user['parent2']) ) { ?>
                <a href="../controllers/controller-documents.php?id=<?= $value['file_id'] ?>"><img class="trash" src="../assets/img/delete.png" alt=""></a>
                <?php } ?>
            <?php } 
            ?>
        </div>

    </div>
    <?php include('../views/include/footer.php') ?>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>