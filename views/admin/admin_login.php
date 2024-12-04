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
    <div class="w-1/4 h-fit block mx-auto shadow-2xl bg-black-v1 rounded-2xl p-5">
        <div class="w-full flex items-center">
            <div class="w-full">
                <p class="text-2xl font-medium text-white mb-10">RGarage.</p>
                <p class="mb-3 text-white">Login your Admin Account</p>
                <form action="/RGarage/admin/auth-admin" class="" method="POST">
                    <div class="mb-7">
                        <label for="email" class="text-gray-400">Admin ID</label>
                        <input type="text" name="admin_id" id="email" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                    </div>
                    <div class="mb-7">
                        <div class="w-full flex items-center justify-between">
                            <label for="password" class="text-gray-400">Password</label>
                            <a href="" class="text-red-500">Forgot password?</a>
                        </div>
                        <input type="password" name="password" id="password" class="w-full mt-1 text-white px-5 py-2 border-b-2 border-white bg-[#35363a] outline-none">
                    </div>
                    <button class="w-full bg-black-v1 text-white border-2 border-white py-2 rounded-lg hover:border-black-v1 hover:bg-white hover:text-black-v1 duration-75 ease-in">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>