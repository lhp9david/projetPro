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
        /* recupere l'id de l'enfant du parent connecté */
        $sql = 'SELECT child_id FROM child WHERE parent_id = :parent_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childID = $result['child_id'];

        $sql = 'SELECT file_name,file_id FROM files  WHERE child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':child_id',$childID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

/* fonction qui recupere le chemin du dossier de l'enfant selon son Id */

    public function getFolderPath($id)
    {
        $sql = 'SELECT child_firstName, child_id FROM child WHERE parent_id = :parent_id AND child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childName = $result['child_firstName'];
        $folderName = $childName;
        $folderPath = 'uploads/' . $folderName . '_' . $id;
        return $folderPath;
    }

    /* fonction qui recupere le chemin du fichier  */

    public function getFilePath()
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
        return $folderPath;
    }

    public function saveFile($id)
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
        $sql = 'INSERT INTO files (file_name, file_type_id, child_id,file_date) VALUES (:file_name, :file_type_id, :child_id,:file_date)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':file_name', ($uniqueId . '_' . $_FILES['userFile']['name']));
        $stmt->bindParam(':file_type_id', $fileTypeID);
        $stmt->bindParam(':child_id', $id);
        $stmt->bindValue(':file_date', date('m-Y'));
        $stmt->execute();

        return true;
    }

    /* supprimer un fichier dans la base de donnée*/

    public function deleteFile($id)
    {
        /* recupere le nom du fichier selon son Id */
        $sql = 'SELECT file_name FROM files WHERE file_id = :file_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':file_id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $fileName = $result['file_name'];
        /* faire le chemin du fichier et le supprimer */
        $filePath = $this->getFilePath() . '/' . $fileName;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
        /* supprimer le fichier dans la base de donnée */
        $sql = 'DELETE FROM files WHERE file_id = :file_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':file_id', $id);
        $stmt->execute();
        return true;
    }

    /* méthode pour supprimer un fichier dans le dossier si il n'existe plus dans la base de donnée */

    /* afficher les fichiers selon l'Id de l'enfant */

    public function getFilesByChildId($id)
    {
        $sql = 'SELECT file_name,file_id FROM files  WHERE child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
