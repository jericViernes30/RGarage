<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class User{

    private $conn; // for database connection
    private $table_name = 'users'; // for table name

    // for columns in the table
    public $id;
    public $first_name;
    public $last_name;
    public $email_address;
    public $contact_number;
    public $address;
    public $profile_picture;
    public $status = 'Not Verified';
    public $verification_code;
    public $password;
    public $admin_password;
    public $admin_id;

    // database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createAdmin() {
        // Define admin details
        $admin_id = 'ADMIN_001';
        $password = 'admin_001';
        $email = 'jericviernes06@gmail.com';
    
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare SQL query using placeholders to prevent SQL injection
        $query = "INSERT INTO admin (admin_id, email, password) VALUES (?,?,?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the parameters
        $stmt->bind_param('sss', $admin_id, $email, $hashed_password);
    
        // Execute the query
        if ($stmt->execute()) {
            echo "Admin created successfully.";
        } else {
            echo "Error creating admin.";
        }
    }

    public function authAdmin(){
        $query = "SELECT * FROM admin WHERE admin_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    
            // Check if password is correct
            if (password_verify($this->password, $row['password'])) {
                return [
                    'status' => true,
                    'message' => 'Login successful.'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Invalid password.'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'User not found.'
            ];
        }
    }

    // Method to create a new user
    public function createUser($file) {
        // Define the upload directory
        $upload_dir = 'C:/xampp/htdocs/RGarage/public/images/profile_pictures/';
        $this->profile_picture = '';

        // Ensure the directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create the directory if it doesn't exist
        }

        // Handle profile picture upload if exists
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Extract file information
            $file_tmp_name = $file['tmp_name'];
            $file_name = basename($file['name']);
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // Validate file type (optional, but recommended)
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                throw new Exception("Invalid file type. Allowed types are: " . implode(', ', $allowed_extensions));
            }

            // Generate a file name based on lastname_firstname.file_extension
            $sanitized_last_name = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($this->last_name)); // Sanitize last name
            $sanitized_first_name = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($this->first_name)); // Sanitize first name
            $this->profile_picture = $sanitized_last_name . '_' . $sanitized_first_name . '.' . $file_extension;

            // Move the uploaded file to the target directory
            if (!move_uploaded_file($file_tmp_name, $upload_dir . $this->profile_picture)) {
                throw new Exception("Failed to upload profile picture.");
            }
        } else {
            throw new Exception("Error uploading file: " . $file['error']);
        }

        // Generate a verification code
        $this->verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        // Prepare the SQL query to insert the user data
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email_address, status, verification_code, contact_number, address, profile_picture, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        // Bind parameters including the profile picture
        $stmt->bind_param("sssssssss", $this->first_name, $this->last_name, $this->email_address, $this->status, $this->verification_code, $this->contact_number, $this->address, $this->profile_picture, $hashed_password);

        // Execute the query and return the result
        if ($stmt->execute()) {
            // Send email verification after successful insertion
            $this->sendVerificationEmail();
            return true;
        } else {
            return false;
        }
    }

    private function sendVerificationEmail() {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jericviernes06@gmail.com';
            $mail->Password = 'ikul ouhs jrhz ffic';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('jericviernes06@gmail.com', 'Mailer');
            $mail->addAddress($this->email_address, $this->first_name);
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
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
                        <h1 style='color: #333333;'>Email Verification</h1>
                        <p style='font-size: 1rem'>Hi, $this->first_name.</p>
                        <p>Please use the following verification code to complete your registration:</p>
                        <p style='font-size: 24px; color: #007bff;'>$this->verification_code</p>
                        <p>If you did not request this code, please ignore this email.</p>
                        <p>Thank you!</p>
                    </div>
                </body>
                </html>
            ";
            $mail->send();
        } catch (Exception $e) {
            echo 'Message not sent. Mailer Error: {$mail->ErrorInfo}';
        }
    }
    
    

    // authenticate user if present in database
    public function authUser() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE email_address = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->email_address);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            // Check if user is verified
            if ($row['status'] == 'Not Verified') {
                return [
                    'status' => false,
                    'message' => 'User is not verified. Please verify your email address.'
                ];
            }
    
            // Check if password is correct
            if (password_verify($this->password, $row['password'])) {
                return [
                    'status' => true,
                    'user' => [
                        'id' => $row['id'],
                        'profile' => $row['profile_picture'],
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'email_address' => $row['email_address'],
                        'address' => $row['address'],
                        'contact_number' => $row['contact_number']
                    ]
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Invalid password.'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'User not found.'
            ];
        }
    }
    

    public function fetchAllUnits() {
        $query = "SELECT * FROM units WHERE status = 'On Garage'";

        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Execute the query
            if ($stmt->execute()) {
                // Get the result set
                $result = $stmt->get_result();

                // Initialize an array to store all units
                $units = [];

                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch each unit and add it to the array
                    while ($unit = $result->fetch_assoc()) {
                        $units[] = $unit; // Add each unit to the array
                    }
                }
                
                // Free result set
                $result->free();
                
                return $units; // Return the array of units
            } else {
                throw new Exception("Execution Error: " . $stmt->error);
            }
        } else {
            throw new Exception("Preparation Error: " . $this->conn->error);
        }
    }

    public function fetchAllUnitsRandom() {
        // Query to select 4 random units
        $query = "SELECT * FROM units WHERE status = 'On Garage' ORDER BY RAND() LIMIT 4";
    
        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Execute the query
            if ($stmt->execute()) {
                // Get the result set
                $result = $stmt->get_result();
    
                // Initialize an array to store the units
                $units = [];
    
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch each unit and add it to the array
                    while ($unit = $result->fetch_assoc()) {
                        $units[] = $unit; // Add each unit to the array
                    }
                }
    
                // Free result set
                $result->free();
    
                return $units; // Return the array of units
            } else {
                throw new Exception("Execution Error: " . $stmt->error);
            }
        } else {
            throw new Exception("Preparation Error: " . $this->conn->error);
        }
    }
    

    public function unitDetails($unitID){
        $query = "SELECT * FROM units WHERE id = ?";

        if($stmt = $this->conn->prepare($query)){
            $stmt->bind_param('s', $unitID);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                return $row;
            }
        }
        return null;
    }

    public function checkEmailExistence($email) {
        // Prepare the SQL query
        $query = "SELECT * FROM users WHERE email_address = ? AND status != 'Verified'";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt) {
            // Bind the parameter and execute the query
            $stmt->bind_param('s', $email);
            $stmt->execute();
    
            // Get the result of the query
            $result = $stmt->get_result();
    
            // Check if the email exists in the database
            if ($result->num_rows === 1) {
                return true; // Email exists
            } else {
                return false; // Email does not exist
            }
        } else {
            // Throw an exception if query preparation fails
            throw new Exception("Database query preparation failed: " . $this->conn->error);
        }
    }

    public function matchCodes($email, $verification_code) {
        // Prepare the SQL query to get the verification code from the database
        $query = "SELECT verification_code FROM users WHERE email_address = ?";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt) {
            // Bind the email parameter to the query
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Check if a result was found
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
    
                // Compare the verification codes
                if ($row['verification_code'] === $verification_code) {
                    // If they match, update the user's status to 'Verified'
                    $updateQuery = "UPDATE users SET status = 'Verified' WHERE email_address = ?";
                    $updateStmt = $this->conn->prepare($updateQuery);
    
                    if ($updateStmt) {
                        $updateStmt->bind_param('s', $email);
                        if ($updateStmt->execute()) {
                            return true; // Success
                        } else {
                            throw new Exception("Error updating the status: " . $this->conn->error);
                        }
                    } else {
                        throw new Exception("Error preparing the update statement: " . $this->conn->error);
                    }
                } else {
                    return false; // Verification code doesn't match
                }
            } else {
                return false; // No user found with the given email
            }
        } else {
            throw new Exception("Error preparing the select statement: " . $this->conn->error);
        }
    }
    
    public function countUsers(){
        $query = "SELECT COUNT(*) FROM users";
        $stmt = $this->conn->prepare($query);
    }

    public function emailRGarage($name, $number, $email, $message){
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jericviernes06@gmail.com';
            $mail->Password = 'ikul ouhs jrhz ffic';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom($email, 'Customer');
            $mail->addAddress('galindo.marklim.eccbscs@gmail.com', 'Admin');
            $mail->isHTML(true);
            $mail->Subject = 'Customer Email';
            $mail->Body = "
                <html>
                <head>
                <title>Customer Email</title>
                </head>
                <body>
                    <div style='width: 400px; padding: 10px;'>
                        <div style='width: 100%; padding-top: 2rem; display: flex; justify-content: center; align-items: center; gap: 1.25rem; margin-bottom: 2.5rem;'>
                            <p style='font-size: 1.125rem;'>RGarage.</p>
                        </div>
                        <h1 style='color: #333333;'>Customer Email</h1>
                        <p style='font-size: 1rem'>Hi, my name is $name. You can contact me on $number</p>
                        <p style='margin-bottom: 10px;'>$message</p>
                        <p>Email me here: $email</p>
                    </div>
                </body>
                </html>
            ";
            $mail->SMTPDebug = 0;  // Disable debug output
            $mail->send();
            header('Location: /RGarage/');
        } catch (Exception $e) {
            echo 'Message not sent. Mailer Error: {$mail->ErrorInfo}';
        }
    }
    
}