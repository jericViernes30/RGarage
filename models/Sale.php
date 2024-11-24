<?php

class Sale{
    private $conn;
    
    public $id;
    public $name;
    public $price;
    public $contact;
    public $email;
    public $unit;
    public $or_number;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sold(){
        $query = "INSERT INTO sales (name, contact, email, unit, price, or_number) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssssis', $this->name, $this->contact, $this->email, $this->unit, $this->price, $this->or_number);
        return $stmt->execute();
    }

    public function totalSales()
{
    $query = "SELECT SUM(price) AS total_sales FROM sales";
    $result = $this->conn->query($query); // Execute the query

    if ($result) {
        $row = $result->fetch_assoc(); // Fetch the result as an associative array
        return $row['total_sales'] ?? 0; // Return the total sales or 0 if null
    } else {
        return 0; // Return 0 if the query fails
    }
}

}