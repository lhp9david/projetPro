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
    public array $_errors = [];
    public $_success = false;

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

    public function __construct()
    {
        $this->_pdo = Database::connect();
    }

    // nous avons besoin d'un constructeur pour instancier la connexion à la base de données
    public function register($parent_name, $parent_firstname, $mail, $parent_password, $parent2_nickname, $parent2_pass)
    {

        $this->_parent_name = $parent_name;
        $this->_parent_firstname = $parent_firstname;
        $this->_mail = $mail;
        $this->_parent_password = $parent_password;
        $this->_parent2_nickname = $parent2_nickname;
        $this->_parent2_pass = $parent2_pass;

        $this->_pdo = Database::connect();
    }


    /**
     * fonction pour se connecter
     * 
     */
    public function login($mail, $password)
    {
       

        $query = $this->_pdo->prepare('SELECT * FROM parent WHERE mail = :mail');
        $query->bindValue(':mail', $mail);
        $query->execute();
        $result = $query->fetch();

        if(!$result) {
            $this->_errors['error'] = 'Identifiants ou mot de passe incorrect';

        } else {


        // Vérifier si le parent_id existe dans la table child en faisant une jointure avec la table parent
        $sql = "SELECT child.* FROM child INNER JOIN parent ON child.parent_id = parent.parent_id WHERE child.parent_id = :parent_id";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $result['parent_id']);
        $stmt->execute();
        $result2 = $stmt->fetch();

        if ($result) {
            // Un ou plusieurs enregistrements ont été trouvés, traiter les données ici

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

                $this->_success = true;

                if (!$result2) {
                    // Aucun enfant trouvé, on redirige vers la page d'inscription de l'enfant
                    header('Location: controller-inscription2.php');
                   
                } else {
                header('Location: controller-accueil.php');
                
                }
            } 
        } else {
           $this->_errors['error'] = 'Identifiants ou mot de passe incorrect';
        }}
    }

    /**
     * enregistre un nouveau parent dans la base de données
     * 
     */
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
/*****************
 * creation du parent 2
 * **************
 * 
 */
    public function createParent2()
    {
        $parentID = $_SESSION['user']['parent_id'];
        $sql = "UPDATE parent SET parent2_nickname = :pseudo, parent2_pass = :password  WHERE parent_id = :parentID";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':pseudo', $_POST['pseudoParent2']);
        $stmt->bindValue(':password', password_hash($_POST['passwordParent2'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':parentID', $parentID);
        $stmt->execute();
        header('Location: controller-accueil.php');
        exit();
    }

    /**
     * méthode pour connexion du parent 2
     * 
     */

    public function loginParent2($pseudo, $password){
        $errors = [];

        $query = $this->_pdo->prepare('SELECT * FROM parent WHERE parent2_nickname = :pseudo');
        $query->bindValue(':pseudo', $pseudo);
        $query->execute();
        $result = $query->fetch();

        if ($result) {
            // Un ou plusieurs enregistrements ont été trouvés, traiter les données ici

            if (password_verify($password, $result['parent2_pass'])) {
                $_SESSION['user'] = [
                    'parent_id' => $result['parent_id'],
                    'parent_name' => $result['parent_name'],
                    'parent_firstname' => $result['parent_firstname'],
                    'mail' => $result['mail'],
                    'parent_password' => $result['parent_password'],
                    'parent2_nickname' => $result['parent2_nickname'],
                    'parent2_pass' => $result['parent2_pass'],
                ];
                header('Location: controller-accueil.php');
                exit();
            } else {
               $errors['error'] = 'Mauvais identifiant ou mot de passe';
            }
        }
    }
}
