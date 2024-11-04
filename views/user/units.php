<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-200 min-h-screen overflow-y-auto text-black-v1">
    <div class="sticky top-0 left-0 z-50 mb-10">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/RGarage/views/components/header.php');
        ?>
    </div>
    <div class="w-[80%] bg-white rounded-md p-7 block mx-auto mb-10">
        <p class="text-black-v1 pb-5 border-b border-black mb-4">UNIT SEARCH</p>
        <form action="" class="w-full mb-8">
            <div class="w-full flex items-center gap-5">
                <input type="text" name="keyword" class="w-1/4 bg-white outline-none border px-4 py-1 border-gray-400 rounded-sm text-gray-500">
                <select name="type" id="type" class="w-1/4 bg-white outline-none border px-4 py-1 border-gray-400 rounded-sm text-gray-700">
                    <option value="" default>TYPE</option>
                    <option value="Scooter">Scooter</option>
                    <option value="Underbone">Underbone</option>
                    <option value="Bigbike">Big Bike</option>
                    <option value="Car">Car</option>
                </select>
                <select name="price" id="type" class="w-1/4 bg-white outline-none border px-4 py-1 border-gray-400 rounded-sm text-gray-700">
                    <option value="" default>PRICE</option>
                    <option value="asc">Low to High</option>
                    <option value="desc">High to Low</option>
                </select>
                <button class="w-1/4 bg-blue-500 outline-none border px-4 py-1 border-gray-400 rounded-sm text-white">SEARCH</button>
            </div>
        </form>
        <div>
            <p class="text-sm text-gray-800">Your search returned 
            <?php
                $count = 0;
                foreach($units as $unit):
                    $count += 1;
                endforeach;
                echo $count;
            
            ?> results</p>
            <!-- <button></button> -->
        </div>
        
    </div>
    <div class="w-[80%] flex items-center gap-4 flex-wrap overflow-hidden mx-auto">
        <!-- foreach -->
        <?php foreach($units as $unit): 
            $imagesString = htmlspecialchars($unit['image']); // Get the image string safely
            $imageNames = explode(',', $imagesString); // Split the string into an array
            $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';
        ?>
        <div class="w-[24%] h-[20%] bg-white rounded-lg mb-6">
            <button onclick="window.location.href='/RGarage/user/unit-detail?unitID=<?php echo htmlspecialchars($unit['id']) ?>'" class="p-2 overflow-hidden">
                <img src="/RGarage/public/images/<?php echo $firstImage ?>" alt="" class=" rounded-tl-lg rounded-tr-lg hover:scale-125 transition duration-175 ease-in-out">
            </button>
            <div class="">
                <p class="w-full bg-white pl-6 mb-1 text-xl font-medium"><?php echo htmlspecialchars($unit['brand']).' '. htmlspecialchars($unit['model']) ?></p>
                <button class="w-full text-left py-4 px-6 bg-blue-500 rounded-bl-lg rounded-br-lg hover:text-yellow-500 transition duration-200 ease-in-out">
                    <p class="font-bold text-2xl">Price: ₱<?php echo htmlspecialchars($unit['price']) ?></p>
                    <p class="text-lg">Model: <?php echo htmlspecialchars($unit['year']) ?></p>
                    <p>Mileage: <?php echo htmlspecialchars($unit['mileage']) ?> km</p>
                </button>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- endforeach -->
    </div>
</body>
</html>