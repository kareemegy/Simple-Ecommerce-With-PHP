<?php
class Users
{
    public $user_name;
    public $user_email;
    public $user_password;
    public $user_id;
    private $table_name = "users";
    private $conn;

    public function __construct($db)
    {
        // get the stmt from database
        $this->conn = $db;
    }

    /**
     * Check If user exiset
     */
    public function is_user_exiset()
    {
        $query = "SELECT user_id,user_name,password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->user_email);
        if ($stmt->execute()) {
        } else {
            $this->showError($stmt);
            echo "not done";
        }

        $num = $stmt->rowCount();

        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->user_id = $row['user_id'];
            $this->user_name = $row['user_name'];
            $this->user_password = $row['password'];
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create user in the database
     */
    public function Create_user()
    {
        try {

            $query = "INSERT INTO users(user_name,email,password) VALUES(:name,:email,:password)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->user_name);
            $stmt->bindParam(":email", $this->user_email);
            $hash_password = password_hash($this->user_password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hash_password);

            if ($stmt->execute()) {
                return true;
            } else {
                $this->showError($stmt);
                return false;
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

        }

    }

    public function showError($stmt)
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

    // public function is_password_correct()
    // {
    //     $query = "SELECT user_name, password ,email FROM users WHERE email = :user_email";
    //     $stmt = $this->prepare($query);

    //     if ($stmt->execute()) {

    //     } else {
    //         $this->showError($stmt);
    //         return false;
    //     }
    //     // while ($row = $) {
    //     //     # code...
    //     // }

    // }

}
