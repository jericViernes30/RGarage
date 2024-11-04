<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <title>Document</title>
    <style>
    .filter-bluish {
        filter: brightness(0.9) saturate(1.2) hue-rotate(180deg);
    }
</style>
</head>
<body class="bg-gray-200 min-h-screen overflow-y-auto text-black-v1 pb-20">
    <div class="sticky top-0 left-0 z-50">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/RGarage/views/components/header.php');
        ?>
    </div>
    <div class="w-full relative mb-10">
        <img src="/RGarage/public/images/bg-motorcycle.jpeg" alt="" class="h-[150px] filter-bluish">
        <div class="absolute top-10 left-48">
            <p class="text-white text-3xl font-bold">MOTORCYCLE</p>
            <a class="text-yellow-500" href="/RGarage/">Home</a> <span class="text-white">>></span> <a class="text-yellow-500" href="/Rgarage/user/unitsAvailable">Motorcycles</a> <span class="text-white">>></span> <span class="text-white font-medium uppercase"><?php echo htmlspecialchars($unitDetails['brand']). ' ' . htmlspecialchars($unitDetails['model'])?></span>
        </div>
    </div>
    <div class="w-4/5 mx-auto flex gap-2">
        <div class="w-1/4">
            SEARCH
        </div>
        <div class="w-1/2">
            <?php
                if(isset($unitDetails)){ 
                    $imagesString = htmlspecialchars($unitDetails['image']); // Get the image string safely
                    $imageNames = explode(',', $imagesString); // Split the string into an array
                    $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';
                ?>
                <p class="text-2xl font-semibold mb-10"><?php echo htmlspecialchars($unitDetails['brand']) . ' ' .htmlspecialchars($unitDetails['model']) ?></p>
                <img id="image" src="/RGarage/public/images/<?php echo $firstImage; ?>" alt="" class="w-[80%] mb-10">
                <p>Snapshots:</p>
                <div class="flex items-center gap-4 mb-10">
                    <?php foreach ($imageNames as $imageName): ?>
                        <button class="w-[12%]" data-beat="<?php echo trim($imageName); ?>">
                            <img src="/RGarage/public/images/<?php echo trim($imageName); ?>" alt="<?php echo ucfirst(trim($imageName)); ?>" class="w-full">
                        </button>
                    <?php endforeach; ?>
                </div>
                <p class="text-md uppercase font-semibold mb-10 text-black-v1"><?php echo htmlspecialchars($unitDetails['model']) ?></p>
                <p>The All-New BeAT is now here to bring colorful, fun, and exciting rides on the road like never before.</p>
                <br>
                <p class="mb-8">Boost the fun and embark on your spectacular adventure with its Premium Variants comes in Pearl Arctic White and Matte Axis Gray Metallic, while the Playful Variants are available in Fighting Red, Pearl Sylvestris Gray, Pearl Nightfall Blue, and Clipper Yellow.</p>
                <button class="w-full border border-blue-500 rounded-sm py-2 font-semibold text-blue-500 hover:bg-blue-500 hover:text-white transition duration-100 ease-in-out">Inquire about this Unit</button>
            <?php
                }
            ?>
        </div>
        <div class="w-1/4 p-6">
            <div class="mb-10">
                <p class="font-bold text-lg mb-1">Brand New Price: ₱73,400</p>
                <p class="font-semibold">Second Hand Price: ₱<?php echo htmlspecialchars($unitDetails['price']) ?></p>
            </div>

            <p class="font-medium mb-2">SPECIFICATIONS:</p>
            <div class="w-full">
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Brand</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['brand']) ?></p>
                </div>
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Model</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['model']) ?></p>
                </div>
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Year</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['year']) ?></p>
                </div>
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Mileage</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['mileage']) ?> km</p>
                </div>
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Plate Number</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['plate_number']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Handle button clicks
            $('.flex button').on('click', function() {
                // Get the data-beat attribute value
                var beatImage = $(this).data('beat');
                // Update the src of the #image element
                $('#image').attr('src', '/RGarage/public/images/' + beatImage);
            });
        });
    </script>
</body>
</html>