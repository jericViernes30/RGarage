<?php

class User{

    private $conn; // for database connection
    private $table_name = 'users'; // for table name

    // for columns in the table
    public $id;
    public $first_name;
    public $last_name;
    public $email_address;
    public $contact_number;
    public $address;
    public $profile_picture;
    public $password;

    // database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createUser($file){
        // Define the upload directory
        $upload_dir = 'C:/xampp/htdocs/RGarage/public/images/profile_pictures/';
        $profile_picture_name = '';
    
        // Ensure the directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create the directory if it doesn't exist
        }
    
        // Check if the file is uploaded
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Extract file information
            $file_tmp_name = $file['tmp_name'];
            $file_name = basename($file['name']);
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    
            // Validate file type (optional, but recommended)
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                throw new Exception("Invalid file type. Allowed types are: " . implode(', ', $allowed_extensions));
            }
    
            // Generate a file name based on lastname_firstname.file_extension
            $sanitized_last_name = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($this->last_name)); // Sanitize last name
            $sanitized_first_name = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($this->first_name)); // Sanitize first name
            $profile_picture_name = $sanitized_last_name . '_' . $sanitized_first_name . '.' . $file_extension;
    
            // Move the uploaded file to the target directory
            if (!move_uploaded_file($file_tmp_name, $upload_dir . $profile_picture_name)) {
                throw new Exception("Failed to upload profile picture.");
            }
        } else {
            throw new Exception("Error uploading file: " . $file['error']);
        }
    
        // Prepare the SQL query
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email_address, contact_number, address, profile_picture, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
    
        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
    
        // Bind parameters including the profile picture
        $stmt->bind_param("sssssss", $this->first_name, $this->last_name, $this->email_address, $this->contact_number, $this->address, $profile_picture_name, $hashed_password);
    
        // Execute and return the result
        return $stmt->execute();
    }
    
    

    // authenticate user if present in database
    public function authUser() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $query = "SELECT * FROM " . $this->table_name . " WHERE email_address = ? LIMIT 1";
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
                        'profile' => $row['profile_picture'],
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