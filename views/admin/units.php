<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body class="w-full flex h-screen bg-gray-200 text-black-v1 relative">
    <div id="overlay" class="hidden w-full h-screen absolute top-0 bg-black opacity-80"></div>
    <div id="sales" class="hidden w-1/2 h-fit absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <div class="py-2 px-6 flex items-center justify-between bg-[#1b1c1e] rounded-tr-lg rounded-tl-lg">
            <p class="text-white">Unit Sales</p>
            <button type="button" id="closeForm" class="text-white">x</button>
        </div>
        <div class="w-full h-fit p-6 bg-white relative">
            <div id="or_form" class="hidden w-1/3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="py-2 px-4 flex items-center justify-between bg-[#1b1c1e] rounded-tr-lg rounded-tl-lg">
                    <p class="text-white">Official Receipt</p>
                    <button type="button" id="closeForm" class="text-white">x</button>
                </div>
                <div class="w-full h-fit p-4 bg-white rounded-br-lg rounded-bl-lg">
                    <form action="/RGarage/admin/walk-in-sold" method="POST">
                        <p class="text-xs mb-1">OR Number</p>
                        <input id="input_customer" type="hidden" name="customer" class="bg-white">
                        <input id="input_pay" type="hidden" name="pay" class="bg-white">
                        <input id="input_contact_number" type="hidden" name="contact_number" class="bg-white">
                        <input id="input_email_address" type="hidden" name="email_address" class="bg-white">
                        <input id="input_unit" type="hidden" name="unit">
                        <input id="input_plateNumber" type="text" name="plateNumber" class="bg-white">
                        <input type="text" name="or_number" class="w-full px-3 py-2 rounded-md outline-none border border-gray-600 bg-white mb-4">
                        <button class="bg-blue-500 w-full py-2 rounded-md text-white font-bold text-sm">SOLD</button>
                    </form>
                </div>
            </div>
            <div id="order_details" class="w-full flex gap-2 z-0">
                <div class="w-2/5 border border-gray-400 rounded-lg px-4">
                    <p class="text-center font-medium mb-3 text-lg mt-2">Billing Details</p>
                    <div class="w-[120px] h-[120px] rounded-sm block mx-auto border-2 mb-6">
                        <img src="/RGarage/public/images/beat_2.jpg" alt="" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Billed To</p>
                        <input type="text" name="billed_to" id="billed_to" class="w-full text-xl font-bold bg-white outline-none rounded-md px-4 py-1 border border-gray-600">
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Amount To Pay</p>
                        <p id="to_pay" class="text-xl font-bold"></p>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Contact Number</p>
                        <input type="text" name="contact" id="contact" class="w-full text-xl font-bold bg-white outline-none rounded-md px-4 py-1 border border-gray-600">
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Email Address</p>
                        <input type="text" name="email" id="email" class="w-full text-xl font-bold bg-white outline-none rounded-md px-4 py-1 border border-gray-600">
                    </div>
                </div>
                <div class="w-3/5 border border-gray-400 rounded-lg px-4">
                    <p class="text-center font-medium mb-3 text-lg mt-2">Selected Unit</p>
                    <div class="w-[220px] h-[220px] rounded-sm block mx-auto border-2 mb-6">
                        <img id="unit_image" src="/RGarage/public/images/beat_2.jpg" alt="" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="w-3/4 justify-between flex mx-auto mb-10">
                        <div class="text-center">
                            <p class="font-semibold">YEAR</p>
                            <p id="bill_year" class="font-light text-sm text-[#333]">2000</p>
                        </div>
                        <div class=" text-center">
                            <p class="font-semibold">BRAND</p>
                            <p id="bill_brand" class="font-light text-sm text-[#333]">Honda</p>
                        </div>
                        <div class=" text-center">
                            <p class="font-semibold">MODEL</p>
                            <p id="bill_model" class="font-light text-sm text-[#333]">Beat</p>
                        </div>
                    </div>
                    <div>
                        <button type="button" id="confirm" class="w-full bg-blue-500 text-white rounded-lg py-2 mb-3">Confirm Purchase</button>
                        <button class="text-red-500 py-2 text-center px-6 block mx-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_form" class="hidden w-1/2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white">
        <div class="py-2 px-6 flex items-center justify-between bg-blue-500 rounded-tr-lg rounded-tl-lg">
            <p class="text-white">Edit Unit Details</p>
            <button type="button" id="closeEditForm" class="text-white">x</button>
        </div>
        <div>
            <form action="/RGarage/admin/edit-unit" method="POST" class="p-6 flex flex-col bg-white" enctype="multipart/form-data">
                <div class="w-full flex gap-3 mb-4">
                    <div class="w-1/5 flex flex-col gap-1">
                        <label for="">Year</label>
                        <input type="text" name="year" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-1/4 flex flex-col gap-1">
                        <label for="">Brand</label>
                        <input type="text" name="brand" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-1/5 flex flex-col gap-1">
                        <label for="">Model</label>
                        <input type="text" name="model" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[38%] bg-white flex flex-col gap-1">
                        <label for="">Type</label>
                        <select name="type" id="" class="outline-none py-2 px-4 border border-gray-400 rounded-md bg-white">
                            <option value="scooter">Scooter</option>
                            <option value="underbone">Underbone</option>
                            <option value="bigbike">Big bike</option>
                            <option value="car">Car</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="w-full flex items-center justify-between gap-3 my-4 mb-4">
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Plate Number</label>
                        <input type="text" name="plate_number" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Mileage</label>
                        <input type="text" name="mileage" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Second Hand Price</label>
                        <input type="text" name="shand_price" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Brand New Price</label>
                        <input type="text" name="bnew_price" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                </div>
                <hr>
                <div class="w-full my-4">
                    <div class="w-full mb-4 flex items-center gap-4 justify-between">
                        <div class="w-1/3 flex items-center gap-10">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="stock" 
                                    class="form-radio text-green-500 bg-white checked:bg-green-500 focus:ring-0"/>
                                <span class="ml-2">Stock</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="modified" 
                                    class="form-radio text-green-500 bg-white checked:bg-green-500 focus:ring-0"/>
                                <span class="ml-2">Modified</span>
                            </label>
                        </div>
                        <div class="w-1/3 flex flex-col">
                            <label for="">Tire's Thread</label>
                            <input type="text" name="thread" placeholder="Rate: 1-10" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                        </div>
                        <div class="w-1/3 flex flex-col">
                            <label for="">Unit's Color</label>
                            <input type="text" name="color" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                        </div>
                    </div>
                    <label for="">Unit's Issue</label>
                    <textarea name="issue" id="" rows="5" class="w-full bg-white outline-none border border-gray-400 px-4 py-1 rounded-md"></textarea>
                </div>
                <div class="w-full flex items-center gap-4">
                    <input type="hidden" name="id">
                    <button type="submit" class="w-1/6 bg-blue-500 px-10 py-2 text-white text-sm rounded-md ">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div id="form" class="hidden w-1/2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white">
        <div class="py-2 px-6 flex items-center justify-between bg-[#1b1c1e] rounded-tr-lg rounded-tl-lg">
            <p class="text-white">Add Unit Form</p>
            <button type="button" id="closeForm" class="text-white">x</button>
        </div>
        <div>
            <form action="/RGarage/admin/add-unit" method="POST" class="p-6 flex flex-col bg-white" enctype="multipart/form-data">
                <div class="w-full flex gap-3 mb-4">
                    <div class="w-1/5 flex flex-col gap-1">
                        <label for="">Year</label>
                        <input type="text" name="year" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-1/4 flex flex-col gap-1">
                        <label for="">Brand</label>
                        <input type="text" name="brand" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-1/5 flex flex-col gap-1">
                        <label for="">Model</label>
                        <input type="text" name="model" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[38%] bg-white flex flex-col gap-1">
                        <label for="">Type</label>
                        <select name="type" id="" class="outline-none py-2 px-4 border border-gray-400 rounded-md bg-white">
                            <option value="scooter">Scooter</option>
                            <option value="underbone">Underbone</option>
                            <option value="bigbike">Big bike</option>
                            <option value="car">Car</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="w-full flex items-center justify-between gap-3 my-4 mb-4">
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Plate Number</label>
                        <input type="text" name="plate_number" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Mileage</label>
                        <input type="text" name="mileage" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Second Hand Price</label>
                        <input type="text" name="shand_price" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-[23%] flex flex-col gap-1">
                        <label for="">Brand New Price</label>
                        <input type="text" name="bnew_price" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                </div>
                <hr>
                <div class="w-full my-4">
                    <div class="w-full mb-4 flex items-center gap-4 justify-between">
                        <div class="w-1/3 flex items-center gap-10">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="stock" 
                                    class="form-radio text-green-500 bg-white checked:bg-green-500 focus:ring-0"/>
                                <span class="ml-2">Stock</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="modified" 
                                    class="form-radio text-green-500 bg-white checked:bg-green-500 focus:ring-0"/>
                                <span class="ml-2">Modified</span>
                            </label>
                        </div>
                        <div class="w-1/3 flex flex-col">
                            <label for="">Tire's Thread</label>
                            <input type="text" name="thread" placeholder="Rate: 1-10" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                        </div>
                        <div class="w-1/3 flex flex-col">
                            <label for="">Unit's Color</label>
                            <input type="text" name="color" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                        </div>
                    </div>
                    <label for="">Unit's Issue</label>
                    <textarea name="issue" id="" rows="5" class="w-full bg-white outline-none border border-gray-400 px-4 py-1 rounded-md"></textarea>
                </div>
                <div class="w-full flex items-center gap-4">
                    <button type="submit" class="w-1/6 bg-[#1b1c1e] px-10 py-2 text-white text-sm rounded-md ">Add</button>
                    <input type="file" name="images[]" class="bg-white text-sm" accept=".jpg" multiple required>
                </div>
            </form>
        </div>
    </div>
    <div class="w-[16%] bg-gray-700">
        <p class="text-white px-5 py-3 mb-6 bg-[#1b1c1e]">RGarage.</p>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="bg-[#1b1c1e] py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/reserved-units" class="py-2 px-5 text-white w-full">Reserved Units</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">Messages</a>
            <a href="/RGarage/admin/history" class="py-2 px-5 text-white w-full">History</a>
        </div>
    </div>
    <div class="w-[84%]">
        <div class="w-full py-3 flex justify-between bg-white shadow-xl">
            <div class="flex items-center gap-8 pl-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="23" height="23" fill="#000">
                    <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/>
                </svg>
                <p class="pt-[2px] text-gray-400 text-sm">RGarage: Pre-owned Motorcycles Dealership System - Admin</p>
            </div>
            <div class="px-16 flex items-center">
                <p class="text-black-v1">Administrator Admin</p>
            </div>
        </div>
        <div class="p-8 w-full">
            <div class="bg-white w-full p-5 rounded-lg border-2 border-gray-300 border-t-4 border-t-[#1b1c1e]">
                <div class="w-full flex justify-between border-b border-gray-300 mb-4 pb-3">
                    <p class="text-lg text-black-v1">List of Units</p>
                    <button id="add_unit" type="button" class="bg-[#1b1c1e] py-2 px-6 text-white text-sm rounded-md">Add Unit</button>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <p class="text-sm">Search:</p>
                        <input id="livesearch" type="text" name="search" class="w-[20%] bg-white border border-gray-300 py-1 px-4">
                    </div>
                    <div>
                        <table class="w-full table-auto border border-gray-400">
                            <thead>
                                <tr class="text-sm border-b-4 text-left">
                                    <th class="w-[5%] border-r border-gray-300 py-3 pl-2">#</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Plate Number</th>
                                    <th class="w-[10%] border-r border-gray-300 px-2 hover:bg-gray-300">
                                        <button id="year" class="w-full flex items-center justify-between">
                                            <p>Year</p>
                                            <div class="w-fit relative h-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15" class="absolute -top-3 right-0 "><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8l256 0c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15" class="absolute right-0 -top-1"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg>
                                            </div>
                                            
                                        </button>
                                    </th>
                                    <th class="w-[15%] border-r border-gray-300 px-2 hover:bg-gray-300">
                                        <button id="brand" class="w-full flex items-center justify-between">
                                            <p>Brand</p>
                                            <div class="w-fit relative h-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15" class="absolute -top-3 right-0 "><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8l256 0c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15" class="absolute right-0 -top-1"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg>
                                            </div>
                                            
                                        </button>
                                    </th>
                                    <th class="w-[30%] border-r border-gray-300 pl-2">Model</th>
                                    <th class="w-[15%] border-r border-gray-300 px-2 hover:bg-gray-300">
                                        <button id="price" class="w-full flex items-center justify-between">
                                            <p>Price</p>
                                            <div class="w-fit relative h-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15" class="absolute -top-3 right-0 "><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8l256 0c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15" class="absolute right-0 -top-1"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg>
                                            </div>
                                            
                                        </button>
                                    </th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="units-table-body">
                                <?php if (isset($units) && !empty($units)): ?>
                                    <?php foreach ($units as $index => $unit): 
                                        $imagesString = htmlspecialchars($unit['image']); // Get the image string safely
                                        $imageNames = explode(',', $imagesString); // Split the string into an array
                                        $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : ''; // First image or empty string
                                        ?>
                                        <tr>
                                            <td class="py-3 border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($index + 1); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['plate_number']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['year']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['brand']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['model']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars(number_format(str_replace(',', '', $unit['shand_price']), 2)); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2">
                                                <select name="action" id="action_select" class="block py-1 bg-white border rounded-sm outline-none text-center w-4/5 mx-auto">
                                                    <option value="" disabled selected>Options</option>
                                                    <option value="sale"
                                                        data-year="<?php echo htmlspecialchars($unit['year']); ?>"
                                                        data-brand="<?php echo htmlspecialchars($unit['brand']); ?>"
                                                        data-model="<?php echo htmlspecialchars($unit['model']); ?>"
                                                        data-image="<?php echo htmlspecialchars($firstImage); ?>"
                                                        data-price="<?php echo htmlspecialchars($unit['shand_price']); ?>"
                                                        data-plate_number="<?php echo htmlspecialchars($unit['plate_number']); ?>"
                                                    >Sale</option>
                                                    <option value="edit" data-id="<?php echo htmlspecialchars($unit['id']); ?>" 
                                                        data-year="<?php echo htmlspecialchars($unit['year']); ?>"
                                                        data-brand="<?php echo htmlspecialchars($unit['brand']); ?>"
                                                        data-model="<?php echo htmlspecialchars($unit['model']); ?>"
                                                        data-type="<?php echo htmlspecialchars($unit['type']); ?>"
                                                        data-plate_number="<?php echo htmlspecialchars($unit['plate_number']); ?>"
                                                        data-mileage="<?php echo htmlspecialchars($unit['mileage']); ?>"
                                                        data-shand_price="<?php echo htmlspecialchars($unit['shand_price']); ?>"
                                                        data-bnew_price="<?php echo htmlspecialchars($unit['price']); ?>"
                                                        data-thread="<?php echo htmlspecialchars($unit['thread']); ?>"
                                                        data-color="<?php echo htmlspecialchars($unit['color']); ?>"
                                                        data-issue="<?php echo htmlspecialchars($unit['issue']); ?>"
                                                        data-status="<?php echo htmlspecialchars($unit['modified']); ?>">
                                                        Edit
                                                    </option>
                                                    <option value="delete" data-plate_number="<?php echo htmlspecialchars($unit['plate_number']); ?>">Delete</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-3">No units available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Output the units as JSON for console logging
    if (isset($units) && !empty($units)) {
        echo "<script>console.log(" . json_encode($units) . ");</script>";
    }
    ?>
    <script>
        $(document).ready(function(){
            $('#add_unit').on('click', function(){
                $('#overlay').removeClass('hidden')
                $('#form').removeClass('hidden')
            })

            $(document).on('change', '#action_select', function() {
                var selectedOption = $(this).find(':selected').val();

                if (selectedOption === 'edit') {
                    // Get data attributes from the selected option
                    var id = $(this).find(':selected').data('id');
                    var year = $(this).find(':selected').data('year');
                    var brand = $(this).find(':selected').data('brand');
                    var model = $(this).find(':selected').data('model');
                    var type = $(this).find(':selected').data('type');
                    var plateNumber = $(this).find(':selected').data('plate_number');
                    var mileage = $(this).find(':selected').data('mileage');
                    var shandPrice = $(this).find(':selected').data('shand_price');
                    var bnewPrice = $(this).find(':selected').data('bnew_price');
                    var thread = $(this).find(':selected').data('thread');
                    var color = $(this).find(':selected').data('color');
                    var issue = $(this).find(':selected').data('issue');
                    var status = $(this).find(':selected').data('status');

                    // Show the overlay and edit form
                    $('#overlay').removeClass('hidden');
                    $('#edit_form').removeClass('hidden');

                    // Populate the form with the data
                    $('[name="year"]').val(year);
                    $('[name="id"]').val(id);
                    $('[name="brand"]').val(brand);
                    $('[name="model"]').val(model);
                    $('[name="type"]').val(type);
                    $('[name="plate_number"]').val(plateNumber);
                    $('[name="mileage"]').val(mileage);
                    $('[name="shand_price"]').val(shandPrice);
                    $('[name="bnew_price"]').val(bnewPrice);
                    $('[name="thread"]').val(thread);
                    $('[name="color"]').val(color);
                    $('[name="issue"]').val(issue);

                    // Set the status radio button
                    $('input[name="status"][value="' + status + '"]').prop('checked', true);
                } else if (selectedOption === 'delete') {
                    var plateNumber = $(this).find(':selected').data('plate_number');
                    if (confirm('Are you sure you want to delete this unit?')) {
                        window.location.href = '/RGarage/admin/delete-unit?plate_number=' + plateNumber;
                    }
                } else if (selectedOption === "sale") {
                    var image = $(this).find(':selected').data('image');
                    var price = $(this).find(':selected').data('price');
                    var year = $(this).find(':selected').data('year');
                    var brand = $(this).find(':selected').data('brand');
                    var model = $(this).find(':selected').data('model');
                    var plateNumber = $(this).find(':selected').data('plate_number');

                    // Update the #sales div with row data
                    $('#to_pay').text(price);
                    $('#bill_year').text(year);
                    $('#bill_brand').text(brand);
                    $('#bill_model').text(model);
                    $('#unit_image').attr('src', `/RGarage/public/images/${image}`);
                    
                    $('#input_pay').val(price)
                    $('#input_plateNumber').val(plateNumber)
                    $('#input_unit').val(year + ' ' + brand + ' ' + model)

                    // Open the #sales div
                    $('#sales').removeClass('hidden');
                    $('#overlay').removeClass('hidden');

                    $('#confirm').on('click', function(){
                        $('#or_form').removeClass('hidden')
                        // Get the values from the input fields
                        const customer = $('#billed_to').val();
                        const contactNumber = $('#contact').val();
                        const emailAddress = $('#email').val();

                        // Update the hidden input fields
                        $('#input_customer').val(customer);
                        $('#input_contact_number').val(contactNumber);
                        $('#input_email_address').val(emailAddress);

                        // Optionally, show a message or perform additional actions
                        console.log('Customer, contact number, and email address updated.');
                    })

                    // Reset the dropdown back to the default option
                    $(this).val('');
                }
            });



            $('#closeForm').on('click', function(){
                $('#overlay').addClass('hidden')
                $('#form').addClass('hidden')
            })

            $('#closeEditForm').on('click', function(){
                $('#overlay').addClass('hidden')
                $('#edit_form').addClass('hidden')
            })

            $('#livesearch').on('keyup', function(){
                var key = $(this).val();
                $.ajax({
                    type: 'GET', // Change to GET if it's a read operation
                    url: '/RGarage/user/livesearch',
                    data: { key: key },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                        // Clear previous results
                        $('tbody').empty();

                        if (response.status && response.data.length > 0) {
                            // Loop through each unit in the response and append a new row
                            $.each(response.data, function(index, unit) {
                                var row = `
                                    <tr>
                                        <td class="py-3 border-r border-b border-gray-300 pl-2">${index + 1}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.plate_number}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.year}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.brand}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.model}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.price}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <button 
                                                data-id="${unit.id}"
                                                data-year="${unit.year}"
                                                data-brand="${unit.brand}"
                                                data-model="${unit.model}"
                                                data-type="${unit.type}"
                                                data-plate_number="${unit.plate_number}"
                                                data-mileage="${unit.mileage}"
                                                data-shand_price="${unit.shand_price}"
                                                data-bnew_price="${unit.price}"
                                                data-thread="${unit.thread}"
                                                data-color="${unit.color}"
                                                data-issue="${unit.issue}"
                                                data-status="${unit.modified}"
                                                class="text-blue-500 edit_unit">
                                                Edit
                                            </button>

                                            <a href="/RGarage/admin/delete-unit?plate_number=${unit.plate_number}" onclick="return confirm('Are you sure you want to delete this unit?');" class="text-red-500">Delete</a>
                                        </td>
                                    </tr>
                                `;
                                // Append the new row to the table
                                $('tbody').append(row);
                            });
                        } else {
                            // If no units match, show the no result message
                            $('tbody').html('<tr><td colspan="7" class="text-center py-3">No units available</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#livesearch-results').html('<p>An error occurred while searching. Please try again.</p>');
                    }
                });
            });

            let sortOrder = 'asc'; // Initialize with ascending order

            $('#price').on('click', function() {
                // Toggle the sort order
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                // alert(sortOrder)
                // Make AJAX request to fetch sorted data
                $.ajax({
                    type: 'GET', // Use GET for retrieving sorted data
                    url: `/RGarage/admin/units/sort/price?order=${sortOrder}`, // Pass the sort order as a query parameter
                    dataType: 'json',
                    success: function(response) {
                        // Check if response is valid and contains data
                        if (response && response.status === 'success' && Array.isArray(response.data)) {
                            console.log(response);
                            // Clear the table body
                            let tableBody = $('#units-table-body'); // Update with your table body ID
                            tableBody.empty();

                            // Populate table with sorted units
                            response.data.forEach((unit, index) => {
                                const imagesString = unit.image || '';
                                const imageNames = imagesString.split(',');
                                const firstImage = imageNames.length > 0 ? imageNames[0].trim() : '';

                                tableBody.append(`
                                    <tr>
                                        <td class="py-3 border-r border-b border-gray-300 pl-2">${index + 1}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.plate_number}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.year}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.brand}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.model}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${parseFloat(unit.shand_price.replace(/,/g, '')).toLocaleString(undefined, { minimumFractionDigits: 2 })}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <select name="action" id="action_select" class="block py-1 bg-white border rounded-sm outline-none text-center w-4/5 mx-auto">
                                                <option value="" disabled selected>Options</option>
                                                <option value="sale"
                                                    data-year="${unit.year}"
                                                    data-brand="${unit.brand}"
                                                    data-model="${unit.model}"
                                                    data-image="${firstImage}"
                                                    data-price="${unit.shand_price}"
                                                    data-plate_number="${unit.plate_number}"
                                                >Sale</option>
                                                <option value="edit" data-id="${unit.id}" 
                                                    data-year="${unit.year}"
                                                    data-brand="${unit.brand}"
                                                    data-model="${unit.model}"
                                                    data-type="${unit.type}"
                                                    data-plate_number="${unit.plate_number}"
                                                    data-mileage="${unit.mileage}"
                                                    data-shand_price="${unit.shand_price}"
                                                    data-bnew_price="${unit.price}"
                                                    data-thread="${unit.thread}"
                                                    data-color="${unit.color}"
                                                    data-issue="${unit.issue}"
                                                    data-status="${unit.modified}">
                                                    Edit
                                                </option>
                                                <option value="delete" data-plate_number="${unit.plate_number}">Delete</option>
                                            </select>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            console.error('Invalid response format:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#livesearch-results').html('<p>An error occurred while fetching sorted data. Please try again.</p>');
                    }
                });
            });

            $('#year').on('click', function() {
                // Toggle the sort order
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                // alert(sortOrder)
                // Make AJAX request to fetch sorted data
                $.ajax({
                    type: 'GET', // Use GET for retrieving sorted data
                    url: `/RGarage/admin/units/sort/year?order=${sortOrder}`, // Pass the sort order as a query parameter
                    dataType: 'json',
                    success: function(response) {
                        // Check if response is valid and contains data
                        if (response && response.status === 'success' && Array.isArray(response.data)) {
                            console.log(response);
                            // Clear the table body
                            let tableBody = $('#units-table-body'); // Update with your table body ID
                            tableBody.empty();

                            // Populate table with sorted units
                            response.data.forEach((unit, index) => {
                                const imagesString = unit.image || '';
                                const imageNames = imagesString.split(',');
                                const firstImage = imageNames.length > 0 ? imageNames[0].trim() : '';

                                tableBody.append(`
                                    <tr>
                                        <td class="py-3 border-r border-b border-gray-300 pl-2">${index + 1}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.plate_number}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.year}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.brand}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.model}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${parseFloat(unit.shand_price.replace(/,/g, '')).toLocaleString(undefined, { minimumFractionDigits: 2 })}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <select name="action" id="action_select" class="block py-1 bg-white border rounded-sm outline-none text-center w-4/5 mx-auto">
                                                <option value="" disabled selected>Options</option>
                                                <option value="sale"
                                                    data-year="${unit.year}"
                                                    data-brand="${unit.brand}"
                                                    data-model="${unit.model}"
                                                    data-image="${firstImage}"
                                                    data-price="${unit.shand_price}"
                                                    data-plate_number="${unit.plate_number}"
                                                >Sale</option>
                                                <option value="edit" data-id="${unit.id}" 
                                                    data-year="${unit.year}"
                                                    data-brand="${unit.brand}"
                                                    data-model="${unit.model}"
                                                    data-type="${unit.type}"
                                                    data-plate_number="${unit.plate_number}"
                                                    data-mileage="${unit.mileage}"
                                                    data-shand_price="${unit.shand_price}"
                                                    data-bnew_price="${unit.price}"
                                                    data-thread="${unit.thread}"
                                                    data-color="${unit.color}"
                                                    data-issue="${unit.issue}"
                                                    data-status="${unit.modified}">
                                                    Edit
                                                </option>
                                                <option value="delete" data-plate_number="${unit.plate_number}">Delete</option>
                                            </select>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            console.error('Invalid response format:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#livesearch-results').html('<p>An error occurred while fetching sorted data. Please try again.</p>');
                    }
                });
            });


            $('#brand').on('click', function() {
                // Toggle the sort order
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
                // alert(sortOrder)
                // Make AJAX request to fetch sorted data
                $.ajax({
                    type: 'GET', // Use GET for retrieving sorted data
                    url: `/RGarage/admin/units/sort/brand?order=${sortOrder}`, // Pass the sort order as a query parameter
                    dataType: 'json',
                    success: function(response) {
                        // Check if response is valid and contains data
                        if (response && response.status === 'success' && Array.isArray(response.data)) {
                            console.log(response);
                            // Clear the table body
                            let tableBody = $('#units-table-body'); // Update with your table body ID
                            tableBody.empty();

                            // Populate table with sorted units
                            response.data.forEach((unit, index) => {
                                const imagesString = unit.image || '';
                                const imageNames = imagesString.split(',');
                                const firstImage = imageNames.length > 0 ? imageNames[0].trim() : '';

                                tableBody.append(`
                                    <tr>
                                        <td class="py-3 border-r border-b border-gray-300 pl-2">${index + 1}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.plate_number}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.year}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.brand}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${unit.model}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">${parseFloat(unit.shand_price.replace(/,/g, '')).toLocaleString(undefined, { minimumFractionDigits: 2 })}</td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <select name="action" id="action_select" class="block py-1 bg-white border rounded-sm outline-none text-center w-4/5 mx-auto">
                                                <option value="" disabled selected>Options</option>
                                                <option value="sale"
                                                    data-year="${unit.year}"
                                                    data-brand="${unit.brand}"
                                                    data-model="${unit.model}"
                                                    data-image="${firstImage}"
                                                    data-price="${unit.shand_price}"
                                                    data-plate_number="${unit.plate_number}"
                                                >Sale</option>
                                                <option value="edit" data-id="${unit.id}" 
                                                    data-year="${unit.year}"
                                                    data-brand="${unit.brand}"
                                                    data-model="${unit.model}"
                                                    data-type="${unit.type}"
                                                    data-plate_number="${unit.plate_number}"
                                                    data-mileage="${unit.mileage}"
                                                    data-shand_price="${unit.shand_price}"
                                                    data-bnew_price="${unit.price}"
                                                    data-thread="${unit.thread}"
                                                    data-color="${unit.color}"
                                                    data-issue="${unit.issue}"
                                                    data-status="${unit.modified}">
                                                    Edit
                                                </option>
                                                <option value="delete" data-plate_number="${unit.plate_number}">Delete</option>
                                            </select>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            console.error('Invalid response format:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#livesearch-results').html('<p>An error occurred while fetching sorted data. Please try again.</p>');
                    }
                });
            });
        })
    </script>
</body>
</html>
