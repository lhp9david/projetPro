<?php



class Paarent
{
    private int $_parent_id;
    private string $_parent_name;
    private string $_parent_firstname;
    private string $_mail;
    private string $_parent_password;
    private string $_parent2_nickname;
    private string $_parent2_pass;

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
    public function register( $parent_name, $parent_firstname, $mail, $parent_password, $parent2_nickname, $parent2_pass)
    {

        $this->_parent_name = $parent_name;
        $this->_parent_firstname = $parent_firstname;
        $this->_mail = $mail;
        $this->_parent_password = $parent_password;
        $this->_parent2_nickname = $parent2_nickname;
        $this->_parent2_pass = $parent2_pass;

        $this->_pdo = Database::connect();
    }

    public function loogin($mail, $password)
    {
        $query = $this->_pdo->prepare('SELECT * FROM parent WHERE mail = :mail');
        $query->bindValue(':mail', $mail);
        $query->execute();
        $result = $query->fetch();
        // vérifie si l'utilisateur a des enfants
        $query2 = $this->_pdo->prepare('SELECT * FROM child WHERE parent_id = :parent_id');
        $query2->bindValue(':parent_id', $result['parent_id']);
        $query2->execute();
        $result2 = $query2->fetch();
        if ($result2) {
            $_SESSION['user']['child'] = true;
        } else {
            $_SESSION['user']['child'] = false;
        }


        if ($result2) {
            if (password_verify($password, $result['parent_password'])) {
                $_SESSION['user'] = [
                    'parent_id' => $result['parent_id'],
                    'parent_name' => $result['parent_name'],
                    'parent_firstname' => $result['parent_firstname'],
                    'mail' => $result['mail'],
                    'parent_password' => $result['parent_password'],
                    'parent2_nickname' => $result['parent2_nickname'],
                    'parent2_pass' => $result['parent2_pass'],
                ];
                header('Location: controller-home.php');
                exit();
            } else {
                $errors['password'] = 'Mot de passe incorrect';
            }
        } else {
            $errors['mail'] = 'Cette adresse mail n\'existe pas';
        }
    }

    public function createParent()
    {


        $query = $this->_pdo->prepare('SELECT * FROM parent WHERE mail = :mail');
        $query->bindValue(':mail', $_POST['mail']);
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            $errors['mail'] = 'Cette adresse mail est déjà utilisée';
        } else {
            $sql = "INSERT INTO parent (parent_name, parent_firstname, mail,parent_password) VALUES (:lastname, :firstname, :mail, :password)";
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':lastname', $_POST['lastname']);
            $stmt->bindValue(':firstname', $_POST['firstname']);
            $stmt->bindValue(':mail', $_POST['mail']);
            $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->execute();
            header('Location: controller-login.php?subscribed');
            exit();
        }
    }

    public function createParent2() {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = "UPDATE parent SET parent2_nickname = :pseudo, parent2_pass = :password  WHERE parent_id = :parentID";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':pseudo', $_POST['pseudoParent2']);
        $stmt->bindValue(':password', password_hash($_POST['passwordParent2'], PASSWORD_DEFAULT),PDO::PARAM_STR);
        $stmt->bindValue(':parentID', $parentID);
        $stmt->execute();
        header('Location: controller-accueil.php');
        exit();
    }
    public function __construct()
    {

        // $this->_parent_name= $parent_name;
        // $this->_parent_firstname= $parent_firstname;
        // $this->_mail= $mail;
        // $this->_parent_password= $parent_password;
        // $this->_parent2_nickname= $parent2_nickname;
        // $this->_parent2_pass= $parent2_pass;

        $this->_pdo = Database::connect();
    }
}
