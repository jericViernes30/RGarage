<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <title>RGarage | Signup</title>
    <style>
        .loader {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        position: absolute;
        animation: rotate 1s linear infinite
      }
      .loader::before , .loader::after {
        content: "";
        box-sizing: border-box;
        position: absolute;
        inset: 0px;
        border-radius: 50%;
        border: 5px solid #FFF;
        animation: prixClipFix 2s linear infinite ;
      }
      .loader::after{
        border-color: #FF3D00;
        animation: prixClipFix 2s linear infinite , rotate 0.5s linear infinite reverse;
        inset: 6px;
      }

      @keyframes rotate {
        0%   {transform: rotate(0deg)}
        100%   {transform: rotate(360deg)}
      }

      @keyframes prixClipFix {
          0%   {clip-path:polygon(50% 50%,0 0,0 0,0 0,0 0,0 0)}
          25%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 0,100% 0,100% 0)}
          50%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,100% 100%,100% 100%)}
          75%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 100%)}
          100% {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 0)}
      }
    </style>
</head>
<body class="w-full h-screen flex flex-col items-center justify-center overflow-hidden bg-[#f3f3f3]">
<span class="loader hidden"></span>
    <div class="w-1/2 flex items-center gap-2 mb-2">
        <a href="/RGarage/" class="hover:text-black-v1 duration-75 ease-out">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" width="15" height="15" fill="#a8a8a8"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
        <p>Signup</p>
    </div>
    <div class="w-1/2 h-fit block mx-auto shadow-2xl bg-black-v1 rounded-2xl p-5">
        <div class="w-full flex items-center">
            <div class="w-full">
                <p class="text-2xl font-medium text-white mb-14">RGarage.</p>
                <div id="response" class="w-1/2 px-6 py-2 rounded-lg bg-green-500 text-white items-center gap-2 justify-center mx-auto hidden mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="#fff"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                    <p>Account created successfully!</p>
                </div>
                <p class="mb-3 text-white">Create your Account</p>
                <form id="signupForm" class="mb-10 text-white" method="POST" enctype="multipart/form-data">
                    <div class="w-full flex items-center justify-between gap-4 mb-4">
                        <div class="w-1/2 flex flex-col gap-1">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                        </div>
                        <div class="w-1/2 flex flex-col gap-1">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                        </div>
                    </div>
                    <div class="mb-4 w-full flex items-center gap-4">
                        <div class="w-2/3">
                            <label for="email">Email Address</label>
                            <input type="email" name="email_address" id="email" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                        </div>
                        <div class="w-1/3">
                            <label for="contac_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                        </div>
                        
                    </div>
                    <div class="mb-4">
                        <div class="w-full flex items-center justify-between">
                            <label for="address">Address</label>
                        </div>
                        <input type="text" name="address" id="address" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                    </div>
                    <div class="mb-4 w-full flex items-center gap-4">
                        <div class="w-1/2">
                            <label for="password">Password</label>
                            <div class="w-full relative">
                                <input type="password" name="password" id="password" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="15" height="15" fill="#f3f3f3" class="absolute top-1/2 right-2 transform -translate-y-1/2"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <label for="repeat_password">Repeat Password</label>
                            <div class="w-full relative">
                                <input type="password" name="repeat_password" id="repeat_password" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="15" height="15" fill="#f3f3f3" class="absolute top-1/2 right-2 transform -translate-y-1/2"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="file" name="profile_picture" id="" class="mb-2">
                    </div>
                    <button type="submit" class="w-full bg-black-v1 text-white border-2 border-white py-2 rounded-lg hover:border-black-v1 hover:bg-white hover:text-black-v1 duration-75 ease-in">Signup</button>
                </form>
                <p class="text-center">Already have an account? <a href="/RGarage/user/login" class="text-white">Sign In</a></p>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
    $('#signupForm').on('submit', function(event) {
        event.preventDefault(); // Prevent page reload on form submission

        // Ensure the form is being submitted correctly
        let formData = new FormData(this); // Use FormData to handle file data

        $.ajax({
            url: '/RGarage/user/auth/create', // You can hard-code the URL if you prefer
            type: 'POST', // Use POST method
            data: formData, // Send form data including files
            processData: false, // Don't process the data as a query string
            contentType: false, // Don't set content type for multipart form data
            success: function(response) {
                console.log(response);
                window.location.href = '/RGarage/user/verification'; // Redirect to 
                

                // Clear the form fields after successful submission
                $('#signupForm')[0].reset();

                // Display success message and redirect after 2 seconds
                // $('#response').addClass('flex').removeClass('hidden');
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText || error);
                // Display the exact error to the user
                alert(`Error: ${xhr.responseText || error}`);
            }
        });
    });
});


    </script>
</body>
</html>