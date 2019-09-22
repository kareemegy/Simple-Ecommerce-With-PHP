<?php
/**
 * Database Class
 */
class DataBase
{
    private $host = "localhost";
    private $db_name = "e-commerce";
    private $user_name = "root";
    private $password = "";
    public $conn;
/**
 * return the stmt
 */
    public function getConnection()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user_name, $this->password);
        } catch (PDOEXception $ex) {
            throw new Exception("Danger" . $ex);
        }
        return $this->conn;
    }
}
// used to get mysql database connection
