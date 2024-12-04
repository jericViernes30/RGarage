<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Messages</title>
</head>
<body class="w-full flex h-screen text-black-v1 bg-gray-200">
    <div class="w-[16%] bg-gray-700">
    <div class="w-full bg-[#1b1c1e]">
            <img src="/RGarage/public/logo/rgarage.png" alt="" class="px-5 mb-3 filter grayscale brightness-[1000%] w-[60%]">
        </div>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/reserved-units" class="py-2 px-5 text-white w-full">Reserved Units</a>
            <a href="/RGarage/admin/messages" class="bg-[#1b1c1e] py-2 px-5 text-white w-full">Messages</a>
            <a href="/RGarage/admin/history" class="py-2 px-5 text-white w-full">History</a>
        </div>
    </div>
    <div class="w-[84%] h-screen">
        <div class="w-full py-3 flex justify-between bg-white shadow-xl mb-10">
            <div class="flex items-center gap-8 pl-8">
                
                <p class="pt-[2px] text-gray-400 text-sm">RGarage: Pre-owned Motorcycles Dealership System - Admin</p>
            </div>
            <div class="px-16 flex items-center">
                <p class="text-black-v1">Administrator Admin</p>
            </div>
        </div>
        <div class="px-8 w-full h-4/5 flex">
            <div class="w-1/4 bg-white p-2 h-full overflow-y-scroll rounded-tl-xl rounded-bl-xl border-r-2 border-gray-300">
                <?php
                    if (!empty($allMessages)) {
                        foreach ($allMessages as $messages):
                            $sender = $messages['sender_name'];
                            $createdAt = new DateTime($messages['created_at'], new DateTimeZone('Asia/Manila'));
                            $currentTime = new DateTime('now', new DateTimeZone('Asia/Manila'));
                            $interval = $currentTime->diff($createdAt);

                            if ($interval->days == 0 && $interval->h == 0 && $interval->i == 0) {
                                $elapsedTimeText = "Just now";
                            } else {
                                $hours = $interval->h;
                                $minutes = $interval->i;
                                if ($interval->days > 0) {
                                    $elapsedTimeText = $interval->days . 'd ' . $hours . 'h';
                                } else {
                                    $elapsedTimeText = ($hours > 0 ? "{$hours}h " : "") . "{$minutes}m";
                                }
                            }
                ?>
                        <button type="button" class="senderNameBtn w-full flex flex-col gap-2 p-4 bg-black-v1 rounded-lg mb-1">
                            <p class="font-bold text-white"><?php echo htmlspecialchars($messages['sender_name']); ?></p>
                                <div class="w-full flex gap-1 items-center">
                                <p class="text-sm text-gray-400">
                        <?php
                        // Get the content, limit it to 20 characters, and add ellipsis if longer
                        $content = $messages['content'];
                            if (strlen($content) > 20) {
                                $content = substr($content, 0, 20) . '...';
                            }
                            echo htmlspecialchars($content);
                ?>
                                </p>
                                <p id="elapsedTime" class="text-gray-400 text-xs">• <?php echo $elapsedTimeText; ?></p>
                            </div>
                        </button>


			                <?php
endforeach;
} else {
    echo '<p>No messages found.</p>';
}
?>
            </div>
            <div class="w-3/4 h-full rounded-tr-xl flex flex-col rounded-br-xl bg-white">
                <div class="w-full py-4 bg-[#1b1c1e] rounded-tr-xl">
                    <div class="w-11/12 block mx-auto">
                        <p id="senderName" class="font-semibold text-white">Messages</p>
                    </div>
                </div>
                <div id="contents" class="w-11/12 overflow-y-scroll h-4/5 mx-auto py-4">
                </div>
                <div id="form" class="w-11/12 flex items-center mx-auto gap-4 py-4">
                    <input type="text" id="messageInput" name="message" placeholder="Write your message here" class="px-4 py-3 w-11/12 outline-none bg-black-v1 rounded-xl text-sm text-white">
                    <svg class="hover:cursor-pointer" id="sendButton" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="#000"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <script>
        // On document ready
