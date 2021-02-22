<!-- Class containing methods related to manager account -->

<?php


class Manager
{
    private $id;
    private $name;
    private $login;
    public $check;

    public function __construct()
    {
        $this->id = NULL;
        $this->name = NULL;
        $this->login = False;
        $this->check = 0;
    }

    // Check name
    public function isNameValid(string $name): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;


        $len = strlen($name);
        if (($len < 5) || ($len > 20)) {
            $valid = FALSE;
        }

        /* Can add more checks here */

        return $valid;
    }

    /* public function isPassvalid(string $password): bool
    {

        $valid = TRUE;
        if (mb_strlen($password) < 8 || mb_strlen($password) > 30) {
            $valid = FALSE;
        }
        return $valid;
    } */

    // Check existing name
    public function getIdFromName(string $name): ?int
    {
        global $con;
        if (!$this->isNamevalid($name)) {
            throw new Exception("Invalid name");
        }
        $id = null;
        $query = 'SELECT id FROM managers WHERE (name=:name)';
        $values = array(':name' => $name);
        try {
            $stmt = $con->prepare($query);
            $stmt->execute($values);
        } catch (PDOException $exception) {
            die("Error:" . $exception->getMessage());
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array(($row))) {
            $id = intval($row['id'], 10);
        }
        return $id;
    }

    // Add new manager account
    public function addManager(string $name, string $password): int
    {
        global $con;
        $name = trim($name);
        $password = trim($password);


        if (!$this->isNameValid($name)) {
            throw new Exception('Invalid user name');
        }
        if (!is_null($this->getIdFromName($name))) {
            throw new Exception('User name not available');
        }

        $query = 'INSERT INTO managers (name,password) VALUES(:name,:password)';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $values = array(":name" => $name, ":password" => $hash);
        try {
            $stmt = $con->prepare($query);
            $stmt->execute($values);
        } catch (PDOException $exception) {
            die("Error:" . $exception->getMessage());
        }
        return $con->lastInsertId();
    }

    //Log in by manager account
    public function login(string $name, string $password)
    {
        global $con;
        $name = trim($name);
        $password = trim($password);
        $authentication = FALSE;

        if (!$this->isNameValid($name)) {
            $authentication = FALSE;
            throw new Exception('Invalid user name');
        }

        $query = 'SELECT * FROM managers WHERE (name=:name) AND (enabled=1)';
        try {
            $stmt = $con->prepare($query);
            $values = array(':name' => $name);
            $stmt->execute($values);
        } catch (PDOException $exception) {
            die("Error:" . $exception->getMessage());
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($row)) {
            if (password_verify($password, $row['password'])) {
                $authentication = TRUE;
                session_start();
                $_SESSION['manager_id'] = $row['id'];
                echo $row['id'];
                echo $_SESSION['user_id'];
            }
        }
        return $authentication;
    }
    public function logout()
    {
        session_destroy();
    }
}
