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

        /* recuperer le child_id du parent connecté */
        $sql = 'SELECT child_id FROM child WHERE parent_id = :parent_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
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

    /* afficher les event d'un enfant */
    public function showEvent()
    {

        /* recuperer le child_id du parent connecté */
        $sql = 'SELECT child_id FROM child WHERE parent_id = :parent_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $_SESSION['user']['parent_id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $childID = $result['child_id'];

        $sql = 'SELECT event_id,event_name, event_date, event_hour, event_motif FROM event WHERE child_id = :child_id';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':child_id', $childID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}
