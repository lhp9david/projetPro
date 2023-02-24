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

    <div class="container">
    <div class="doc mt-2">
            <p>Partager un document</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <select name="type" id="">
                    <option value="photo">photo</option>
                    <option value="ecole">ecole</option>
                    <option value="medical">medical</option>
                    <option value="autre">autre</option>
                </select> <br>
                <input multiple="multiple" type="file" name="userFile"><br> <span><?= $error ?? '' ?></span><br>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
    <div class="container"> <p class="yearDoc">2023</p></div>
   
    <div class="container box-doc my-2">
        <div class="month-side mt-5">
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Janvier</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Février</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Mars</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Avril</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Mai</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Juin</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Juillet</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Août</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Septembre</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Octobre</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Novembre</a></button>
            <button class="btn btn-warning fw-bold"><a class="text-black text-decoration-none" href="">Décembre</a></button>
        </div>


        <div class="container-doc mt-5">
            <?php foreach ($fileList as $value) { ?>
                <img class="elt" src="../controllers/<?= $folderPath . '/' . $value['file_name'] ?>" alt="">
                <a href="../controllers/controller-documents.php?id=<?= $value['file_id'] ?>"><img class="trash" src="../assets/img/delete.png" alt=""></a>
            <?php } 
            ?>
        </div>

    </div>


                <div id="grand-format">
                    <?php foreach ($fileList as $value) { ?>
                        <img  src="../controllers/<?= $folderPath . '/' . $value['file_name'] ?>" alt="">
                    <?php }  ?>
                </div>





    <?php include('../views/include/footer.php') ?>

    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../script.js"></script>
</body>

</html>