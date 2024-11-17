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
    
    
    
}