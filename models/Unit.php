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
    public $bnew_price;
    public $shand_price;
    public $modified;
    public $type;
    public $mileage;
    public $thread;
    public $color;
    public $issue;
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
        $query = "INSERT INTO " . $this->table_name . " (plate_number, year, brand, model, mileage, image, price, shand_price, modified, type, thread, color, issue) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Check for preparation error
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return false;
        }
    
        // Bind parameters
        $stmt->bind_param("sssssssssssss", $this->plate_number, $this->year, $this->brand, $this->model, $this->mileage, $this->image, $this->bnew_price, $this->shand_price, $this->modified, $this->type, $this->thread, $this->color, $this->issue,);
    
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

    public function showAllHonda(){
        $query = "SELECT * FROM units WHERE brand = 'Honda'";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return 0; // Return 0 if there's an error
        }

        if (!$stmt->execute()) {
            echo "Execution Error: " . $stmt->error;
            return 0; // Return 0 if there's an execution error
        }

        $honda = [];

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($units = $result->fetch_assoc()){
                $honda[] = $units;
            }
        }

        return $honda;
    }

    public function showAllKawasaki(){
        $query = "SELECT * FROM units WHERE brand = 'Kawasaki'";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return 0; // Return 0 if there's an error
        }

        if (!$stmt->execute()) {
            echo "Execution Error: " . $stmt->error;
            return 0; // Return 0 if there's an execution error
        }

        $kawasaki = [];

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($unit = $result->fetch_assoc()){
                $kawasaki[] = $unit;
            }
        }

        return $kawasaki;
    }

    public function showAllYamaha(){
        $query = "SELECT * FROM units WHERE brand = 'Yamaha'";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return 0; // Return 0 if there's an error
        }

        if (!$stmt->execute()) {
            echo "Execution Error: " . $stmt->error;
            return 0; // Return 0 if there's an execution error
        }

        $yamaha = [];

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($unit = $result->fetch_assoc()){
                $yamaha[] = $unit;
            }
        }

        return $yamaha;
    }

    public function showAllSuzuki(){
        $query = "SELECT * FROM units WHERE brand = 'Suzuki'";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Preparation Error: " . $this->conn->error;
            return 0; // Return 0 if there's an error
        }

        if (!$stmt->execute()) {
            echo "Execution Error: " . $stmt->error;
            return 0; // Return 0 if there's an execution error
        }

        $suzuki = [];

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($unit = $result->fetch_assoc()){
                $suzuki[] = $unit;
            }
        }

        return $suzuki;
    }

    public function livesearch($key) {
        // Sanitize the input key
        $key = $this->conn->real_escape_string($key);
    
        // SQL query to search for key in relevant columns
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE plate_number LIKE ? OR 
                        brand LIKE ? OR 
                        model LIKE ?";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the key with wildcards for a partial match
        $searchKey = '%' . $key . '%';
        $stmt->bind_param("sss", $searchKey, $searchKey, $searchKey);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result set
        $result = $stmt->get_result();
    
        // Fetch all matching rows
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result as an array
        return $data;
    }

    public function livesearchHonda($key) {
        // Sanitize the input key
        $key = $this->conn->real_escape_string($key);
    
        // SQL query to search for key in relevant columns
        $query = "SELECT * FROM " . $this->table_name . " 
          WHERE (plate_number LIKE ? OR model LIKE ?) AND brand = 'Honda'";

    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the key with wildcards for a partial match
        $searchKey = '%' . $key . '%';
        $stmt->bind_param("ss", $searchKey, $searchKey);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result set
        $result = $stmt->get_result();
    
        // Fetch all matching rows
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result as an array
        return $data;
    }

    public function livesearchKawasaki($key) {
        // Sanitize the input key
        $key = $this->conn->real_escape_string($key);
    
        // SQL query to search for key in relevant columns
        $query = "SELECT * FROM " . $this->table_name . " 
          WHERE (plate_number LIKE ? OR model LIKE ?) AND brand = 'Kawasaki'";

    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the key with wildcards for a partial match
        $searchKey = '%' . $key . '%';
        $stmt->bind_param("ss", $searchKey, $searchKey);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result set
        $result = $stmt->get_result();
    
        // Fetch all matching rows
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result as an array
        return $data;
    }

    public function livesearchSuzuki($key) {
        // Sanitize the input key
        $key = $this->conn->real_escape_string($key);
    
        // SQL query to search for key in relevant columns
        $query = "SELECT * FROM " . $this->table_name . " 
          WHERE (plate_number LIKE ? OR model LIKE ?) AND brand = 'Suzuki'";

    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the key with wildcards for a partial match
        $searchKey = '%' . $key . '%';
        $stmt->bind_param("ss", $searchKey, $searchKey);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result set
        $result = $stmt->get_result();
    
        // Fetch all matching rows
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result as an array
        return $data;
    }

    public function livesearchYamaha($key) {
        // Sanitize the input key
        $key = $this->conn->real_escape_string($key);
    
        // SQL query to search for key in relevant columns
        $query = "SELECT * FROM " . $this->table_name . " 
          WHERE (plate_number LIKE ? OR model LIKE ?) AND brand = 'Yamaha'";

    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the key with wildcards for a partial match
        $searchKey = '%' . $key . '%';
        $stmt->bind_param("ss", $searchKey, $searchKey);
    
        // Execute the query
        $stmt->execute();
    
        // Get the result set
        $result = $stmt->get_result();
    
        // Fetch all matching rows
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result as an array
        return $data;
    }

    // Method to filter units based on type and price order (low-high or high-low)
