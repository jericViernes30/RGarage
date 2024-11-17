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
                    <button onclick="alert(<?php echo $unit['reserved_id']; ?>)" data-val="<?php echo $unit['reserved_id']; ?>" class="w-full border border-[#c4c4c4] rounded-lg mb-5">
                        <div class="W-full flex h-[200px]">
                            <div class="w-1/4 h-full overflow-hidden p-1">
                                <img src="/RGarage/public/images/<?php echo $unitDetails['image']; ?>" alt="" class="object-cover w-full h-full rounded-md">
                            </div>
                            <div class="w-3/4 px-6 py-8">
                                <div class="w-full flex items-center justify-between">
                                    <p class="text-lg font-semibold uppercase"><?php echo $unitDetails['brand']; ?> <?php echo $unitDetails['model']; ?></p>
                                    <p class="px-4 py-1 rounded-full bg-[#1b1c1e] text-white text-lg font-semibold uppercase">₱<?php echo $unitDetails['shand_price']; ?></p>
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
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>