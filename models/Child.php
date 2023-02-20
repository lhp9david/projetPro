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
            public function __construct( $child_lastname, $child_firstname, $birthdate, $parent_id)
            {
        
                $this->_child_lastname= $child_lastname;
                $this->_child_firstname= $child_firstname;
                $this->_birthdate= $birthdate;
                $this->_parent_id= $parent_id;
    
                $this->_pdo = Database::connect();
                
            }

    public function createChild() {
        $parentID = $_SESSION['user']['parent_id'];
            
        $sql = 'INSERT INTO child (child_lastname, child_firstname, birthdate,parent_id) VALUES (:lastname, :firstname, :birthdate, :parentID)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':lastname', $_POST['childName']);
        $stmt->bindParam(':firstname', $_POST['childFirstname']);
        $stmt->bindParam(':birthdate', $_POST['birthdate']);
        $stmt->bindParam(':parentID', $parentID);
        $stmt->execute();
        header('Location: controller-inscription3.php');
        exit();
}
}
?>