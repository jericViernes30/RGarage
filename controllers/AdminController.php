<?php

include_once 'models/Unit.php';
include_once 'config/Database.php'; // Include the database connection class

class AdminController{
    private $unit;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->unit = new Unit($db);
    }

    public function displayUnits() {
        try {
            // Fetch all units using the Unit model
            $units = $this->unit->fetchAllUnits();

            // Pass the fetched units to the view
            include 'views/admin/units.php'; // Include the view with the units data
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            echo "Error fetching units: " . $e->getMessage();
            // Optionally log the error or redirect to an error page
        }
    }

    public function addUnit() {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and sanitize input
            $this->unit->plate_number = htmlspecialchars(strip_tags($_POST['plate_number']));
            $this->unit->year = htmlspecialchars(strip_tags($_POST['year']));
            $this->unit->brand = htmlspecialchars(strip_tags($_POST['brand']));
            $this->unit->model = htmlspecialchars(strip_tags($_POST['model']));
            $this->unit->price = htmlspecialchars(strip_tags($_POST['price']));

            // Attempt to add the unit
            if ($this->unit->addUnit()) {
                // Redirect or set a success message
                header("Location: /RGarage/admin/units"); // Redirect to units page
                exit(); // Stop further execution
            } else {
                echo "Error adding unit.";
            }
        }

        // If not POST, show the form (you can include the form view here if needed)
        include 'views/admin/add_unit.php'; // Ensure you have this view for the add unit form
    }
    
    public function deleteUnit() {
        // Check if the plate_number is set in the GET request
        if (isset($_GET['plate_number'])) {
            $plate_number = $_GET['plate_number'];
            
            // Call the delete function from the Unit model
            if ($this->unit->deleteUnit($plate_number)) {
                // Redirect or give a success message
                header("Location: /RGarage/admin/units"); // Redirect to the units page after deletion
                exit();
            } else {
                // Handle failure (e.g., show an error message)
                echo "Error deleting the unit.";
            }
        } else {
            // Handle the case where plate_number is not provided
            echo "No plate number provided.";
        }
    }
    
    

    public function dashboard(){
        $brandCount = $this->unit->countDistinctBrands();
        $totalUnits = $this->unit->countTotalUnits();
        include 'views/admin/dashboard.php';
    }

    public function units(){
        $this->displayUnits();
    }
}