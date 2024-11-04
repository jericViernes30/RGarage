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

    // authenticate user if present in database
    public function authUser() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $query = "SELECT id, first_name, last_name, email_address, address, contact_number, password FROM " . $this->table_name . " WHERE email_address = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->email_address);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($this->password, $row['password'])) {
                return [
                    'status' => true,
                    'user' => [
                        'id' => $row['id'],
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'email_address' => $row['email_address'],
                        'address' => $row['address'],
                        'contact_number' => $row['contact_number']
                    ]
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Invalid password.'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'User not found.'
            ];
        }
    }

    public function fetchAllUnits() {
        $query = "SELECT * FROM units";

        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Execute the query
            if ($stmt->execute()) {
                // Get the result set
                $result = $stmt->get_result();

                // Initialize an array to store all units
                $units = [];

                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch each unit and add it to the array
                    while ($unit = $result->fetch_assoc()) {
                        $units[] = $unit; // Add each unit to the array
                    }
                }
                
                // Free result set
                $result->free();
                
                return $units; // Return the array of units
            } else {
                throw new Exception("Execution Error: " . $stmt->error);
            }
        } else {
            throw new Exception("Preparation Error: " . $this->conn->error);
        }
    }

    public function unitDetails($unitID){
        $query = "SELECT * FROM units WHERE id = ?";

        if($stmt = $this->conn->prepare($query)){
            $stmt->bind_param('s', $unitID);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                return $row;
            }
        }
        return null;
    }
}