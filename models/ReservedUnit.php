<?php
class ReservedUnit {
    private $conn;

    // Unit properties (these should match your table columns)
    public $id;
    public $user_id;
    public $unit_id;
    public $date_reserved;
    public $estimated_time;
    public $rating;
    public $created_at;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function reserveUnit($user_id, $unit_id, $date_reserved, $estimated_time){
        $status = 'Reserved';
        $query = "INSERT INTO reserved (user_id, unit_id, reserved_date, time, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssss', $user_id, $unit_id, $date_reserved, $estimated_time, $status);
        return $stmt->execute();
    }
    
    public function getReservedDates($unit_id) {
        $query = "SELECT * FROM reserved WHERE unit_id = ? ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $unit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $reserved_dates = [];
        while ($row = $result->fetch_assoc()) {
            $reserved_dates[] = $row;
        }
    
        return $reserved_dates;
    }
    

    public function fetchUserReservedUnits($id){
        $query = "SELECT reserved_date, id AS reserved_id, unit_id, rating, status FROM reserved WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $unit_map = []; // Map of reserved_id, reserved_date, and unit_id
        while($row = $result->fetch_assoc()){
            $unit_map[$row['unit_id']] = [
                'reserved_id' => $row['reserved_id'],
                'reserved_date' => $row['reserved_date'],
                'reserved_status' => $row['status'],
                'ratingVal' => $row['rating']
            ];
        }
    
        if (empty($unit_map)) {
            return [];
        }
    
        $unit_ids = array_keys($unit_map);
        $placeholders = implode(',', array_fill(0, count($unit_ids), '?'));
        $query = "SELECT * FROM units WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        $types = str_repeat('i', count($unit_ids));
        $stmt->bind_param($types, ...$unit_ids);
        $stmt->execute();
                                                                                                                                                                                              $result = $stmt->get_result();
        $unit_details = [];
        while($row = $result->fetch_assoc()){
            $unit_id = $row['id'];
            $reserved_info = $unit_map[$unit_id];
            $formatted_date = date("F j, Y", strtotime($reserved_info['reserved_date']));
    
            $unit_details[] = [
                'reserved_id' => $reserved_info['reserved_id'],
                'reserved_date' => $formatted_date,
                'reserve_status' => $reserved_info['reserved_status'],
                'rating' => $reserved_info['ratingVal'],
                'unit_details' => $row
            ];
        }
    
        return $unit_details;
    }

    public function getAllReservedUnits() {
        try {
            // Step 1: Get all rows from the reserved table
            $reservedResult = $this->conn->query("SELECT * FROM reserved");
            if (!$reservedResult) {
                throw new Exception("Error fetching reserved rows: " . $this->conn->error);
            }
            $reservedRows = $reservedResult->fetch_all(MYSQLI_ASSOC);
        
            // Step 2: Extract unique user_ids and units_ids from the reserved rows
            $userIds = array_unique(array_column($reservedRows, 'user_id'));
            $unitIds = array_unique(array_column($reservedRows, 'unit_id'));
        
            // Step 3: Query users table for user data (first_name, last_name)
            if (!empty($userIds)) {
                // Prepare SQL to select users based on the user_ids
                $userIdsPlaceholder = implode(',', array_fill(0, count($userIds), '?'));
                $userStmt = $this->conn->prepare("SELECT * FROM users WHERE id IN ($userIdsPlaceholder)");
                $userStmt->bind_param(str_repeat('i', count($userIds)), ...$userIds);
                $userStmt->execute();
                $userResult = $userStmt->get_result();
                $users = $userResult->fetch_all(MYSQLI_ASSOC);
        
                // Map users by their IDs for easy lookup
                $userMap = [];
                foreach ($users as $user) {
                    $userMap[$user['id']] = $user;
                }
            }
        
            // Step 4: Query units table for all unit data
            if (!empty($unitIds)) {
                // Prepare SQL to select units based on the units_ids
                $unitIdsPlaceholder = implode(',', array_fill(0, count($unitIds), '?'));
                $unitStmt = $this->conn->prepare("SELECT * FROM units WHERE id IN ($unitIdsPlaceholder)");
                $unitStmt->bind_param(str_repeat('i', count($unitIds)), ...$unitIds);
                $unitStmt->execute();
                $unitResult = $unitStmt->get_result();
                $units = $unitResult->fetch_all(MYSQLI_ASSOC);
        
                // Map units by their IDs for easy lookup
                $unitMap = [];
                foreach ($units as $unit) {
                    $unitMap[$unit['id']] = $unit;
                }
            }
        
            // Step 5: Map reserved rows with user and unit data
            $result = [];
            foreach ($reservedRows as $row) {
                $result[] = [
                    'reserved_id' => $row['id'],
                    'reserved_date' => $row['reserved_date'],
                    'status' => $row['status'],
                    'user' => $userMap[$row['user_id']] ?? null,
                    'unit' => $unitMap[$row['unit_id']] ?? null,
                ];
            }
        
            // Output the final mapped data (e.g., as JSON)
            return $result;
        
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function deleteRow(){
        $query = "DELETE FROM reserved WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }

    public function deleteFromUnit(){
        $query = "DELETE FROM units WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }

    public function doneVisiting() {
        $query = "UPDATE reserved SET status = 'Completed' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }

    public function soldStatus(){
        $query = "UPDATE reserved SET status = 'Sold' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }

    public function rate() {
        // SQL query to update the rating in the 'reserved' table
        $query = "UPDATE reserved SET rating = ? WHERE id = ?";
        
        // Prepare the SQL statement
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters (rating as integer and id as integer)
        $stmt->bind_param('ii', $this->rating, $this->id);
        
        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            // Success, return true or a success message
            return true;
        } else {
            // Failure, return false or an error message
            return false;
        }
    }
    
    
    public function averageRating() {
        // Initialize variables
        $totalRating = 0;
        $rowCount = 0;
    
        // Prepare SQL query
        $sql = "SELECT rating FROM reserved WHERE status = 'Completed' OR status = 'Sold'";
    
        // Execute the query
        if ($result = $this->conn->query($sql)) {
            // Loop through the result set
            while ($row = $result->fetch_assoc()) {
                $totalRating += $row['rating']; // Add up the ratings
                $rowCount++; // Count the rows
            }
    
            // Free the result set
            $result->free();
        } else {
            // Handle query error
            return "Error: " . $this->conn->error;
        }
    
        // Calculate average rating
        if ($rowCount > 0) {
            $average = $totalRating / $rowCount;
            return $average; // Return the calculated average
        } else {
            return "No completed reservations found."; // Handle case where no rows match
        }
    }


    
    
}