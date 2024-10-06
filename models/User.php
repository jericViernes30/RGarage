<?php

class User{

    private $conn; // for database connection
    private $table_name = 'users'; // for table name

    // for columns in the table
    public $id;
    public $name;
    public $email;

    // database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create new user
    public function create(){
        $query = "INSERT INTO " . $this->table_name . " (name, email) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->name, $this->email);
        return $stmt->execute();
    }

    // Get all users
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }
}