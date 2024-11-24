<?php

include_once 'models/Unit.php';
include_once 'models/Activity.php';
include_once 'models/ReservedUnit.php';
include_once 'models/Sale.php';
include_once 'config/Database.php'; // Include the database connection class

class AdminController{
    private $unit;
    private $activity;
    private $reserved;
    private $sale;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->unit = new Unit($db);
        $this->activity = new Activity($db);
        $this->reserved = new ReservedUnit($db);
        $this->sale = new Sale($db);
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
            $this->unit->mileage = htmlspecialchars(strip_tags($_POST['mileage']));
            $this->unit->bnew_price = htmlspecialchars(strip_tags($_POST['bnew_price']));
            $this->unit->shand_price = htmlspecialchars(strip_tags($_POST['shand_price']));
            $this->unit->modified = htmlspecialchars(strip_tags($_POST['status']));
            $this->unit->thread = htmlspecialchars(strip_tags($_POST['thread']));
            $this->unit->color = htmlspecialchars(strip_tags($_POST['color']));
            $this->unit->issue = htmlspecialchars(strip_tags($_POST['issue']));
            $this->unit->type = htmlspecialchars(strip_tags($_POST['type']));

            // Attempt to add the unit
            if ($this->unit->addUnit($_FILES['images'])) {
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
        $totalSales = $this->sale->totalSales();
        $activitiesData = $this->activity->activityToday(); // Get activities and count
        include 'views/admin/dashboard.php';
    }

    public function units(){
        $this->displayUnits();
    }

    public function editUnit(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate and sanitize input
            $this->unit->id = htmlspecialchars(strip_tags($_POST['id']));
            $this->unit->year = htmlspecialchars(strip_tags($_POST['year']));
            $this->unit->plate_number = htmlspecialchars(strip_tags($_POST['plate_number']));
            $this->unit->year = htmlspecialchars(strip_tags($_POST['year']));
            $this->unit->brand = htmlspecialchars(strip_tags($_POST['brand']));
            $this->unit->model = htmlspecialchars(strip_tags($_POST['model']));
            $this->unit->mileage = htmlspecialchars(strip_tags($_POST['mileage']));
            $this->unit->bnew_price = htmlspecialchars(strip_tags($_POST['bnew_price']));
            $this->unit->shand_price = htmlspecialchars(strip_tags($_POST['shand_price']));
            $this->unit->modified = htmlspecialchars(strip_tags($_POST['status']));
            $this->unit->thread = htmlspecialchars(strip_tags($_POST['thread']));
            $this->unit->color = htmlspecialchars(strip_tags($_POST['color']));
            $this->unit->issue = htmlspecialchars(strip_tags($_POST['issue']));
            $this->unit->type = htmlspecialchars(strip_tags($_POST['type']));

            // Attempt to add the unit
            if ($this->unit->update()) {
                // Redirect or set a success message
                header("Location: /RGarage/admin/dashboard"); // Redirect to units page
                exit(); // Stop further execution
            } else {
                echo "Error adding unit.";
            }
        }
    }

    public function reservedUnits(){
        $reserved_units = $this->reserved->getAllReservedUnits();
        include 'views/admin/reserved_units.php';
    }

    public function addToSales(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->sale->name = htmlspecialchars(strip_tags($_POST['customer']));
            $this->sale->price = htmlspecialchars(strip_tags($_POST['pay']));
            $this->sale->contact = htmlspecialchars(strip_tags($_POST['contact_number']));
            $this->sale->email = htmlspecialchars(strip_tags($_POST['email_address']));
            $this->sale->unit = htmlspecialchars(strip_tags($_POST['unit'])); 
            $this->sale->or_number = htmlspecialchars(strip_tags($_POST['or_number'])); 
        }

        if($this->sale->sold()){
            $this->reserved->id = htmlspecialchars(strip_tags($_POST['reservedID']));
            $this->reserved->deleteRow();
            header('Location: /RGarage/admin/dashboard');
        }
    }

    public function walkInSales(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->sale->name = htmlspecialchars(strip_tags($_POST['customer']));
            $this->sale->price = htmlspecialchars(strip_tags($_POST['pay']));
            $this->sale->contact = htmlspecialchars(strip_tags($_POST['contact_number']));
            $this->sale->email = htmlspecialchars(strip_tags($_POST['email_address']));
            $this->sale->unit = htmlspecialchars(strip_tags($_POST['unit'])); 
            $this->sale->or_number = htmlspecialchars(strip_tags($_POST['or_number'])); 
        }
        if($this->sale->sold()){
            $this->unit->plate_number = htmlspecialchars(strip_tags($_POST['plateNumber']));
            if (empty($this->unit->plate_number)) {
                die("Plate number is missing.");
            }
            if ($this->unit->deleteUnit2()) {
                // echo "Unit deleted successfully.";
                header('Location: /RGarage/admin/dashboard');
            } else {
                echo "Failed to delete unit.";
            }
            
        }
    }
}