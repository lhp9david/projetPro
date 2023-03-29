<?php

class Event
{
    private int $event_id;
    private string $event_name;
    private string $event_date;
    private string $event_hour;
    private int $child_id;
    private int $event_type_id;

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

/* creer un event */
    public function createEvent($mail)
    {

        /* recuperer le type d'event par rapport à l'id */
        $sql = 'SELECT event_type FROM event_type WHERE event_type_id = :event_type_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_type_id', $_POST['motifEvent']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $eventTypeName = $result['event_type'];

      





        $sql = 'INSERT INTO event (event_name, event_date, event_hour, child_id, event_type_id,event_motif,mail) VALUES (:event_name, :event_date, :event_hour, :child_id, :event_type_id, :event_motif, :mail)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_name', $eventTypeName);
        $stmt->bindParam(':event_date', $_POST['dateEvent']);
        $stmt->bindParam(':event_hour', $_POST['hourEvent']);
        $stmt->bindParam(':child_id', $_POST['childname']);
        $stmt->bindParam(':event_type_id', $_POST['motifEvent']);
        $stmt->bindParam(':event_motif', $_POST['noteEvenement']);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        header('Location: ../evenements.php');
        exit();
    }

    /* afficher seulement les event du l'enfant selon le parametre $id par ordre chronologique*/
    public function showEvent($id)
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT * FROM event INNER JOIN child ON event.child_id = child.child_id WHERE child.parent_id = :parent_id AND event.child_id = :child_id ORDER BY event_date ASC';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    /* effacer un event selon le parent_id et le event_id */ 
    public function deleteEvent($id)
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'DELETE FROM event WHERE event_id = :event_id AND child_id in (SELECT child_id FROM child WHERE parent_id = :parent_id)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_id', $id);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->execute();
        header('Location: ../evenements.php');
        exit();
    }



    /* afficher les events en joignant la table child pour afficher le prenom de l'enfant par ordre chronologique par date et heure*/

    public function showAllEvent()
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT event_type_id,event_id,event_name, event_date, event_hour, event_motif, child_firstname,mail FROM event  INNER JOIN child ON event.child_id = child.child_id WHERE child.parent_id = :parent_id ORDER BY event_date DESC, event_hour DESC';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

   
    }


    /*recuperer les event selon la date selectionnée */
    public function showEventByDate($date)
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT event_id,event_name, event_date, event_hour, event_motif,child_firstname  FROM event INNER JOIN child ON event.child_id = child.child_id WHERE child.parent_id = :parent_id AND event_date = :event_date ORDER BY event_date ASC, event_hour ASC';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->bindParam(':event_date', $date);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /* modifier un event */
    /**
     * @return void
     */
    public function updateEvent()
    {

        /* recuperer le type avec l'event_type_id */
        $sql = 'SELECT event_type FROM event_type WHERE event_type_id = :event_type_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_type_id', $_POST['motifEvent']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $eventName = $result['event_type'];
      

        /* recuperer la valeur du child_id avec l'event_id */
        $sql = 'SELECT child_id FROM event WHERE event_id = :event_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_id', $_POST['idEvent']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childID = $result['child_id'];

        /* modifier l'event de l'enfant du parent */
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'UPDATE event SET event_name = :event_name, event_date = :event_date, event_hour = :event_hour, child_id = :child_id, event_type_id = :event_type_id, event_motif = :event_motif WHERE event_id = :event_id AND child_id in (SELECT child_id FROM child WHERE parent_id = :parent_id)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->bindParam(':event_name', $eventName );
        $stmt->bindParam(':event_date', $_POST['dateEvent']);
        $stmt->bindParam(':event_hour', $_POST['hourEvent']);
        $stmt->bindParam(':child_id', $childID);
        $stmt->bindParam(':event_type_id', $_POST['motifEvent'] );
        $stmt->bindParam(':event_motif', $_POST['noteEvenement']);
        $stmt->bindParam(':event_id', $_POST['idEvent']);
        $stmt->execute();
    }

    
}