public function filterUnits($type, $priceOrder) {
    // Base query to filter by type and sort by price
    $query = "SELECT * FROM " . $this->table_name . " WHERE type = ? ORDER BY price ";

    // Add sorting direction (ASC for low-high, DESC for high-low)
    if ($priceOrder === 'asc') {
        $query .= "ASC"; // Low to high
    } elseif ($priceOrder === 'desc') {
        $query .= "DESC"; // High to low
    }

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the type parameter if it's provided
    $stmt->bind_param("s", $type); // "s" for string parameter

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Initialize the units array
    $units = [];

    // Fetch all units and store them in an array
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }

    // Return the filtered and sorted units
    return $units;
}

public function filterHondaUnits($type, $priceOrder) {
    // Base query to filter by type and sort by price
    $query = "SELECT * FROM " . $this->table_name . " WHERE type = ? AND brand = 'Honda' ORDER BY price ";

    // Add sorting direction (ASC for low-high, DESC for high-low)
    if ($priceOrder === 'asc') {
        $query .= "ASC"; // Low to high
    } elseif ($priceOrder === 'desc') {
        $query .= "DESC"; // High to low
    }

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the type parameter if it's provided
    $stmt->bind_param("s", $type); // "s" for string parameter

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Initialize the units array
    $units = [];

    // Fetch all units and store them in an array
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }

    // Return the filtered and sorted units
    return $units;
}

public function filterKawasakiUnits($type, $priceOrder) {
    // Base query to filter by type and sort by price
    $query = "SELECT * FROM " . $this->table_name . " WHERE type = ? AND brand = 'Kawasaki' ORDER BY price ";

    // Add sorting direction (ASC for low-high, DESC for high-low)
    if ($priceOrder === 'asc') {
        $query .= "ASC"; // Low to high
    } elseif ($priceOrder === 'desc') {
        $query .= "DESC"; // High to low
    }

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the type parameter if it's provided
    $stmt->bind_param("s", $type); // "s" for string parameter

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Initialize the units array
    $units = [];

    // Fetch all units and store them in an array
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }

    // Return the filtered and sorted units
    return $units;
}

public function filterSuzukiUnits($type, $priceOrder) {
    // Base query to filter by type and sort by price
    $query = "SELECT * FROM " . $this->table_name . " WHERE type = ? AND brand = 'Suzuki' ORDER BY price ";

    // Add sorting direction (ASC for low-high, DESC for high-low)
    if ($priceOrder === 'asc') {
        $query .= "ASC"; // Low to high
    } elseif ($priceOrder === 'desc') {
        $query .= "DESC"; // High to low
    }

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the type parameter if it's provided
    $stmt->bind_param("s", $type); // "s" for string parameter

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Initialize the units array
    $units = [];

    // Fetch all units and store them in an array
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }

    // Return the filtered and sorted units
    return $units;
}

public function filterYamahaUnits($type, $priceOrder) {
    // Base query to filter by type and sort by price
    $query = "SELECT * FROM " . $this->table_name . " WHERE type = ? AND brand = 'Yamaha' ORDER BY price ";

    // Add sorting direction (ASC for low-high, DESC for high-low)
    if ($priceOrder === 'asc') {
        $query .= "ASC"; // Low to high
    } elseif ($priceOrder === 'desc') {
        $query .= "DESC"; // High to low
    }

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the type parameter if it's provided
    $stmt->bind_param("s", $type); // "s" for string parameter

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Initialize the units array
    $units = [];

    // Fetch all units and store them in an array
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }

    // Return the filtered and sorted units
    return $units;
}

public function update() {
    // Prepare the SQL query to update the unit details
    $query = "UPDATE " . $this->table_name . " 
              SET plate_number = ?, year = ?, brand = ?, model = ?, 
                  price = ?, shand_price = ?, type = ?, mileage = ?, 
                  thread = ?, color = ?, issue = ?, modified = ?
              WHERE id = ?";

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the parameters to the query
    $stmt->bind_param("sssssssiisssi", 
        $this->plate_number, $this->year, $this->brand, $this->model, 
        $this->bnew_price, $this->shand_price, $this->type, $this->mileage, 
        $this->thread, $this->color, $this->issue, $this->modified, $this->id
    );

    // Execute the query
    if ($stmt->execute()) {
        return true;
    }

    return false;
}

}
?>
