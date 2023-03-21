<?php

class Child {
    private int $child_id;
    private string $child_lastname;
    private string $child_firstname;
    private string $birthdate;
    private int $parent_id;

    private object $pdo;
    
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

    public function createChild() {
        $parentID = $_SESSION['user']['parent_id'];
            
        $sql = 'INSERT INTO child (child_lastname, child_firstname, birthdate,parent_id) VALUES (:lastname, :firstname, :birthdate, :parentID)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':lastname', $_POST['childName']);
        $stmt->bindParam(':firstname', $_POST['childFirstname']);
        $stmt->bindParam(':birthdate', $_POST['birthdate']);
        $stmt->bindParam(':parentID', $parentID);
        $stmt->execute();
       
}

/* afficher les prenoms des enfants du parent connecté */

public function displayChild() {
    $parentID = $_SESSION['user']['parent_id'];
    $sql = 'SELECT child_firstname, child_id,birthdate FROM child WHERE parent_id = :parent_id';
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':parent_id', $parentID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/* afficher l'anniversaire de l'enfant du parent connecté */

public function displayChildBirthday() {
    $parentID = $_SESSION['user']['parent_id'];
    $sql = 'SELECT birthdate,child_firstname FROM child WHERE parent_id = :parent_id';
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':parent_id', $parentID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/* verifier que l'enfant n'est pas deja inscrit */

public function checkChild() {
    $parentID = $_SESSION['user']['parent_id'];
    $sql = 'SELECT child_firstname FROM child WHERE parent_id = :parent_id';
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':parent_id', $parentID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;


}

/* afficher les infos de l'enfant par rapport à l'id de l'enfant */

public function displayChildInfo($id) {
   
    $sql = 'SELECT child_firstname, child_lastname, birthdate FROM child WHERE child_id = :child_id';
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':child_id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
}
?>