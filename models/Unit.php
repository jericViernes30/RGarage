<?php
class Unit {
    private $conn;
    private $table_name = "units";

    // Unit properties (these should match your table columns)
    public $id;
    public $plate_number;
    public $year;
    public $brand;
    public $model;
    public $price;
    public $mileage;
    public $image;
    public $created_at;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all units from the database
    public function fetchAllUnits() {
        $query = "SELECT * FROM " . $this->table_name;

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

    public function addUnit($imageFiles) {
        // Define the upload directory with an absolute path
        $uploadDir = 'C:/xampp/htdocs/RGarage/public/images/';
        $imageNames = []; // Array to hold names of uploaded images
    
        // Ensure the directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }
    
        // Loop through each uploaded image
        foreach ($imageFiles['tmp_name'] as $key => $tmpName) {
            $imageName = basename($imageFiles['name'][$key]); // Get the original image name
            $targetFilePath = $uploadDir . $imageName; // Target file path
    
            // Check if the file is a valid image
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (strtolower($fileType) !== 'jpg') {
                echo "Error: Only JPG files are allowed.";
                return false;
            }
    
            // Move the uploaded file to the target directory
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $imageNames[] = $imageName; // Add the image name to the array
            } else {
                echo "Error uploading the image: " . $imageName;
                return false; // Stop execution on error
            }
        }
    
        // Join the image names into a comma-separated string
        $this->image = implode(',', $imageNames);
    
        // Define the SQL query
        $query = "INSERT INTO " . $this->table_name . " (plate_number, year, brand, model, mileage, image, price) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Check for preparation error
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return false;
        }
    
        // Bind parameters
        $stmt->bind_param("sssssss", $this->plate_number, $this->year, $this->brand, $this->model, $this->mileage, $this->image, $this->price);
    
        // Execute the query and return the result
        return $stmt->execute();
    }
    
    
    

    public function deleteUnit($plate_number) {
        $query = "DELETE FROM " . $this->table_name . " WHERE plate_number = ?";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $plate_number); // Assuming plate_number is a string
    
        // Execute the statement and check if successful
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    public function countDistinctBrands() {
        $query = "SELECT COUNT(DISTINCT brand) as count FROM " . $this->table_name;

        // Prepare and execute the query
        $stmt = $this->conn->prepare($query);
        
        // Check for preparation error
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return 0; // Return 0 if there's an error
        }
        
        // Execute the query
        if (!$stmt->execute()) {
            echo "Execution Error: " . $stmt->error;
            return 0; // Return 0 if there's an execution error
        }
        
        // Get the result set
        $result = $stmt->get_result();
        
        // Fetch the count
        $row = $result->fetch_assoc();
        
        return (int)$row['count']; // Return the count as an integer
    }

    public function countTotalUnits() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;

        // Prepare and execute the query
        $stmt = $this->conn->prepare($query);
        
        // Check for preparation error
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return 0; // Return 0 if there's an error
        }
        
        // Execute the query
        if (!$stmt->execute()) {
            echo "Execution Error: " . $stmt->error;
            return 0; // Return 0 if there's an execution error
        }
        
        // Get the result set
        $result = $stmt->get_result();
        
        // Fetch the count
        $row = $result->fetch_assoc();
        
        return (int)$row['total']; // Return the total count as an integer
    }
    
}
?>
