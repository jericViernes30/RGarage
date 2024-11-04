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


<div class="w-full flex items-center px-32 py-4 bg-[#1b1c1e]">
    <div class="w-1/4">
        <button class="text-2xl font-semibold text-white">
            RGarage.
        </button>
    </div>
    <div class="w-1/2 flex items-center justify-end gap-10 text-md text-white">
        <a href="">Home</a>
        <a href="">About</a>
        <a href="/RGarage/user/unitsAvailable">Units</a>
        <a href="">Contact Us</a>
    </div>
    <div class="w-1/4 flex items-center justify-end gap-5 relative">
        <?php if ($isLoggedIn): ?>
            <button id="profileButton" class="flex items-center justify-end gap-3 mr-7">
                <div class="w-[40px] h-[40px] border-2 bg-white rounded-full">
                </div>
                <span class="text-sm text-white"><?php echo $_SESSION['user']['first_name']; ?></span>
            </button>
        <?php else: ?>
            <a href="/RGarage/user/login" class="text-lg text-white">Login</a>
            <button onclick="window.location.href='/RGarage/user/signup'" class="btn">Signup</button>
        <?php endif; ?>
        <div id="profileDropdown" class="hidden w-1/2 absolute right-0 top-14 flex-col gap-2 text-sm rounded-bl-lg rounded-br-lg p-4 text-white bg-[#1b1c1e]">
            <a href="#">Profile</a>
            <a href="#">Reserved Units</a>
            <a href="/RGarage/user/logout">Logout</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    $('#profileButton').on('click', function(){
        let pfdropdown = $('#profileDropdown');

        if (pfdropdown.hasClass('hidden')) {
            pfdropdown.removeClass('hidden');
            pfdropdown.removeClass('animate__fadeOut'); // Remove fade out animation if it exists
            pfdropdown.addClass('flex animate__animated animate__fadeInDown');
        } else {
            pfdropdown.removeClass('animate__animated animate__fadeInDown');
            pfdropdown.addClass('animate__animated animate__fadeOut');

            // Set a timeout to hide the dropdown after the fade-out animation completes
            setTimeout(function() {
                pfdropdown.addClass('hidden'); // Hide the dropdown after fade-out
                pfdropdown.removeClass('animate__fadeOut'); // Clean up class after hiding
            }, 500); // Adjust this duration to match your animation duration (500ms is typical for fade-out)
        }
    });
});

</script>
