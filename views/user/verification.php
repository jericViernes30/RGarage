<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="w-full h-screen flex flex-col items-center justify-center overflow-hidden bg-[#f3f3f3]">
    <div class="w-1/4 flex items-center gap-2 mb-2">
        <a href="/RGarage/" class="hover:text-black-v1 duration-75 ease-out">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" width="15" height="15" fill="#a8a8a8"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
        <p>Verification</p>
    </div>
    <div class="w-1/4 h-fit block mx-auto shadow-2xl bg-black-v1 rounded-2xl p-5 text-white">
        <div class="w-full flex items-center">
            <div class="w-full">
                <p class="text-2xl font-medium text-white mb-16">RGarage.</p>
                <p class="mb-3 text-white">Verify your Account</p>
                <form action="/RGarage/user/verify" class="" method="POST">
                    <div class="mb-7">
                        <label for="email" class="text-gray-400">Email</label>
                        <input type="email" name="email" id="email" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-gray-700 outline-none">
                        <span id="found" class="text-xs text-green-500 hidden">Email found. Please verify your account.</span>
                        <span id="not_found" class="text-xs text-red-500 hidden">Please try again.</span>
                    </div>
                    <div id="verification" class="mb-10 hidden">
                        <div class="w-full flex items-center gap-2">
                            <input autocomplete="off" class="w-1/6 h-14 rounded-md outline-none border border-gray-400 text-center text-3xl" type="text" name="code">
                            <input autocomplete="off" class="w-1/6 h-14 rounded-md outline-none border border-gray-400 text-center text-3xl" type="text" name="code">
                            <input autocomplete="off" class="w-1/6 h-14 rounded-md outline-none border border-gray-400 text-center text-3xl" type="text" name="code">
                            <input autocomplete="off" class="w-1/6 h-14 rounded-md outline-none border border-gray-400 text-center text-3xl" type="text" name="code">
                            <input autocomplete="off" class="w-1/6 h-14 rounded-md outline-none border border-gray-400 text-center text-3xl" type="text" name="code">
                            <input autocomplete="off" class="w-1/6 h-14 rounded-md outline-none border border-gray-400 text-center text-3xl" type="text" name="code">
                        </div>
                    </div>
                    <button class="w-full bg-black-v1 text-white border-2 border-white py-2 rounded-lg  hover:border-black-v1 hover:bg-white hover:text-black-v1 duration-75 ease-in">Continue</button>
                </form>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $("form").on("submit", function (e) {
                e.preventDefault(); // Prevent form submission

                const email = $("#email").val(); // Get email value
                const $button = $(this).find("button"); // Get the button
                const buttonText = $button.text().trim(); // Get the button's current text

                if (buttonText === "Continue") {
                    // Check if email exists in the database
                    $.ajax({
                        url: "/RGarage/user/verify-email", // Endpoint for email verification
                        type: "POST",
                        data: { email: email },
                        success: function (response) {
                            console.log(response)
                            const data = JSON.parse(response);
                            // Assuming the response contains { exists: true/false }
                            if (data.success) {
                                $('#found').removeClass('hidden');
                                $("#verification").removeClass("hidden"); // Show verification section
                                $button.text("Verify"); // Change button text to 'Verify'
                            } else {
                                $('#not_found').removeClass('hidden');
                            }
                        },
                        error: function () {
                            alert("An error occurred while verifying the email. Please try again later.");
                        },
                    });
                } else if (buttonText === "Verify") {
                    // Match the entered code with the verification_code in the database
                    const verificationCode = $("input[name='code']")
                        .map(function () {
                            return $(this).val().trim();
                        })
                        .get()
                        .join(""); // Collect all input values into a single code string
                    // alert(verificationCode);
                    if (verificationCode.length !== 6) {
                        alert("Please enter a valid 6-digit verification code.");
                        return;
                    }

                    $.ajax({
                        url: "/RGarage/user/match-codes", // Endpoint for code verification
                        type: "POST",
                        data: { email: email, code: verificationCode },
                        success: function (response) {
                            const data = JSON.parse(response);
                            // Assuming the response contains { valid: true/false }
                            if (data.success) {
                                alert("Verification successful!"); // Success action
                                window.location.href = "/RGarage/user/login"; // Redirect if needed
                            } else {
                                alert("Invalid verification code. Please try again.");
                            }
                        },
                        error: function () {
                            alert("An error occurred while verifying the code. Please try again later.");
                        },
                    });
                }
            });

            // Automatically move focus to next input field after entering a single character
            $("input[name='code']").on("input", function () {
                // Allow only one character per input field
                if ($(this).val().length > 1) {
                    $(this).val($(this).val().charAt(0)); // Retain only the first character
                }

                // If the current input has a value, move focus to the next input
                if ($(this).val().length === 1) {
                    $(this).next("input").focus();
                }
            });

        });

    </script>
</body>
</html>