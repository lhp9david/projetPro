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
     * fonction pour se connecter avec un des deux parents
     * 
     * 
     */


    public function login($mail, $password)

    {
    
       
        /* verifie que le parent 1 existe dans la table parent */

        $query = $this->_pdo->prepare('SELECT * FROM parent WHERE mail = :mail');
        $query->bindValue(':mail', $mail);
        $query->execute();
        $result = $query->fetch();
        /* si il n'existe pas, on verifie que le parent 2 existe dans la table parent */

        if(!$result) {
            $query = $this->_pdo->prepare('SELECT * FROM parent WHERE parent2_nickname = :mail');
            $query->bindValue(':mail', $mail);
            $query->execute();
            $result = $query->fetch();
/* si le parent 2 existe dans la table parent, on verifie que le mot de passe est correct */
            if($result){
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
    
                    $this->_success = true;
    
                    header('Location: controller-accueil.php');
                }
            }
            if(!$result) {
                $this->_errors['error'] = 'Identifiants ou mot de passe incorrect';
            }

/* autrement si le parent 1 existe, on vérifie son mot de passe, on vérifie si des enfants sont enregistrés et si il y a bien un 2eme parent sinon on redirige sur les page correspondante*/
        } else {


        // Vérifier si le parent_id existe dans la table child en faisant une jointure avec la table parent
        $sql = "SELECT child.* FROM child INNER JOIN parent ON child.parent_id = parent.parent_id WHERE child.parent_id = :parent_id";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':parent_id', $result['parent_id']);
        $stmt->execute();
        $result2 = $stmt->fetch();

        /*verifier que le parent 2 existe dans la table parent*/
        $sql2 = "SELECT * FROM parent WHERE parent2_nickname = :parent2_nickname";
        $stmt2 = $this->_pdo->prepare($sql2);
        $stmt2->bindParam(':parent2_nickname', $result['parent2_nickname']);
        $stmt2->execute();
        $result3 = $stmt2->fetch();

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
                   
                } else if (!$result3) {
                    // Aucun parent2 trouvé, on redirige vers la page d'inscription du parent2
                    header('Location: controller-inscription3.php');
                
                } else {
                    header('Location: controller-accueil.php');
                }
            } 
        } else {
           $this->_errors['error'] = 'Identifiants ou mot de passe incorrect';
        }
    }
    }




    /**
     * enregistre un nouveau parent dans la base de données
     * 
     */
    public function createParent($lastname, $firstname, $mail, $password)
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
            $stmt->bindValue(':lastname', $lastname);
            $stmt->bindValue(':firstname', $firstname);
            $stmt->bindValue(':mail',$mail);
            $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
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
