<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="w-full flex h-screen text-black-v1 bg-gray-200">
    <div class="w-[16%] bg-gray-700">
        <p class="text-white px-5 py-3 mb-6 bg-blue-500">RGarage.</p>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="bg-blue-500 py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">Messages</a>
        </div>
    </div>
    <div class="w-[84%]">
        <div class="w-full py-3 flex justify-between bg-white shadow-xl">
            <div class="flex items-center gap-8 pl-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="23" height="23" fill="#000"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg>
                <p class="pt-[2px] text-gray-400 text-sm">RGarage: Pre-owned Motorcycles Dealership System - Admin</p>
            </div>
            <div class="px-16 flex items-center">
                <p class="text-black-v1">Administrator Admin</p>
            </div>
        </div>
        <p class="text-black-v1 text-4xl py-3 px-8 mb-10">Welcome to Pre-owned Motorcycles Dealership System</p>
        <div class="px-8 w-full flex flex-wrap text-black-v1 gap-2 justify-between">
            <div class="w-[24%] bg-white shadow-xl p-2 flex gap-2">
                <div class="w-[60px] h-[60px] flex items-center justify-center bg-gray-500 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35" height="35" fill="#fff"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM199.4 312.6c-31.2-31.2-31.2-81.9 0-113.1s81.9-31.2 113.1 0c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9c-50-50-131-50-181 0s-50 131 0 181s131 50 181 0c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0c-31.2 31.2-81.9 31.2-113.1 0z"/></svg>
                </div>
                <div class="flex flex-col justify-between">
                    <p>Total Brands</p>
                    <p class="text-2xl font-semibold"><?php echo htmlspecialchars($brandCount); ?></p>
                </div>
            </div>
            <div class="w-[24%] bg-white shadow-xl p-2 flex gap-2">
                <div class="w-[60px] h-[60px] flex items-center justify-center bg-gray-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35" height="35"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/></svg>
                </div>
                <div class="flex flex-col justify-between">
                    <p>Total Category</p>
                    <p class="text-2xl font-semibold">3</p>
                </div>
            </div>
            <div class="w-[24%] bg-white shadow-xl p-2 flex gap-2">
                <div class="w-[60px] h-[60px] flex items-center justify-center bg-yellow-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="35" height="35"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M280 32c-13.3 0-24 10.7-24 24s10.7 24 24 24l57.7 0 16.4 30.3L256 192l-45.3-45.3c-12-12-28.3-18.7-45.3-18.7L64 128c-17.7 0-32 14.3-32 32l0 32 96 0c88.4 0 160 71.6 160 160c0 11-1.1 21.7-3.2 32l70.4 0c-2.1-10.3-3.2-21-3.2-32c0-52.2 25-98.6 63.7-127.8l15.4 28.6C402.4 276.3 384 312 384 352c0 70.7 57.3 128 128 128s128-57.3 128-128s-57.3-128-128-128c-13.5 0-26.5 2.1-38.7 6L418.2 128l61.8 0c17.7 0 32-14.3 32-32l0-32c0-17.7-14.3-32-32-32l-20.4 0c-7.5 0-14.7 2.6-20.5 7.4L391.7 78.9l-14-26c-7-12.9-20.5-21-35.2-21L280 32zM462.7 311.2l28.2 52.2c6.3 11.7 20.9 16 32.5 9.7s16-20.9 9.7-32.5l-28.2-52.2c2.3-.3 4.7-.4 7.1-.4c35.3 0 64 28.7 64 64s-28.7 64-64 64s-64-28.7-64-64c0-15.5 5.5-29.7 14.7-40.8zM187.3 376c-9.5 23.5-32.5 40-59.3 40c-35.3 0-64-28.7-64-64s28.7-64 64-64c26.9 0 49.9 16.5 59.3 40l66.4 0C242.5 268.8 190.5 224 128 224C57.3 224 0 281.3 0 352s57.3 128 128 128c62.5 0 114.5-44.8 125.8-104l-66.4 0zM128 384a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                </div>
                <div class="flex flex-col justify-between">
                    <p>Total Units</p>
                    <p class="text-2xl font-semibold"><?php echo htmlspecialchars($totalUnits); ?></p>
                </div>
            </div>
            <div class="w-[24%] bg-white shadow-xl p-2 flex gap-2">
                <div class="w-[60px] h-[60px] flex items-center justify-center bg-green-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M512 80c0 18-14.3 34.6-38.4 48c-29.1 16.1-72.5 27.5-122.3 30.9c-3.7-1.8-7.4-3.5-11.3-5C300.6 137.4 248.2 128 192 128c-8.3 0-16.4 .2-24.5 .6l-1.1-.6C142.3 114.6 128 98 128 80c0-44.2 86-80 192-80S512 35.8 512 80zM160.7 161.1c10.2-.7 20.7-1.1 31.3-1.1c62.2 0 117.4 12.3 152.5 31.4C369.3 204.9 384 221.7 384 240c0 4-.7 7.9-2.1 11.7c-4.6 13.2-17 25.3-35 35.5c0 0 0 0 0 0c-.1 .1-.3 .1-.4 .2c0 0 0 0 0 0s0 0 0 0c-.3 .2-.6 .3-.9 .5c-35 19.4-90.8 32-153.6 32c-59.6 0-112.9-11.3-148.2-29.1c-1.9-.9-3.7-1.9-5.5-2.9C14.3 274.6 0 258 0 240c0-34.8 53.4-64.5 128-75.4c10.5-1.5 21.4-2.7 32.7-3.5zM416 240c0-21.9-10.6-39.9-24.1-53.4c28.3-4.4 54.2-11.4 76.2-20.5c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 19.3-16.5 37.1-43.8 50.9c-14.6 7.4-32.4 13.7-52.4 18.5c.1-1.8 .2-3.5 .2-5.3zm-32 96c0 18-14.3 34.6-38.4 48c-1.8 1-3.6 1.9-5.5 2.9C304.9 404.7 251.6 416 192 416c-62.8 0-118.6-12.6-153.6-32C14.3 370.6 0 354 0 336l0-35.4c12.5 10.3 27.6 18.7 43.9 25.5C83.4 342.6 135.8 352 192 352s108.6-9.4 148.1-25.9c7.8-3.2 15.3-6.9 22.4-10.9c6.1-3.4 11.8-7.2 17.2-11.2c1.5-1.1 2.9-2.3 4.3-3.4l0 3.4 0 5.7 0 26.3zm32 0l0-32 0-25.9c19-4.2 36.5-9.5 52.1-16c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 10.5-5 21-14.9 30.9c-16.3 16.3-45 29.7-81.3 38.4c.1-1.7 .2-3.5 .2-5.3zM192 448c56.2 0 108.6-9.4 148.1-25.9c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 44.2-86 80-192 80S0 476.2 0 432l0-35.4c12.5 10.3 27.6 18.7 43.9 25.5C83.4 438.6 135.8 448 192 448z"/></svg>
                </div>
                <div class="flex flex-col justify-between">
                    <p>Total Sales</p>
                    <p class="text-2xl font-semibold">0</p>
                </div>
            </div>
        </div>
        <div class="w-full mt-10 px-8">
            <div class="bg-white rounded-sm p-2 w-1/2 relative">
                <div class="w-full flex items-center justify-center gap-2">
                <h2 class="font-semibold text-lg text-center">Today's Activity</h2>
                <p>-</p>
                <h2 class="text-green-400 font-semibold"><?php echo htmlspecialchars($activitiesData['activity_count']); ?></h2>
                </div>
                <?php if ($activitiesData['activity_count'] > 0): ?>
                    <?php foreach ($activitiesData['activities'] as $activity): ?>
                        <div class="w-full flex items-center mb-2 py-2">
                            <p class="w-1/2"><strong>Name:</strong> <?php echo htmlspecialchars($activity['name']); ?></p>
                            <p class="w-1/2"><strong>Activity:</strong> <?php echo htmlspecialchars($activity['activity']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No activities recorded for today.</p>
                <?php endif; ?>
            </div>
            <!-- Display the activity count -->

            <!-- Display each activity -->
            
                <ul class="mt-4">
                    
                </ul>
        </div>
    </div>
</body>
</html>