$(document).ready(function() {
    // Make an AJAX call to fetch the most recent messages
    $.ajax({
        url: '/RGarage/admin/get-recent-messages',  // Replace with the correct URL
        method: 'GET',
        success: function(response) {
            // Parse the JSON response
            var data = JSON.parse(response);

            if (data.status === 'success' && data.messages.length > 0) {
                // Generate the HTML for the messages
                var messagesHtml = '';
                var senderName = data.messages[0].sender_name;
                $('#senderName').text(senderName); // Update the #senderName with the first message's sender
                data.messages.forEach(function(message) {
                    messagesHtml += `
                        <div class="w-fit px-4 mb-2 py-2 message-item bg-gray-200 rounded-lg
                            ${message.sender_name !== 'Admin' ? '' : 'text-right'}
                            ${message.sender_name !== 'Admin' ? '' : 'justify-end'}
                            ${message.sender_name !== 'Admin' ? '' : 'ml-auto'}">
                            <p>${message.content}</p>
                            <p class="text-xs text-gray-600">${message.created_at}</p>
                        </div>
                    `;
                });

                // Insert the messages into the #contents section
                $('#contents').html(messagesHtml);
            } else {
                // If no messages found
                $('#contents').html('<p>No messages found.</p>');
            }
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error fetching messages:', error);
            $('#contents').html('<p>There was an error fetching the messages.</p>');
        }
    });
});

        let senderName = '';  // Declare senderName globally
let messageInterval;  // Declare a variable to hold the interval ID

// Event delegation: Listen to clicks on buttons with the class 'senderNameBtn'
$(document).on('click', '.senderNameBtn', function() {
    // Get the sender name from the button
    senderName = $(this).find('p.font-bold').text();  // Get sender's name from the button

    // Update the sender name in the #senderName div
    $('#senderName').html('<p class="font-semibold">' + senderName + '</p>');

    // Clear any existing intervals to avoid multiple intervals running at the same time
    if (messageInterval) {
        clearInterval(messageInterval);
    }

    // Fetch messages every 1 second
    messageInterval = setInterval(function() {
        // Make an AJAX call to fetch messages from the sender
        $.ajax({
            url: '/RGarage/admin/get-message',  // Backend script URL to fetch messages
            method: 'GET',
            data: { sender_name: senderName },  // Send the sender name as a parameter
            success: function(response) {
                // Check if the response contains messages
                let messagesHtml = '';
                if (response.messages && response.messages.length > 0) {
                    // Iterate over the messages and build HTML for each message
                    response.messages.forEach(function(message) {
                        messagesHtml += `
                            <div class="w-fit px-4 mb-2 py-2 message-item rounded-lg
                                ${message.sender_name !== 'Admin' ? '' : 'text-right'}
                                ${message.sender_name !== 'Admin' ? '' : 'justify-end'}
                                ${message.sender_name !== 'Admin' ? '' : 'ml-auto'}
                                ${message.sender_name !== 'Admin' ? 'bg-gray-200' : 'bg-gray-500'}">
                                <p class="text-black-v1">${message.content}</p>
                                <p class="text-xs text-gray-600">${message.created_at}</p>
                            </div>
                        `;
                    });

                    // Insert the messages into the #contents section
                    $('#contents').html(messagesHtml);
                } else {
                    // If no messages, display a message in #contents
                    $('#contents').html('<p>No messages found for this sender.</p>');
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors (e.g., if the AJAX request fails)
                console.error('Error fetching messages:', error);
                $('#contents').html('<p>There was an error fetching the messages.</p>');
            }
        });
    }, 100);  // Fetch messages every 1 second
});

// Handle send message button click
$('#sendButton').on('click', function() {
        const message = $('#messageInput').val();

        if (message.trim() !== "") {
            $.ajax({
                url: '/RGarage/admin/send-message',  // Correct URL
                type: 'POST',
                data: { message: message, receiver:senderName },
                dataType: 'json',
                success: function(data) {
                    console.log('Success response:', data);  // Check the success response
                    $('#messageInput').val(''); // Clear input field after sending message

                    // Fetch messages again after sending
                    fetchMessages();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response text:', xhr.responseText);
                }
            });
        } else {
            alert("Please enter a message.");
        }
    });
    </script>
</body>
</html>