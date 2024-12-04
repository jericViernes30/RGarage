<?php
include_once 'models/ReservedUnit.php';
include_once 'config/Database.php'; // Include the database connection class

class ReserveController{
    private $reserve;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->reserve = new ReservedUnit($db);
    }

    public function reserveUnit(){
        $user_id = $_POST['user_id'];
        $unit_id = $_POST['unit_id'];
        $reserved_date = $_POST['reserved_date'];
        $hour = $_POST['hour'];
        $minute = $_POST['minutes'];
        $mode = $_POST['mode'];
        $time = $hour . ':' . $minute . ' ' . $mode;

        $save = $this->reserve->reserveUnit($user_id, $unit_id, $reserved_date, $time);

        if ($save) {
            header("Location: /RGarage/user/unitsAvailable");
            exit();
        } else {
            header("Location: /RGarage/");
            exit();
        }
    }

    public function doneVisiting(){
        $id = $_POST['id'];
        $this->reserve->id = $id;
        $done = $this->reserve->doneVisiting();

        if($done){
            return true;
        } else{
            return false;
        }
    }

    public function rate() {
        // Ensure the necessary POST data is available
        if (isset($_POST['id']) && isset($_POST['rate'])) {
            // Sanitize input to prevent SQL injection or other issues
            $id = intval($_POST['id']);
            $rating = intval($_POST['rate']);
    
            // Set the properties of the 'reserve' model
            $this->reserve->id = $id;
            $this->reserve->rating = $rating;
    
            // Call the 'rate' method in the model
            $rate = $this->reserve->rate();
    
            // Return the result based on whether the update was successful
            if ($rate) {
                echo json_encode(['status' => 'success', 'message' => 'Rating updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update rating']);
            }
        } else {
            // Handle missing POST data
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        }
    }
    
}