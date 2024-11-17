<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user']);
?>
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
<body id="body" class="bg-gray-200 min-h-screen overflow-y-auto text-black-v1 pb-20">
    <div id="coverup" class="hidden bg-[#22222273] absolute top-0 w-full z-10 inset-0"></div>
    <div id="date_div" class="hidden w-1/4 h-fit absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/4 rounded-xl z-20">
        <div class="w-full flex items-center justify-between px-6 py-2 rounded-tr-xl rounded-tl-xl bg-blue-500 text-white">
            <p>Select Date</p>
            <button type="button" id="closeDiv">
                x
            </button>
        </div>
        <div class="w-full px-6 py-4 rounded-br-xl rounded-bl-xl bg-white">
            <form action="/RGarage/user/reserve-unit" method="POST">
                <input type="date" name="reserved_date" class="bg-white p-2 outline-none border border-gray-400 block mx-auto">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>">
                <input type="hidden" name="unit_id" value="<?php echo $unitDetails['id'] ?>" class="bg-white">
                <p id="availability-text" class="text-xs text-green-500 text-center mb-5">Date available!</p>
                <button type="submit" id="reserve-btn" class="w-full py-2 bg-white border-2 border-blue-500 rounded-lg text-blue-500 hover:bg-blue-500 hover:text-white">Reserve</button>
            </form>
        </div>
    </div>
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
            <p class="mb-10 font-semibold">SEARCH</p>
            <div class="w-full flex flex-col gap-2 mb-10">
                <a href="/RGarage/user/honda" class="text-blue-500">Honda</a>
                <a href="/RGarage/user/kawasaki" class="text-blue-500">Kawasaki</a>
                <a href="/RGarage/user/yamaha" class="text-blue-500">Yamaha</a>
                <a href="/RGarage/user/suzuki" class="text-blue-500">Suzuki</a>
            </div>
            <div class="w-full">
                <h3 class="text-lg font-semibold mb-3">Reserved Dates:</h3>
                <?php if (!empty($reservedDetails)) : ?>
                    <?php foreach ($reservedDetails as $date) : ?>
                        <?php
                        // Create a DateTime object and format it as "Month Day, Year"
                        $formattedDate = date("F j, Y", strtotime($date));
                        ?>
                        <p class="text-gray-700 mb-1"><?php echo htmlspecialchars($formattedDate); ?></p>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-gray-500">No reservations for this unit.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="w-1/2">
            <?php
                if(isset($unitDetails)){ 
                    $imagesString = htmlspecialchars($unitDetails['image']); // Get the image string safely
                    $imageNames = explode(',', $imagesString); // Split the string into an array
                    $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';
                ?>
                <p id="unit" class="text-2xl font-semibold mb-10"><?php echo htmlspecialchars($unitDetails['brand']) . ' ' .htmlspecialchars($unitDetails['model']) ?></p>
                <img id="image" src="/RGarage/public/images/<?php echo $firstImage; ?>" alt="" class="w-[80%] mb-10 block mx-auto">
                <p>Snapshots:</p>
                <div class="snapshots flex items-center gap-4 mb-10">
                    <?php foreach ($imageNames as $imageName): ?>
                        <button type="button" class="w-[12%]" data-beat="<?php echo trim($imageName); ?>">
                            <img src="/RGarage/public/images/<?php echo trim($imageName); ?>" alt="<?php echo ucfirst(trim($imageName)); ?>" class="w-full">
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php
                }
            ?>
            
            <button type="button" 
                    id="reserve" 
                    class="w-full <?php echo $isLoggedIn ? 'bg-blue-500 hover:bg-blue-500' : 'bg-gray-400'; ?> mb-2 text-white rounded-sm py-2 font-semibold transition duration-100 ease-in-out" 
                    <?php echo $isLoggedIn ? '' : 'disabled'; ?>>
                Reserve this Unit
            </button>

            <button 
                type="button" 
                id="inquire" 
                class="w-full rounded-sm py-2 font-semibold 
                <?php echo $isLoggedIn 
                    ? 'border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white transition duration-100 ease-in-out bg-gray-200' 
                    : 'bg-gray-400 disabled cursor-not-allowed'; 
                ?>"
                <?php echo !$isLoggedIn ? 'disabled' : ''; ?>>
                <?php echo $isLoggedIn ? 'Inquire about this Unit' : 'Please login first'; ?>
            </button>

        </div>
        <div class="w-1/4 p-6">
            <div class="mb-10">
                <p class="font-bold text-lg mb-1">Brand New Price: <?php echo htmlspecialchars($unitDetails['price']) ?></p>
                <p class="font-semibold">Second Hand Price: ₱<?php echo htmlspecialchars($unitDetails['shand_price']) ?></p>
            </div>

            <p class="font-medium mb-2">SPECIFICATIONS:</p>
            <div class="w-full">
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Type</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['id']) ?></p>
                </div>
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
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Tire Thread</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['thread']) ?> / 10</p>
                </div>
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Status</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['modified']) ?></p>
                </div>
                <div class="w-full flex items-center text-sm mb-1">
                    <p class="w-1/2 text-blue-800 font-semibold">Issue</p>
                    <p class="w-1/2"><?php echo htmlspecialchars($unitDetails['issue']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Handle button clicks
            $('.snapshots button').on('click', function() {
                // Get the data-beat attribute value
                var beatImage = $(this).data('beat');
                // Update the src of the #image element
                $('#image').attr('src', '/RGarage/public/images/' + beatImage);
            });

            $('#inquire').on('click', function () {
                // Check if the button is disabled
                if ($(this).prop('disabled')) {
                    alert("Please log in to inquire about this unit."); // Optional: Alert message
                    return; // Exit the function if the button is disabled
                }

                // Proceed if the button is not disabled
                $('#messageDiv').removeClass('hidden');
                var unit = $('#unit').text();
                $('#messageInput').val("I'm inquiring about " + unit);
            });


            $('#reserve').on('click', function(){
                // Show the hidden elements
                $('#date_div').removeClass('hidden');
                $('#coverup').removeClass('hidden');
                
                // Scroll to the top of the page
                $('html, body').animate({ scrollTop: 0 }, 'fast');
            });

            $('#closeDiv').on('click', function(){
                $('#date_div').addClass('hidden')
                $('#coverup').addClass('hidden');
            })

            var invalid_dates = <?php echo json_encode($reservedDetails); ?>;

            // Get today's date in YYYY-MM-DD format
            var today = new Date();
            var formattedToday = today.toISOString().split('T')[0];  // Format the date to YYYY-MM-DD

            $('input[type="date"]').on('change', function() {
                var selected_date = $(this).val();  // Get selected date in YYYY-MM-DD format

                // Check if the selected date is in the array of invalid dates or in the past
                if (invalid_dates.includes(selected_date) || selected_date < formattedToday) {
                    // If the date is invalid or in the past
                    $('#availability-text').text('Date not available!').removeClass('text-green-500').addClass('text-red-500');
                    $('#reserve-btn').prop('disabled', true).css('cursor', 'not-allowed').removeClass('hover:bg-blue-500 hover:text-white').addClass('bg-gray-300 border-gray-400 text-gray-500');
                } else {
                    // If the date is valid and in the future
                    $('#availability-text').text('Date available!').removeClass('text-red-500').addClass('text-green-500');
                    $('#reserve-btn').prop('disabled', false).css('cursor', 'pointer').removeClass('bg-gray-300 border-gray-400 text-gray-500').addClass('bg-white border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white');
                }
            });
        });
    </script>
</body>
</html>