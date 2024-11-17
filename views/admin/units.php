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
        <div class="py-2 px-6 flex items-center justify-between bg-blue-500 rounded-tr-lg rounded-tl-lg">
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
                    <button type="submit" class="w-1/6 bg-blue-500 px-10 py-2 text-white text-sm rounded-md ">Add</button>
                    <input type="file" name="images[]" class="bg-white text-sm" accept=".jpg" multiple required>
                </div>
            </form>
        </div>
    </div>
    <div class="w-[16%] bg-gray-700">
        <p class="text-white px-5 py-3 mb-6 bg-blue-500">RGarage.</p>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="bg-blue-500 py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">Messages</a>
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
                        <input id="livesearch" type="text" name="search" class="w-[20%] bg-white border border-gray-300 py-1 px-4">
                    </div>
                    <div>
                        <table class="w-full table-auto border border-gray-400">
                            <thead>
                                <tr class="text-sm border-b-4 text-left">
                                    <th class="w-[5%] border-r border-gray-300 py-3 pl-2">#</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Plate Number</th>
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
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['plate_number']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['year']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['brand']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['model']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($unit['price']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2">
                                            <button 
                                                data-id="<?php echo $unit['id']; ?>"
                                                data-year="<?php echo $unit['year']; ?>"
                                                data-brand="<?php echo $unit['brand']; ?>"
                                                data-model="<?php echo $unit['model']; ?>"
                                                data-type="<?php echo $unit['type']; ?>"
                                                data-plate_number="<?php echo $unit['plate_number']; ?>"
                                                data-mileage="<?php echo $unit['mileage']; ?>"
                                                data-shand_price="<?php echo $unit['shand_price']; ?>"
                                                data-bnew_price="<?php echo $unit['price']; ?>"
                                                data-thread="<?php echo $unit['thread']; ?>"
                                                data-color="<?php echo $unit['color']; ?>"
                                                data-issue="<?php echo $unit['issue']; ?>"
                                                data-status="<?php echo $unit['modified']; ?>"
                                                id="" 
                                                class="text-blue-500 edit_unit">
                                                Edit
                                            </button>

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

            $(document).on('click', '.edit_unit', function() {
                // Show the overlay and edit form
                $('#overlay').removeClass('hidden');
                $('#edit_form').removeClass('hidden');

                // Get the data attributes from the button
                var id = $(this).data('id');
                var year = $(this).data('year');
                var brand = $(this).data('brand');
                var model = $(this).data('model');
                var type = $(this).data('type');
                var plateNumber = $(this).data('plate_number');
                var mileage = $(this).data('mileage');
                var shandPrice = $(this).data('shand_price');
                var bnewPrice = $(this).data('bnew_price');
                var thread = $(this).data('thread');
                var color = $(this).data('color');
                var issue = $(this).data('issue');
                var status = $(this).data('status');

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

        })
    </script>
</body>
</html>
