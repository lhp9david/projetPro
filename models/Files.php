<?php

class Files
{

    private int $_file_id;
    private string $_file_name;
    private string $_file_type_id;

    private object $_pdo;

    // methode magique pour get les attributs
    public function __get($attribut)
    {
        return $this->$attribut;
    }

    // methode magique pour set les attributs

    public function __set($attribut, $value)
    {
        $this->$attribut = $value;
    }

    // nous avons besoin d'un constructeur pour instancier la connexion à la base de données
    public function __construct()
    {
        $this->_pdo = Database::connect();
    }


    /* VERIFIER QUE LE FICHIER NE FASSE PAS PLUS DE 5MO */

    public function checkFileSize()
    {
        $fileSize = $_FILES['userFile']['size'];
        if ($fileSize > 5000000) {
            return false;
        } else {
            return true;
        }
    }

    /* verifier que le fichier est un pdf ou une image */
    public function checkFileType()
    {
        $allowedMimeTypes = array('application/pdf', 'image/jpeg', 'image/png');
        $fileType = mime_content_type($_FILES['userFile']['tmp_name']);

        if (in_array($fileType, $allowedMimeTypes)) {
            return true;
        } else {
            return false;
        }
    }

    /* afficher les fichiers  */

    public function getFiles()
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT * FROM files  INNER JOIN child ON files.child_id = child.child_id WHERE child.parent_id = :parent_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }



    public function saveFile($id, $mail)
    {


        // Récupérer le file type id en fonction du champ type
        $sql = 'SELECT file_type_id FROM files_type WHERE file_type = :file_type_name';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':file_type_name', $_POST['type']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $fileTypeID = $result['file_type_id'];

       

        // Créer un dossier unique pour stocker les fichiers au nom de l'enfant
        $sql = 'SELECT child_firstname FROM child WHERE child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $childName = $result['child_firstname'];
        $folderName = $childName . '_' . $id;
        $folderPath = 'uploads/' . $folderName;
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Générer un identifiant unique pour le nom du fichier
        $uniqueId = uniqid();
        $targetPath = $folderPath . '/' . $uniqueId . '_' . $_FILES['userFile']['name'];
        move_uploaded_file($_FILES['userFile']['tmp_name'], $targetPath);

        // Enregistrer le fichier dans la base de données
        $sql = 'INSERT INTO files (file_name, file_type_id, child_id,file_date,mail) VALUES (:file_name, :file_type_id, :child_id,:file_date,:mail)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':file_name', $targetPath);
        $stmt->bindParam(':file_type_id', $fileTypeID);
        $stmt->bindParam(':child_id', $id);
        $stmt->bindValue(':file_date', date('m-Y'));
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();

        return true;
    }

    /* supprimer un fichier dans la base de donnée*/

    public function deleteFile($id)
    {
        /* recupere le nom du fichier selon son Id  et selon le parent_id */
        $sql = 'SELECT file_name FROM files  INNER JOIN child ON files.child_id = child.child_id WHERE child.parent_id = :parent_id AND files.file_id = :file_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->bindParam(':file_id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $fileName = $result['file_name'];
   

        if (file_exists($fileName)) {
            unlink($fileName);
           /* supprimer le fichier dans la base de donnée */
           $sql = 'DELETE FROM files WHERE file_id = :file_id';
           $stmt = $this->_pdo->prepare($sql);
           $stmt->bindParam(':file_id', $id);
           $stmt->execute();
           return true;
        }
 
    }

   

    /* afficher les fichiers selon l'Id de l'enfant et l'id de $_SESSION['parent_id] */

    public function getFilesByChildId($id){

        $sql = 'SELECT * FROM files  INNER JOIN child ON files.child_id = child.child_id WHERE child.parent_id = :parent_id AND files.child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}
