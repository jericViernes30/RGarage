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
    <div id="form" class="hidden w-1/2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white">
        <div class="py-2 px-6 flex items-center justify-between bg-blue-500 rounded-tr-lg rounded-tl-lg">
            <p class="text-white">Add Unit Form</p>
            <button type="button" id="closeForm" class="text-white">x</button>
        </div>
        <div>
            <form action="/RGarage/admin/add-unit" method="POST" class="p-6 flex flex-col" enctype="multipart/form-data">
                <div class="w-full flex gap-3 mb-4">
                    <div class="w-1/5 flex flex-col gap-1">
                        <label for="">Year</label>
                        <input type="text" name="year" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-2/5 flex flex-col gap-1">
                        <label for="">Brand</label>
                        <input type="text" name="brand" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-2/5 flex flex-col gap-1">
                        <label for="">Model</label>
                        <input type="text" name="model" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                </div>
                <hr>
                <div class="w-full flex gap-3 my-4 mb-4">
                    <div class="w-1/3 flex flex-col gap-1 mb-2">
                        <label for="">Plate Number</label>
                        <input type="text" name="plate_number" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-1/3 flex flex-col gap-1">
                        <label for="">Mileage</label>
                        <input type="text" name="mileage" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                    <div class="w-1/3 flex flex-col gap-1">
                        <label for="">Price</label>
                        <input type="text" name="price" class="outline-none py-1 px-4 border border-gray-400 rounded-md bg-white">
                    </div>
                </div>
                <input type="file" name="images[]" class="bg-white mb-4" accept=".jpg" multiple required>

                <button type="submit" class="w-1/6 bg-blue-500 px-10 py-2 text-white text-sm rounded-md">Add</button>
            </form>
        </div>
    </div>
    <div class="w-[16%] bg-gray-700">
        <p class="text-white px-5 py-3 mb-6 bg-blue-500">RGarage.</p>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="#" class="bg-blue-500 py-2 px-5 text-white w-full">Unit's List</a>
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
            <div class="bg-white w-full p-5 rounded-lg border-2 border-gray-300 border-t-4 border-t-blue-500">
                <div class="w-full flex justify-between border-b border-gray-300 mb-4 pb-3">
                    <p class="text-lg text-black-v1">List of Units</p>
                    <button id="add_unit" type="button" class="bg-blue-500 py-2 px-6 text-white text-sm rounded-md">Add Unit</button>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <p class="text-sm">Search:</p>
                        <input type="text" name="search" class="w-[20%] bg-white border border-gray-300 py-1 px-4">
                    </div>
                    <div>
                        <table class="w-full table-auto border border-gray-400">
                            <thead>
                                <tr class="text-sm border-b-4 text-left">
                                    <th class="w-[5%] border-r border-gray-300 py-3 pl-2">#</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Date Created</th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Year</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Brand</th>
                                    <th class="w-[30%] border-r border-gray-300 pl-2">Model</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Price</th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($units) && !empty($units)): ?>
                                    <?php foreach ($units as $index => $unit): ?>
                                        <tr>
                                            <td class="py-3 border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($index + 1); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['created_at']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['year']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['brand']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['model']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['price']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2">
                                                <a href="edit.php?id=<?php echo $unit['id']; ?>" class="text-blue-500">Edit</a>
                                                <a href="/RGarage/admin/delete-unit?plate_number=<?php echo $unit['plate_number']; ?>" onclick="return confirm('Are you sure you want to delete this unit?');" class="text-red-500">Delete</a>

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

            $('#closeForm').on('click', function(){
                $('#overlay').addClass('hidden')
                $('#form').addClass('hidden')
            })
        })
    </script>
</body>
</html>
