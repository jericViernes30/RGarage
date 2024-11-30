<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="w-full h-screen flex flex-col items-center justify-center overflow-hidden bg-[#f3f3f3]">
    <div class="w-1/4 flex items-center gap-2 mb-2">
        <a href="/RGarage/" class="hover:text-black-v1 duration-75 ease-out">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" width="15" height="15" fill="#a8a8a8"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
        <p>Login</p>
    </div>
    <div class="w-1/4 h-3/4 block mx-auto shadow-2xl bg-black-v1 rounded-2xl p-5">
        <div class="w-full flex items-center">
            <div class="w-full">
                <p class="text-2xl font-medium text-white mb-24">RGarage.</p>
                <p class="mb-3 text-white">Login your Account</p>
                <form action="/RGarage/user/auth/login" class="mb-10" method="POST">
                    <div class="mb-7">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                    </div>
                    <div class="mb-7">
                        <div class="w-full flex items-center justify-between">
                            <label for="password">Password</label>
                            <a href="" class="text-red-500">Forgot password?</a>
                        </div>
                        <input type="password" name="password" id="password" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                    </div>
                    <button class="w-full bg-black-v1 text-white border-2 border-white py-2 rounded-lg hover:border-black-v1 hover:bg-white hover:text-black-v1 duration-75 ease-in">Login</button>
                </form>
                <p class="text-center text-sm">Don't have an account? <a href="/RGarage/user/signup" class="text-white">Sign Up</a></p>
                <p class="text-center text-sm">Not verified email? <a href="/RGarage/user/verification" class="text-white">Verify Now!</a></p>
            </div>
        </div>
    </div>
</body>
</html>