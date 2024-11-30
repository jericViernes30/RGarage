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
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
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
    <div id="rate" class="hidden w-1/4 absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 transform h-fit rounded-xl bg-white z-20">
        <div class="w-full flex items-center justify-between px-6 py-2 rounded-tr-xl rounded-tl-xl bg-black-v1 text-white">
            <p>Rate Experience</p>
            <button type="button" id="closeDiv">
                x
            </button>
        </div>
        <div class="w-full px-6 py-4 rounded-br-xl rounded-bl-xl bg-white">
            <p id="note" class="text-center text-black-1 font-bold text-lg mb-6">Please rate us!</p>
            <div class="w-full flex items-center justify-center gap-2">
                <input id="id_rate" type="hidden" name="id" value="0" class="bg-white">
                <button id="star" class="w-1/5 h-fit">
                    <svg id="svg1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#D1D5DB" width="50" height="50">
                        <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                </button>
                <button id="star" class="w-1/5 h-fit">
                    <svg id="svg2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#D1D5DB" width="50" height="50">
                        <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                </button>
                <button id="star" class="w-1/5 h-fit">
                    <svg id="svg3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#D1D5DB" width="50" height="50">
                        <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                </button>
                <button id="star" class="w-1/5 h-fit">
                    <svg id="svg4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#D1D5DB" width="50" height="50">
                        <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                </button>
                <button id="star" class="w-1/5 h-fit">
                    <svg id="svg5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#D1D5DB" width="50" height="50">
                        <path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="sticky top-0 left-0 z-50">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/RGarage/views/components/header.php');
        ?>
    </div>
    <div class="w-full relative mb-6">
        <img src="/RGarage/public/images/bg-motorcycle.jpeg" alt="" class="h-[150px] filter-bluish">
        <div class="absolute top-10 left-[147px]">
            <p class="text-white text-3xl font-bold">RESERVED UNITS</p>
            <a class="text-yellow-500" href="/RGarage/">Home</a> <span class="text-white">>></span> <a class="text-yellow-500" href="/Rgarage/user/unitsAvailable">Reserved Units</a>
        </div>
    </div>
    <div class="w-full relative mb-10">
    </div>
    <div class="w-4/5 block mx-auto">
        <div class="w-full flex gap-6">
            <div class="w-1/4">
                <div class="w-full py-5">
                    <p class="uppercase text-lg font-semibold">SEARCH OPTIONS</p>
                    <p class="uppercase font-light">Find your motorcycle</p>
                </div>
                <div>
                    <select name="brand" id="" class="outline-none bg-gray-200 w-full py-2 px-6 rounded-sm border border-[#c4c4c4]">
                        <option disabled selected value="" class="w-full py-4 bg-gray-200">BRAND</option>
                        <option value="">HONDA</option>
                        <option value="">YAMAHA</option>
                        <option value="">KAWASAKI</option>
                    </select>
                </div>
            </div>
            <div class="w-3/4">
                <?php foreach ($units as $unit): ?>
                    <?php $unitDetails = $unit['unit_details']; ?>
                    <div class="w-full border border-[#c4c4c4] rounded-lg mb-5">
                        <div class="W-full flex h-[200px]">
                            <div class="w-1/4 h-full overflow-hidden p-1">
                                <img src="/RGarage/public/images/<?php echo $unitDetails['image']; ?>" alt="" class="object-cover w-full h-full rounded-md">
                            </div>
                            <div class="w-3/4 px-6 py-8">
                                <div class="w-full flex items-center justify-between">
                                    <p class="w-1/2 text-left text-lg font-semibold uppercase"><?php echo $unitDetails['brand']; ?> <?php echo $unitDetails['model']; ?></p>
                                    <div class="w-1/2 flex flex-col items-end justify-end">
                                        <?php if ($unit['reserve_status'] === 'Completed' && $unit['rating'] != 0) : ?>
                                            <p class="w-1/2 px-4 py-1 rounded-full bg-yellow-300 text-black-v1 text-md font-semibold uppercase text-center">
                                                Rate: <?php echo htmlspecialchars($unit['rating']); ?> stars
                                            </p>
                                        <?php elseif ($unit['reserve_status'] === 'Completed' && $unit['rating'] == 0) : ?>
                                            <button type="button" id="rateBtn" data-val="<?php echo $unit['reserved_id']; ?>" class="w-1/2 px-6 py-1 rounded-full text-md bg-yellow-300 font-semibold uppercase">Rate</button>
                                        <?php else : ?>
                                            <p class="w-1/2 px-4 py-1 rounded-full bg-[#1b1c1e] text-white text-md font-semibold uppercase text-center">
                                                <?php echo htmlspecialchars($unit['reserve_status']); ?>
                                            </p>
                                        <?php endif; ?>

                                        <div>
                                            <?php
                                                if($unit['reserve_status'] == 'Pending'){
                                                    echo '<p class="text-center text-xs font-bold">Visit: '.$unit['reserved_date'].'</p>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="uppercase text-left text-xs mb-10">Category: <?php echo $unitDetails['type']; ?></p>
                                <div class="w-full flex">
                                    <div class="w-[10%] text-left border-r border-[#c4c4c4]">
                                        <p class="font-semibold">YEAR</p>
                                        <p class="font-light text-sm text-[#333]"><?php echo $unitDetails['year']; ?></p>
                                    </div>
                                    <div class="w-[15%] text-center border-r border-[#c4c4c4]">
                                        <p class="font-semibold">MAKE</p>
                                        <p class="font-light text-sm text-[#333]"><?php echo $unitDetails['brand']; ?></p>
                                    </div>
                                    <div class="w-[15%] text-center border-r border-[#c4c4c4]">
                                        <p class="font-semibold">TYPE</p>
                                        <p class="font-light text-sm text-[#333]"><?php echo $unitDetails['type']; ?></p>
                                    </div>
                                    <div class="w-[28%] text-center">
                                        <p class="font-semibold">TRANSMISSION</p>
                                        <p class="font-light text-sm text-[#333]">
                                            <?php echo $unitDetails['type'] === 'scooter' ? 'Automatic' : 'Manual'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<script>
    let selectedRating = 0;

    // Update the star colors based on the selected rating
    function updateStars(rating) {
        // Loop through all 5 stars and update their fill color
        for (let i = 1; i <= 5; i++) {
            const svg = document.getElementById('svg' + i);
            if (i <= rating) {
                svg.style.fill = '#FBBF24'; // Yellow color
            } else {
                svg.style.fill = '#D1D5DB'; // Gray color
            }
        }
        console.log(`Rating selected: ${selectedRating}`);
    }

    $(document).ready(function() {
        $('#rateBtn').on('click', function(){
            const id = $(this).data('val')
            $('#id_rate').val(id)
            $('#rate').removeClass('hidden')
            $('#coverup').removeClass('hidden')
        })


        // Handle click event on each star (using IDs like #star1, #star2, etc.)
        $("[id^='star']").click(function() { // Select elements with IDs starting with 'star'
            selectedRating = $(this).index(); // 1-based index (index starts from 0)
            const id = $('#id_rate').val()
            alert(id)
            updateStars(selectedRating); // Update the stars' colors
            alert(`Rating selected: ${selectedRating}`); // Show rating for debugging

            $.ajax({
                url: '/RGarage/user/rate',
                method: 'POST',
                data: {id: id, rate: selectedRating},
                success: function(response){
                    $('#note').text('Thank you!')

                    setTimeout(function() {
                        location.reload()
                    }, 2000); // 1000 milliseconds = 1 second

                },
                error: function(xhr, status, error){
                    console.log(error)
                }
            })
        });
    });
</script>


</body>
</html>