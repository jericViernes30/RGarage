<?php
class Message
{
    private $conn;
    private $table_name = 'messages';

    public $id;
    public $sender_name;
    public $receiver_name;
    public $content;
    public $image_path;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function saveMessageWithImagePath()
    {
        $type = 'image';
        $content = 'Image sent'; // Default message content
        // Prepare the SQL query to insert the message into the database
        $query = "INSERT INTO " . $this->table_name . " (sender_name, receiver_name, content, image_path, type) 
                  VALUES (?, ?, ?, ?, ?)";

        // Reconnect to the database if the connection has gone away
        if (!$this->conn->ping()) {
            $this->conn->close();
            $this->conn->connect();
        }

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters to the query to prevent SQL injection
        $stmt->bind_param("sssss", $this->sender_name, $this->receiver_name, $content, $this->image_path, $type);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Success
        } else {
            $stmt->close();
            return false; // Failure
        }
    }

    // Method to save message to the database
    public function saveMessage()
{
    // Set the timezone to Philippine Standard Time (PST)
    $timezone = new DateTimeZone('Asia/Manila');

    // Get the current time in Philippine Standard Time (PST)
    $now = new DateTime('now', $timezone);
    $type = 'text'; // Default message type

    // Format the UTC time to store in the database
    $this->created_at = $now->format('Y-m-d H:i:s');

    // Prepare the SQL query to insert the message into the database
    $query = "INSERT INTO " . $this->table_name . " (sender_name, receiver_name, content, type) 
              VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind parameters to the query to prevent SQL injection
    $stmt->bind_param("ssss", $this->sender_name, $this->receiver_name, $this->content, $type);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        $stmt->close();
        return true; // Success
    } else {
        $stmt->close();
        return false; // Failure
    }
}


public function getMessagesByUser($userName)
{

    // Query modified to check both sender_name and receiver_name
    $query = "SELECT * 
            FROM " . $this->table_name . " 
            WHERE sender_name = ? OR receiver_name = ? 
            ORDER BY created_at ASC";

    $stmt = $this->conn->prepare($query);

    // Bind the userName for both sender_name and receiver_name
    $stmt->bind_param("ss", $userName, $userName);  // Binding the same userName for sender_name and receiver_name
    $stmt->execute();

    $result = $stmt->get_result();
    $messages = [];

    // Fetch the messages
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    return $messages;
}

public function getMessagesFromDistinctSenders()
{
    // SQL query to select sender_name, content, and created_at excluding 'Admin' 
    // and getting the latest message for each sender
    $query = "
        SELECT sender_name, content, image_path, created_at 
        FROM " . $this->table_name . " 
        WHERE sender_name != 'Admin' 
        AND created_at IN (
            SELECT MAX(created_at) 
            FROM " . $this->table_name . " 
            WHERE sender_name != 'Admin' 
            GROUP BY sender_name
        ) 
        ORDER BY created_at DESC  -- Order by created_at in ascending order
    ";

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Create an array to hold the messages
    $messages = [];

    // Fetch the messages
    while ($row = $result->fetch_assoc()) {
        // Add the message data to the array
        $messages[] = [
            'sender_name' => $row['sender_name'],
            'content' => $row['content'],
            'created_at' => $row['created_at']
        ];
    }

    // Return the messages
    return $messages;
}


public function getMessagesFromLatestSenderAndAdmin()
{
    // SQL query to get all conversations from the latest sender and Admin
    $query = "
        SELECT sender_name, content, image_path, created_at
        FROM " . $this->table_name . "
        WHERE sender_name IN (
            'Admin', 
            (SELECT sender_name 
             FROM " . $this->table_name . "
             WHERE sender_name != 'Admin'
             ORDER BY created_at DESC
             LIMIT 1)
        )
        ORDER BY created_at ASC
    ";

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Create an array to hold the messages
    $messages = [];

    // Fetch the messages
    while ($row = $result->fetch_assoc()) {
        // Add the message data to the array
        $messages[] = [
            'sender_name' => $row['sender_name'],
            'content' => $row['content'],
            'image_path' => $row['image_path'],
            'created_at' => $row['created_at']
        ];
    }

    // Return the messages
    return $messages;
}



    public function getMessageBySenderName($senderName) {
        // SQL query to fetch messages for the specified sender or where sender is Admin and receiver is the senderName
        $query = "
            SELECT *
            FROM messages
            WHERE (sender_name = ? OR (sender_name = 'Admin' AND receiver_name = ?))
            ORDER BY created_at ASC
        ";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind the sender name parameter and receiver name parameter to the prepared statement
        $stmt->bind_param("ss", $senderName, $senderName); // "s" denotes the type as string for both sender_name and receiver_name

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Array to store messages
        $messages = [];

        // Fetch messages as an associative array
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Return the messages
        return $messages;
    }

    // Function to send a message
    public function adminSendMessage($content, $receiver) {
        $query = "INSERT INTO " . $this->table_name . " (sender_name, receiver_name, content, created_at) 
                  VALUES (?, ?, ?, NOW())"; // Insert current timestamp

        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        $sender_name = 'Admin';
        // Bind the parameters to the SQL query
        $stmt->bind_param("sss", $sender_name, $receiver, $content);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Return true if message was sent successfully
        } else {
            return false; // Return false if there was an error
        }
    }


}
?>