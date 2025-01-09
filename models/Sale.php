<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
        // Check if the or_number is unique
        $checkQuery = "SELECT COUNT(*) as count FROM sales WHERE or_number = ?";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bind_param('s', $this->or_number);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $row = $checkResult->fetch_assoc();

        if ($row['count'] > 0) {
            // or_number is not unique
            return false;
        }

        // Insert the sale if or_number is unique
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

    public function fetchAllSales(){
        $query = "SELECT * FROM sales";
        $stmt = $this->conn->prepare($query);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->get_result();
                $sales = [];

                if($result->num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                        $sales[] = $row;
                    }
                }

                $result->free();
                return $sales;
            }
        }
    }

    public function getAllEmailOfUserID()
{
    // First query to get unit_id and user_id from reserved table using id
    $unitQuery = "
        SELECT unit_id, user_id 
        FROM reserved 
        WHERE id = ?
    ";

    // Prepare the statement for the first query
    $unitStmt = $this->conn->prepare($unitQuery);

    if (!$unitStmt) {
        die("Error preparing the unit_id query: " . $this->conn->error);
    }

    // Bind the parameter (id is equivalent to $this->id)
    $unitStmt->bind_param("i", $this->id);

    // Execute the query
    $unitStmt->execute();

    // Fetch the result
    $unitResult = $unitStmt->get_result();

    if ($unitResult->num_rows === 0) {
        $unitStmt->close();
        return []; // Return an empty array if no unit_id is found
    }

    $row = $unitResult->fetch_assoc();
    $unit_id = $row['unit_id'];
    $exclude_user_id = $row['user_id'];

    $unitStmt->close();

    // Second query to get email addresses excluding the user_id and checking status
    $emailQuery = "
        SELECT u.email_address 
        FROM users u
        INNER JOIN reserved r ON u.id = r.user_id
        WHERE r.unit_id = ? AND u.id != ? AND r.status = 'Reserved'
    ";

    $emailStmt = $this->conn->prepare($emailQuery);

    if (!$emailStmt) {
        die("Error preparing the email query: " . $this->conn->error);
    }

    // Bind the parameters (unit_id and user_id to exclude)
    $emailStmt->bind_param("ii", $unit_id, $exclude_user_id);

    // Execute the query
    $emailStmt->execute();

    $emailResult = $emailStmt->get_result();

    $emails = [];
    while ($row = $emailResult->fetch_assoc()) {
        $emails[] = $row['email_address'];
    }
    $update = "UPDATE units SET status = 'Sold' WHERE id = ?";
    $updateStmt = $this->conn->prepare($update);
    $updateStmt->bind_param('i', $unit_id);
    if ($updateStmt->execute()) {
        echo "Unit deleted successfully.";
    } else {
        echo "Failed to delete unit: " . $updateStmt->error;
    }
    $emailStmt->close();

    // Send the emails
    $this->sendEmails($emails);
    return true;
}

public function sendEmails($emails)
{
    $mail = new PHPMailer(true); // Use PHPMailer

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jericviernes06@gmail.com'; // Your Gmail address
        $mail->Password = 'ikul ouhs jrhz ffic';   // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender info
        $mail->setFrom('jericviernes06@gmail.com', 'Mailer');

        // Loop through emails and send individually
        foreach ($emails as $email) {
            $mail->clearAddresses(); // Clear recipients to avoid sending to previous addresses
            $mail->addAddress($email); // Add recipient

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Reserved Unit is Sold';
            $mail->Body = "
                <html>
            <head>
            <title>Email Verification</title>
            </head>
            <body>
                <div style='width: 400px; padding: 10px;'>
                    <div style='width: 100%; padding-top: 2rem; display: flex; justify-content: center; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem;'>
                        <p style='font-size: 1.125rem;'>RGarage.</p>
                    </div>
                    <h1 style='color: #333333;'>Your Reserved Unit is Sold.</h1>
                    <p style='font-size: 1rem'>Good day!</p>
                    <p>We just want to inform you that the unit you are interested in (.$this->unit.) has been sold.</p>
                    <p> Please contact us for more details. Thank you!</p>
                </div>
            </body>
            </html>
            ";
            $mail->AltBody = "
            <html>
            <head>
            <title>Email Verification</title>
            </head>
            <body>
                <div style='width: 400px; padding: 10px;'>
                    <div style='width: 100%; padding-top: 2rem; display: flex; justify-content: center; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem;'>
                        <p style='font-size: 1.125rem;'>RGarage.</p>
                    </div>
                    <h1 style='color: #333333;'>Your Reserved Unit is Sold.</h1>
                    <p style='font-size: 1rem'>Good day!</p>
                    <p>We just want to inform you that the unit you are interested in (.$this->unit.) has been sold.</p>
                    <p> Please contact us for more details. Thank you!</p>
                </div>
            </body>
            </html>
        ";
            // Send the email
            $mail->SMTPDebug = 0;  // Disable debug output
            $mail->send();
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

public function historyLivesearch($key) {
    // Escape the search keyword to prevent SQL injection
    $key = '%' . $key . '%';

    // SQL query to search in or_number, name, and unit columns
    $sql = "SELECT * FROM sales WHERE or_number LIKE ? OR name LIKE ? OR unit LIKE ?";

    // Prepare the SQL statement
    if ($stmt = $this->conn->prepare($sql)) {
        // Bind the parameter to the prepared statement
        $stmt->bind_param("sss", $key, $key, $key);

        // Execute the query
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();

        // Fetch all rows from the result
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();

        // Return the result rows
        return $rows;
    } else {
        // Return an error if the statement couldn't be prepared
        return "Error preparing the query.";
    }
}

}