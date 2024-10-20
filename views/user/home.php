<?php
// Start the session to access session data
// session_start();

// Check if the user is logged in (check if user session exists)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: /RGarage/user/auth/login");
    exit;
}

// Fetch user details from session
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$address = $_SESSION['address'] ?? 'N/A'; // Assuming address is stored in the session, default to 'N/A' if not set
$email = $_SESSION['email_address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - User Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></h1>
        
        <div class="user-details">
            <h2>Your Information</h2>
            <ul>
                <li><strong>Full Name:</strong> <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></li>
                <li><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></li>
                <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
            </ul>
        </div>
        
        <div class="logout">
            <a href="/RGarage/user/logout">Logout</a> <!-- Implement a logout link -->
        </div>
    </div>
</body>
</html>
