<?php
class ReservedUnit {
    private $conn;

    // Unit properties (these should match your table columns)
    public $id;
    public $user_id;
    public $unit_id;
    public $date_reserved;
    public $created_at;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function reserveUnit($user_id, $unit_id, $date_reserved){
        $query = "INSERT INTO reserved (user_id, unit_id, reserved_date) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss', $user_id, $unit_id, $date_reserved);
        return $stmt->execute();
    }
    
    public function getReservedDates($unit_id) {
        $query = "SELECT reserved_date FROM reserved WHERE unit_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $unit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $reserved_dates = [];
        while ($row = $result->fetch_assoc()) {
            $reserved_dates[] = $row['reserved_date'];
        }

        return $reserved_dates;
    }

    public function fetchUserReservedUnits($id){
        $query = "SELECT reserved_date, id AS reserved_id, unit_id FROM reserved WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $unit_map = []; // Map of reserved_id, reserved_date, and unit_id
        while($row = $result->fetch_assoc()){
            $unit_map[$row['unit_id']] = [
                'reserved_id' => $row['reserved_id'],
                'reserved_date' => $row['reserved_date']
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
    
    
}