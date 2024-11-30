<?php
session_start(); // Start the session to access $_SESSION['user']

// Include the model
include_once 'models/Message.php';
include_once 'config/Database.php'; // Include the database connection class

class MessageController
{
    private $msg;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->msg = new Message($db);
    }

    public function storeMessage($messageContent)
    {
        // Validate message
        if (empty($messageContent)) {
            return json_encode(['status' => 'error', 'message' => 'Message cannot be empty']);
        }

        // Get sender and receiver information
        $senderName = $_SESSION['user']['first_name'] ?? 'Unknown'; // Fallback if session is not set
        $receiverName = 'Admin'; // Default receiver

        // Set properties in the Message model
        $this->msg->sender_name = $senderName;
        $this->msg->receiver_name = $receiverName;
        $this->msg->content = $messageContent;
        $this->msg->created_at = date('Y-m-d H:i:s'); // Optional if not needed, as NOW() is used in SQL

        // Save the message using the model method
        $isSaved = $this->msg->saveMessage();

        // Set the content type header for JSON response
        header('Content-Type: application/json');

        if ($isSaved) {
            return json_encode(['status' => 'success', 'message' => 'Message saved successfully']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed to save message']);
        }
    }

    public function fetchMessages()
    {
        $userName = $_SESSION['user']['first_name'] ?? 'Unknown'; // Get logged-in user's first name
        $messages = $this->msg->getMessagesByUser($userName); // Fetch messages from the database

        if ($messages) {
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } else {
            echo json_encode(['status' => 'error', 'message' => []]);
        }
    }

    public function sendMessage(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
            $controller = new MessageController();
            echo $controller->storeMessage($_POST['message']);
        }
    }

    public function displaySenders()
{
    try {
        // Fetch all messages from distinct senders
        $allMessages = $this->msg->getMessagesFromDistinctSenders();

        // Pass the fetched messages to the view
        include 'views/admin/messages.php'; // Include the view with the messages data
    } catch (Exception $e) {
        // Handle any exceptions that may occur
        echo "Error fetching messages: " . $e->getMessage();
        // Optionally log the error or redirect to an error page
    }
}

public function getMessagesBySenderName() {
    // Check if sender_name is passed as a GET parameter
    if (isset($_GET['sender_name']) && !empty($_GET['sender_name'])) {
        $senderName = $_GET['sender_name'];

        // Fetch messages using the model
        $messages = $this->msg->getMessageBySenderName($senderName);

        // Return messages as JSON
        header('Content-Type: application/json');

        // Check if messages are found
        if (!empty($messages)) {
            // Return messages as JSON
            echo json_encode(['messages' => $messages]);
        } else {
            // Return a message if no messages found
            echo json_encode(['message' => 'No messages found for this sender.']);
        }
    } else {
        // Return error if sender_name is not provided or is empty
        echo json_encode(['message' => 'Please provide a sender name.']);
    }
}

public function displayAllMessages(){

}

// Function to handle sending a message
public function sendAdminMessage() {
    // Check if the message is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        $receiver = isset($_POST['receiver']) ? $_POST['receiver'] : '';

        // Validate input
        if (!empty($message)) {
            // Call the sendMessage function from the model
            $messageSent = $this->msg->adminSendMessage($message, $receiver);

            if ($messageSent) {
                // Return a success response (you could also send back the new message data)
                echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
            } else {
                // Return a failure response
                echo json_encode(['status' => 'error', 'message' => 'Failed to send message']);
            }
        } else {
            // Return an error if the input is not valid
            echo json_encode(['status' => 'error', 'message' => 'Sender and message content are required']);
        }
    }
}

public function getRecentMessages() {
    // Fetch messages for the most recent sender
    $messages = $this->msg->getMessagesFromLatestSenderAndAdmin();  // This would return the most recent messages

    if (!empty($messages)) {
        echo json_encode([
            'status' => 'success',
            'messages' => $messages
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No messages found'
        ]);
    }
}


}
