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
<body class="w-full bg-gray-200 min-h-screen overflow-y-auto text-black-v1">
    <div class="sticky top-0 left-0 z-50">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/RGarage/views/components/header.php');
        ?>
    </div>
    <div class="w-full relative mb-10 mx-auto block">
        <img src="/RGarage/public/images/v2-SUZUKI.jpg" alt="" class="h-[150px] filter-bluish w-full">
        <div class="absolute top-10 left-40">
            <p class="text-black text-3xl font-bold">MOTORCYCLES</p>
            <a class="text-black" href="/RGarage/">Home</a> <span class="text-black">>></span> <a class="text-black" href="/Rgarage/user/unitsAvailable">Motorcycles</a><span class="text-black">>></span> <span class="text-black text-sm font-medium uppercase">suzuki</span>
        </div>
    </div>
    <div class="w-[80%] bg-white rounded-md p-7 block mx-auto mb-10">
        <p class="text-black-v1 pb-5 border-b border-black mb-4">UNIT SEARCH</p>
        <div class="w-full mb-8">
            <div class="w-full flex items-center gap-5">
                <input id="livesearch" type="text" name="keyword" class="w-1/4 bg-white outline-none border px-4 py-1 border-gray-400 rounded-sm text-gray-500">
                <select name="type" id="type" class="w-1/4 bg-white outline-none border px-4 py-1 border-gray-400 rounded-sm text-gray-700">
                    <option value="" disabled>TYPE</option>
                    <option value="scooter" selected>Scooter</option>
                    <option value="underbone">Underbone</option>
                    <option value="bigbike">Big Bike</option>
                </select>
                <select name="price" id="price" class="w-1/4 bg-white outline-none border px-4 py-1 border-gray-400 rounded-sm text-gray-700">
                    <option value="" disabled>PRICE</option>
                    <option value="asc" selected>Low to High</option>
                    <option value="desc">High to Low</option>
                </select>
                <button type="button" id="search" class="w-1/4 bg-blue-500 outline-none border px-4 py-1 border-gray-400 rounded-sm text-white">SEARCH</button>
            </div>
        </div>
        <div>
            <p id="result_count" class="text-sm text-gray-800">Your search returned 
            <?php
                $count = 0;
                foreach($units as $unit):
                    $count += 1;
                endforeach;
                echo $count;
            
            ?> results</p>
        </div>
        
    </div>
    <div id="livesearch-results" class="w-[80%] flex items-center gap-4 flex-wrap overflow-hidden mx-auto">
        <!-- foreach -->
        <?php foreach($units as $unit): 
            $imagesString = htmlspecialchars($unit['image']); // Get the image string safely
            $imageNames = explode(',', $imagesString); // Split the string into an array
            $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';
        ?>
        <div id="result" class="w-[24%] h-[20%] bg-white rounded-lg mb-6">
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
    <script>
        $(document).ready(function() {
    let searchTimeout;

    $('#livesearch').off('keyup').on('keyup', function() {
        clearTimeout(searchTimeout); // Clear previous timer
        var key = $(this).val().trim(); // Trim to avoid empty spaces

        // Set debounce delay
        searchTimeout = setTimeout(function() {
            $.ajax({
                type: 'GET', // Change to GET if it's a read operation
                url: '/RGarage/user/livesearch-suzuki',
                data: { key: key },
                dataType: 'json',
                success: function(response) {
                    $('#livesearch-results').empty(); // Clear previous results

                    // Update result count text
                    if (response.status === 'success') {
                        $('#result_count').text('Your search returned ' + response.count + ' results');

                        // Check if data was returned
                        if (response.data.length > 0) {
                            // Loop through each unit in the response data
                            response.data.forEach(function(unit) {
                                var imageNames = unit.image ? unit.image.split(',') : [];
                                var firstImage = imageNames.length > 0 ? imageNames[0].trim() : '';

                                var unitHtml = `
                                    <div id="result" class="w-[24%] h-[20%] bg-white rounded-lg mb-6">
                                        <button onclick="window.location.href='/RGarage/user/unit-detail?unitID=${unit.id}'" class="p-2 overflow-hidden h-[250px] w-full">
                                            <img src="/RGarage/public/images/${firstImage}" alt="" class="rounded-tl-lg rounded-tr-lg hover:scale-125 transition duration-175 ease-in-out h-full w-full object-cover">
                                        </button>
                                        <div>
                                            <p class="w-full bg-white pl-6 mb-1 text-xl font-medium">${unit.brand} ${unit.model}</p>
                                            <button class="w-full text-left py-4 px-6 bg-blue-500 rounded-bl-lg rounded-br-lg hover:text-yellow-500 transition duration-200 ease-in-out">
                                                <p class="font-bold text-2xl">Price: ₱${unit.price}</p>
                                                <p class="text-lg">Model: ${unit.year}</p>
                                                <p>Mileage: ${unit.mileage} km</p>
                                            </button>
                                        </div>
                                    </div>
                                `;
                                $('#livesearch-results').append(unitHtml);
                            });
                        } else {
                            $('#livesearch-results').html('<p>No units found.</p>');
                        }
                    } else {
                        $('#livesearch-results').html('<p>No units found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('#livesearch-results').html('<p>An error occurred while searching. Please try again.</p>');
                }
            });
        }, 300); // Set debounce delay to 300 ms
    });


    $('#search').on('click', function() {
    var selectedType = $('#type').val();
    var selectedPrice = $('#price').val();

    // Validate the inputs (e.g., empty string check)
    if (!selectedType && !selectedPrice) {
        alert("Please select a filter option.");
        return;  // Stop execution if no filter is selected
    }

    $.ajax({
        method: 'GET',
        url: '/RGarage/user/filter-suzuki', // Update with actual path to controller
        data: { type: selectedType, price: selectedPrice},
        dataType: 'json',
        success: function(response) {
            console.log(response);
            $('#livesearch-results').empty(); // Clear previous results
            $('#result_count').text('Your search returned ' + response.count + ' results');
            // Check if data was returned
            if (response.data.length > 0) {
                // Loop through each unit in the response data
                response.data.forEach(function(unit) {
                    var imageNames = unit.image ? unit.image.split(',') : [];
                    var firstImage = imageNames.length > 0 ? imageNames[0].trim() : '';

                    var unitHtml = `
                        <div id="result" class="w-[24%] h-[20%] bg-white rounded-lg mb-6">
                            <button onclick="window.location.href='/RGarage/user/unit-detail?unitID=${unit.id}'" class="p-2 overflow-hidden h-[250px] w-full">
                                <img src="/RGarage/public/images/${firstImage}" alt="" class="rounded-tl-lg rounded-tr-lg hover:scale-125 transition duration-175 ease-in-out h-full w-full object-cover">
                            </button>
                            <div>
                                <p class="w-full bg-white pl-6 mb-1 text-xl font-medium">${unit.brand} ${unit.model}</p>
                                <button class="w-full text-left py-4 px-6 bg-blue-500 rounded-bl-lg rounded-br-lg hover:text-yellow-500 transition duration-200 ease-in-out">
                                    <p class="font-bold text-2xl">Price: ₱${unit.price}</p>
                                    <p class="text-lg">Model: ${unit.year}</p>
                                    <p>Mileage: ${unit.mileage} km</p>
                                </button>
                            </div>
                        </div>
                    `;
                    $('#livesearch-results').append(unitHtml);
                });
            } else {
                $('#livesearch-results').html('<p>No units found.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#livesearch-results').html('<p>An error occurred. Please try again.</p>');
        }
    });
});

});


    </script>
</body>
</html>