<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the session contains 'user_id' and other user details
// if (isset($_SESSION['user'])) {
//     echo "User ID session is set: " . $_SESSION['user']['user_id'] . "<br>";
// } else {
//     echo "User ID session is not set<br>";
// }

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user']);
// echo "Is Logged In: " . ($isLoggedIn ? "true" : "false") . "<br>";
?>


<div class="w-full flex items-center py-4 bg-[#1b1c1e]">
    <div class="w-4/5 flex items-center mx-auto">
        <div class="w-1/4 relative">
            <button onclick="window.location.href='/RGarage/'" class="text-2xl font-semibold text-white absolute -top-11">
                <img src="/RGarage/public/logo/rgarage.png" alt="" class="filter grayscale brightness-[1000%] w-[60%]">
            </button>
        </div>
        <div class="w-1/2 flex items-center justify-end gap-10 text-md text-white">
            <a href="/RGarage/">Home</a>
            <a href="#about">About</a>
            <a href="/RGarage/user/unitsAvailable">Units</a>
            <?php if ($isLoggedIn): ?>
                <button id="messageButton" class="">
                    <span class=" text-white">Message</span>
                </button>
            <?php else: ?>
                <a href="" class=" text-white">Contact Us</a>
            <?php endif; ?>
        </div>
        <div class="w-1/4 flex items-center justify-end gap-5 relative">
            <?php if ($isLoggedIn): ?>
                <button id="profileButton" class="flex items-center justify-end gap-3 mr-7">
                    <div class="w-[40px] h-[40px] border-2 bg-white rounded-full">
                        <img src="/RGarage/public/images/profile_pictures/<?php echo $_SESSION['user']['profile']?>" alt="" class="rounded-full w-full h-full object-cover">
                    </div>
                    <span class="text-sm text-white"><?php echo $_SESSION['user']['first_name']; ?></span>
                </button>
            <?php else: ?>
                <a href="/RGarage/user/login" class="text-lg text-white">Login</a>
                <button onclick="window.location.href='/RGarage/user/signup'" class="btn">Signup</button>
            <?php endif; ?>
            <div id="profileDropdown" class="hidden w-1/2 absolute right-0 top-14 flex-col gap-2 text-sm rounded-bl-lg rounded-br-lg p-4 text-white bg-[#1b1c1e]">
                <a href="#">Profile</a>
                <a href="/RGarage/user/units/reserved?user_id=<?php echo $_SESSION['user']['user_id']; ?>">Reserved Units</a>
                <a href="/RGarage/user/logout">Logout</a>
            </div>
            <div id="messageDiv" class="hidden w-full h-[400px] rounded-bl-md rounded-br-md absolute right-0 top-14 bg-[#1b1c1e] py-2">
                <div class="px-6 mb-2 h-[8%]">
                    <p class="text-white font-semibold text-xl">Seller</p>
                </div>
                <hr>
                <div id="contents" class="px-6 h-[70%] overflow-y-auto">
                    <p class="text-white text-center text-xs mt-2">No messages found.</p>
                </div>
                <hr>
                <div class="w-full h-[22%] flex items-center justify-center gap-4 px-6">
                <textarea id="messageInput" name="message" placeholder="Write your message here" class="px-4 py-3 w-11/12 outline-none bg-blue-100 rounded-xl text-sm h-fit text-wrap"></textarea>
                    <svg class="hover:cursor-pointer" id="sendButton" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="#fff"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Fetch messages from the server
function fetchMessages() {
    $.ajax({
        url: '/RGarage/user/messages/fetch', // Correct URL
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Response Data:', data);  // Log the whole response to check its structure

            if (data.status === 'success') {
                if (Array.isArray(data.messages) && data.messages.length === 0) {
                    $('#contents').html('<p class="text-white">No messages found.</p>');
                } else {
                    displayMessages(data.messages);  // Display fetched messages
                }

                
            } else {
                console.log('No Message');
            }

            // Delay before scrolling to bottom (0.5 seconds)
            setTimeout(scrollToBottom, 500); // 500ms delay
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error); // Add more logging for better insight
            console.log(xhr.responseText);  // Logs the error response text
        }
    });
}

// Display messages in the chat box
function displayMessages(messages) {
    $('#contents').html(''); // Clear previous messages (if needed, for fresh display)

    if (!messages || messages.length === 0) {  // Check if messages are empty or undefined
        $('#contents').append('<p class="text-white">No messages found.</p>');
    } else {
        $.each(messages, function(index, message) {
            $('#contents').append(`
                <p id="sender" class="text-white text-xs ${message.sender_name !== 'Admin' ? 'text-right' : ''} mb-1">
                    ${message.sender_name === 'Admin' ? 'Admin' : 'You'}
                </p>
                <div id="messageContent" class="w-1/2 message p-2 mb-2 rounded-xl 
                    ${message.sender_name !== 'Admin' ? 'text-right' : ''} 
                    ${message.sender_name !== 'Admin' ? 'justify-end' : ''} 
                    ${message.sender_name !== 'Admin' ? 'bg-blue-200' : 'bg-gray-200'} 
                    ${message.sender_name !== 'Admin' ? 'ml-auto' : ''}">
                    <p class="text-xs text-black">${message.content}</p>
                    <span class="text-gray-400 text-xs">${new Date(message.created_at).toLocaleTimeString()}</span>
                </div>
            `);
        });
    }
}

setInterval(fetchMessages, 500);  // 500 milliseconds = 0.5 seconds

function scrollToBottom() {
    // Scroll to the bottom of the contents div after content is updated
    $('#contents').animate({ scrollTop: $('#contents')[0].scrollHeight }, 500); // Smooth scroll to bottom
}

$(document).ready(function() {
    // Handle send message button click
    $('#sendButton').on('click', function() {
        const message = $('#messageInput').val();

        if (message.trim() !== "") {
            $.ajax({
                url: '/RGarage/user/send-message',  // Correct URL
                type: 'POST',
                data: { message: message },
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

    // Handle profile button dropdown visibility
    $('#profileButton').on('click', function() {
        // Delay before scrolling to bottom (0.5 seconds)
        setTimeout(scrollToBottom, 800); // 500ms delay
        let pfdropdown = $('#profileDropdown');
        if (pfdropdown.hasClass('hidden')) {
            pfdropdown.removeClass('hidden').addClass('flex animate__animated animate__fadeInDown');
        } else {
            pfdropdown.removeClass('animate__animated animate__fadeInDown').addClass('animate__animated animate__fadeOut');
            setTimeout(function() {
                pfdropdown.addClass('hidden').removeClass('animate__fadeOut');
            }, 500); // Adjust the duration to match your fade-out animation
        }
    });

    // Handle message dropdown visibility
    $('#messageButton').on('click', function() {
    // Fetch messages when the page loads
    fetchMessages();
        let pfdropdown = $('#messageDiv');
        if (pfdropdown.hasClass('hidden')) {
            pfdropdown.removeClass('hidden').addClass('animate__animated animate__fadeInDown');
        } else {
            pfdropdown.removeClass('animate__animated animate__fadeInDown').addClass('animate__animated animate__fadeOut');
            setTimeout(function() {
                pfdropdown.addClass('hidden').removeClass('animate__fadeOut');
            }, 200); // Adjust the duration to match your fade-out animation
        }
    });

    $('a[href="#about"]').click(function(e) {
        e.preventDefault(); // Prevent the default anchor behavior
        
        // Scroll to the #about div smoothly
        $('html, body').animate({
            scrollTop: $('#about').offset().top
        }, 500); // Adjust the duration as needed (500ms in this case)
    });
});

</script>
