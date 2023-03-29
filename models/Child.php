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

    public function createChild($childName,$childFirstname,$birthdate) {
        $parentID = $_SESSION['user']['parent_id'];
            
        $sql = 'INSERT INTO child (child_lastname, child_firstname, birthdate,parent_id) VALUES (:lastname, :firstname, :birthdate, :parentID)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':lastname', htmlspecialchars(trim($childName)));
        $stmt->bindValue(':firstname', htmlspecialchars(trim($childFirstname)));
        $stmt->bindValue(':birthdate', htmlspecialchars(trim($birthdate)));
        $stmt->bindValue(':parentID', $parentID);
        $stmt->execute();
       
}

/**
 * 
 * @return array
 * 
 */

public function displayChild() {
    $parentID = $_SESSION['user']['parent_id'];
    $sql = 'SELECT * FROM child WHERE parent_id = :parent_id';
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':parent_id', $parentID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

}
?>