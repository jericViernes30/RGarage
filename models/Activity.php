<?php
class Activity {
    private $conn;
    private $table_name = "units";

    // Unit properties (these should match your table columns)
    public $id;
    public $name;
    public $activity;
    public $created_at;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function addActivity($name, $activity){
        $query = "INSERT INTO login_activity (name, activity) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $name, $activity);
        return $stmt->execute();
    }

    public function activityToday() {
        // Query to get all activities for today
        $query = "SELECT * FROM login_activity WHERE DATE(created_at) = CURDATE()";
        $stmt = $this->conn->prepare($query);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
    
        // Fetch all activities
        $activities = [];
        while ($row = $result->fetch_assoc()) {
            $activities[] = $row;
        }
        
        // Count the number of activities
        $activityCount = count($activities);
        
        // Return the activities and count as an associative array
        return [
            'activities' => $activities,
            'activity_count' => $activityCount
        ];
    }
    
}