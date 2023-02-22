<?php

class Files {

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







/* enregistrer des fichiers dans la base de donnée */

    public function saveFile()
    {

        /* recuperer le file type id en fonction du champ type */
        $sql = 'SELECT file_type_id FROM files_type WHERE file_type = :file_type_name';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':file_type_name', $_POST['type']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $fileTypeID = $result['file_type_id'];

        /*recuperer le child_id du parent connecté */
        $sql = 'SELECT child_id FROM child WHERE parent_id = :parent_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childID = $result['child_id'];

        $sql = 'INSERT INTO files (file_name, file_type_id,child_id) VALUES (:file_name, :file_type_id, :child_id)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':file_name', ($_FILES['userFile']['name']));
        $stmt->bindParam(':file_type_id', $fileTypeID);
        $stmt->bindParam(':child_id', $childID);
        $stmt->execute();
    }
   
    /* creer un dossier unique pour stocker les fichiers au nom de l'enfant */
    public function createFolder()
    {
        $sql = 'SELECT child_firstName, child_id FROM child WHERE parent_id = :parent_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['child_id'];
        $childName = $result['child_firstName'];
        $folderName = $childName.'_'.$id;
        $folderPath = 'uploads/' . $folderName ;
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
    }


/* enregistrer les fichier dans le reportoire creer*/ 

public function uploadFile()
{
    $sql = 'SELECT child_firstName, child_id FROM child WHERE parent_id = :parent_id';
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $result['child_id'];
    $childName = $result['child_firstName'];
    $folderName = $childName;
    $folderPath = 'uploads/' . $folderName . '_' . $id;
    
    // Générer un identifiant unique pour le nom du fichier
    $uniqueId = uniqid();
    $targetPath = $folderPath . '/' . $uniqueId . '_' . $_FILES['userFile']['name'];
    move_uploaded_file($_FILES['userFile']['tmp_name'], $targetPath);
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
        $sql = 'SELECT file_name, file_type, file_id FROM files INNER JOIN files_type ON files.file_type_id = files_type.file_type_id WHERE child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':child_id', $_SESSION['user']['child_id']);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
   






?>