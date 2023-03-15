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
    public function createEvent()
    {

        /* recuperer l'event type id en fonction du nom de l'event */
        $sql = 'SELECT event_type_id FROM event_type WHERE event_type = :event_type_name';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_type_name', $_POST['motifEvent']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $eventTypeID = $result['event_type_id'];

        /* recuperer la valeur du child_id du bon enfant grace à l'id du parent connecté  et au prenom de l'enfant*/
        $sql = 'SELECT child_id FROM child WHERE parent_id = :parent_id AND child_firstname = :child_firstname';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->bindParam(':child_firstname', $_POST['childname']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childID = $result['child_id'];





        $sql = 'INSERT INTO event (event_name, event_date, event_hour, child_id, event_type_id,event_motif) VALUES (:event_name, :event_date, :event_hour, :child_id, :event_type_id, :event_motif)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_name', $_POST['motifEvent']);
        $stmt->bindParam(':event_date', $_POST['dateEvent']);
        $stmt->bindParam(':event_hour', $_POST['hourEvent']);
        $stmt->bindParam(':child_id', $childID);
        $stmt->bindParam(':event_type_id', $eventTypeID);
        $stmt->bindParam(':event_motif', $_POST['noteEvenement']);
        $stmt->execute();
        header('Location: ../controllers/controller-rdv.php');
        exit();
    }

    /* afficher seulement les event du l'enfant selon le parametre $id par ordre chronologique*/
    public function showEvent($id)
    {
        $sql = 'SELECT event_id,event_name, event_date, event_hour, event_motif FROM event WHERE child_id = :child_id ORDER BY event_date ASC, event_hour ASC';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    /* verifier que le child id correspond bien à l'id du parent connecté */
    public function checkChildID($id)
    {
        $sql = 'SELECT child_id FROM child WHERE parent_id = :parent_id AND child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->bindParam(':child_id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    /* effacer un event */  
    public function deleteEvent($id)
    {


        $sql = 'DELETE FROM event WHERE event_id = :event_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_id', $id);
        $stmt->execute();
        header('Location: ../controllers/controller-rdv.php');
        exit();
    }

    /* afficher les events*/

    public function showAllEvent()
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT event_id,event_name, event_date, event_hour, event_motif FROM event  where child_id in (SELECT child_id FROM child WHERE parent_id = :parent_id)';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

   
    }

    /* afficher les events en joignant la table child pour afficher le prenom de l'enfant par ordre chronologique par date et heure*/

    public function showAllEventJoinChild()
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT event_id,event_name, event_date, event_hour, event_motif, child_firstname FROM event  INNER JOIN child ON event.child_id = child.child_id WHERE child.parent_id = :parent_id ORDER BY event_date ASC, event_hour ASC';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

   
    }

    /* recuperer les event_date sous forme de tableau */
    public function showEventDate()
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = 'SELECT event_date FROM event  where child_id in (SELECT child_id FROM child WHERE parent_id = :parent_id)';
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
        $sql = 'SELECT event_id,event_name, event_date, event_hour, event_motif FROM event  where child_id in (SELECT child_id FROM child WHERE parent_id = :parent_id) AND event_date = :event_date';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $parentID);
        $stmt->bindParam(':event_date', $date);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /* modifier un event */
    public function updateEvent()
    {

        /* recuperer la valeur du event_type_id avec l'event_id */
        $sql = 'SELECT event_type_id FROM event WHERE event_id = :event_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_id', $_POST['idEvent']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $eventTypeID = $result['event_type_id'];
      

        /* recuperer la valeur du child_id avec l'event_id */
        $sql = 'SELECT child_id FROM event WHERE event_id = :event_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_id', $_POST['idEvent']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childID = $result['child_id'];

        /* modifier l'event */
        $sql = 'UPDATE event SET event_name = :event_name, event_date = :event_date, event_hour = :event_hour, child_id = :child_id, event_type_id = :event_type_id, event_motif = :event_motif WHERE event_id = :event_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':event_name', $_POST['motifEvent']);
        $stmt->bindParam(':event_date', $_POST['dateEvent']);
        $stmt->bindParam(':event_hour', $_POST['hourEvent']);
        $stmt->bindParam(':child_id', $childID);
        $stmt->bindParam(':event_type_id', $eventTypeID);
        $stmt->bindParam(':event_motif', $_POST['noteEvenement']);
        $stmt->bindParam(':event_id', $_POST['idEvent']);
        $stmt->execute();
  
       
    }

    
}
