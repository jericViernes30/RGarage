<?php

class User{

    private $conn; // for database connection
    private $table_name = 'users'; // for table name

    // for columns in the table
    public $id;
    public $first_name;
    public $last_name;
    public $contact_number;
    public $address;
    public $email_address;
    public $password;

    // database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create new user
    public function createUser(){
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email_address, contact_number, address, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bind_param("ssssss", $this->first_name, $this->last_name, $this->email_address, $this->contact_number, $this->address, $hashed_password);
        return $stmt->execute();
    }

    // Get all users
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }
}