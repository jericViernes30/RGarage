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

        $save = $this->reserve->reserveUnit($user_id, $unit_id, $reserved_date);

        if ($save) {
            header("Location: /RGarage/user/unitsAvailable");
            exit();
        } else {
            header("Location: /RGarage/");
            exit();
        }
    }
}