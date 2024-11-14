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

        // Use get_result() and fetch_assoc() to fetch all matching rows
        $result = $stmt->get_result();

        // Collect all reserved dates in an array
        $reserved_dates = [];
        while ($row = $result->fetch_assoc()) {
            $reserved_dates[] = $row['reserved_date'];
        }

        return $reserved_dates; // Return array of reserved dates
    }
}