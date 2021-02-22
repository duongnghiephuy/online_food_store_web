<!-- Containg methods related to orders -->
<?php
include("./conf/db.php");
class Orders
{


    public function isNameValid(string $customer): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        $len = strlen($customer);
        if (($len < 3) || ($len > 40)) {
            $valid = FALSE;
        }
        return $valid;
    }
    public function add_order(string $title, string $customer, string $address, string $number, string $email)
    {
        global $con;
        $customer = trim($customer);
        $title = trim($title);
        $number = trim($number);
        $email = trim($email);
        if (!$this->isNameValid($customer)) {
            throw new Exception('Invalid user name');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email ");
        }
        if (!$this->isNameValid($number)) {
            throw new Exception('Invalid phone number');
        }
        try {
            $query = 'INSERT INTO orders (customer,title,address,phone_number,email,status) VALUES(:customer,:title,:address,:phone_number,:email,:status)';
            $values = array(':customer' => $customer, ':title' => $title, ':phone_number' => $number, ':email' => $email, ':status' => 1, ':address' => $address);
            $stmt = $con->prepare($query);
            $stmt->execute($values);
        } catch (Exception $exception) {
            die("Error:" . $exception->getMessage());
        }
        return $con->lastInsertId();
    }
    public function readAll()
    {
        global $con;
        $query = 'SELECT id,customer,title,address,phone_number,email,status FROM orders ORDER BY id DESC';
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function change_status($id, $status)
    {
        global $con;
        $query = 'UPDATE orders SET status=:status WHERE id=:id ';
        $values = array(':id' => $id, ':status' => intval($status));
        try {
            $stmt = $con->prepare($query);
            $stmt->execute($values);
        } catch (PDOException $exception) {
            die("Error" . $exception->getMessage());
        }
    }
}
