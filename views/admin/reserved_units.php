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
        <div class="py-2 px-6 flex items-center justify-between bg-blue-500 rounded-tr-lg rounded-tl-lg">
            <p class="text-white">Unit Sales</p>
            <button type="button" id="closeForm" class="text-white">x</button>
        </div>
        <div class="w-full h-fit p-6 bg-white relative">
            <div id="or_form" class="hidden w-1/3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="py-2 px-4 flex items-center justify-between bg-blue-500 rounded-tr-lg rounded-tl-lg">
                    <p class="text-white">Official Receipt</p>
                    <button type="button" id="closeForm" class="text-white">x</button>
                </div>
                <div class="w-full h-fit p-4 bg-white rounded-br-lg rounded-bl-lg">
                    <form action="/RGarage/admin/sold" method="POST">
                        <p class="text-xs mb-1">OR Number</p>
                        <input id="input_customer" type="hidden" name="customer" class="bg-white">
                        <input id="input_pay" type="hidden" name="pay" class="bg-white">
                        <input id="input_contact_number" type="hidden" name="contact_number">
                        <input id="input_email_address" type="hidden" name="email_address">
                        <input id="input_unit" type="hidden" name="unit">
                        <input id="input_reservedID" type="hidden" name="reservedID" class="bg-white">
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
                        <p id="billed_to" class="text-xl font-bold"></p>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Amount To Pay</p>
                        <p id="to_pay" class="text-xl font-bold">46,000</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Contact Number</p>
                        <p id="contact" class="text-xl font-bold">09976589181</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs mb-1">Email Address</p>
                        <p id="email" class="text-xl font-bold">jericviernes06@gmail.com</p>
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
    <div class="w-[16%] bg-gray-700">
        <p class="text-white px-5 py-3 mb-6 bg-blue-500">RGarage.</p>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/reserved-units" class="bg-blue-500 py-2 px-5 text-white w-full">Reserved Units</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">Messages</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">History</a>
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
                    <p class="text-lg text-black-v1">List of Reserved Units</p>
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
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Customer Name</th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Year</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Brand</th>
                                    <th class="w-[30%] border-r border-gray-300 pl-2">Model</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Reservation Date</th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($reserved_units) && !empty($reserved_units)): ?>

                                <?php foreach ($reserved_units as $index => $reserved): 
                                        $imagesString = htmlspecialchars($reserved['unit']['image']); // Get the image string safely
                                        $imageNames = explode(',', $imagesString); // Split the string into an array
                                        $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';
                                    ?>
                                    <tr 
                                        data-contact="<?php echo htmlspecialchars($reserved['user']['contact_number']); ?>" 
                                        data-email="<?php echo htmlspecialchars($reserved['user']['email_address']); ?>"
                                        data-image="<?php echo htmlspecialchars($firstImage); ?>"
                                        data-price="<?php echo htmlspecialchars($reserved['unit']['shand_price']); ?>"
                                        data-reserved_id="<?php echo $reserved['reserved_id']; ?>"
                                    >
                                        <td class="py-3 border-r border-b border-gray-300 pl-2"><?php echo $reserved['reserved_id']; ?></td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <?php echo htmlspecialchars($reserved['user']['first_name'] . ' ' . $reserved['user']['last_name']); ?>
                                        </td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <?php echo htmlspecialchars($reserved['unit']['year']); ?>
                                        </td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <?php echo htmlspecialchars($reserved['unit']['brand']); ?>
                                        </td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <?php echo htmlspecialchars($reserved['unit']['model']); ?>
                                        </td>
                                        <td class="border-r border-b border-gray-300 pl-2">
                                            <?php echo htmlspecialchars(date('F j, Y', strtotime($reserved['reserved_date']))); ?>
                                        </td>
                                        <td class="border-r border-b border-gray-300 px-2">
                                            <select name="action" id="" class="block py-1 bg-white border rounded-sm outline-none text-center w-4/5 mx-auto">
                                                <option value="" disabled selected>Options</option>
                                                <option value="sale">Sale</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No reserved units found.</p>
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
        // $(document).ready(function(){
        //     $('#add_unit').on('click', function(){
        //         $('#overlay').removeClass('hidden')
        //         $('#form').removeClass('hidden')
        //     })

        //     $(document).on('click', '.edit_unit', function() {
        //         // Show the overlay and edit form
        //         $('#overlay').removeClass('hidden');
        //         $('#edit_form').removeClass('hidden');

        //         // Get the data attributes from the button
        //         var id = $(this).data('id');
        //         var year = $(this).data('year');
        //         var brand = $(this).data('brand');
        //         var model = $(this).data('model');
        //         var type = $(this).data('type');
        //         var plateNumber = $(this).data('plate_number');
        //         var mileage = $(this).data('mileage');
        //         var shandPrice = $(this).data('shand_price');
        //         var bnewPrice = $(this).data('bnew_price');
        //         var thread = $(this).data('thread');
        //         var color = $(this).data('color');
        //         var issue = $(this).data('issue');
        //         var status = $(this).data('status');

        //         // Populate the form with the data
        //         $('[name="year"]').val(year);
        //         $('[name="id"]').val(id);
        //         $('[name="brand"]').val(brand);
        //         $('[name="model"]').val(model);
        //         $('[name="type"]').val(type);
        //         $('[name="plate_number"]').val(plateNumber);
        //         $('[name="mileage"]').val(mileage);
        //         $('[name="shand_price"]').val(shandPrice);
        //         $('[name="bnew_price"]').val(bnewPrice);
        //         $('[name="thread"]').val(thread);
        //         $('[name="color"]').val(color);
        //         $('[name="issue"]').val(issue);

        //         // Set the status radio button
        //         $('input[name="status"][value="' + status + '"]').prop('checked', true);
        //     });


        //     $('#closeForm').on('click', function(){
        //         $('#overlay').addClass('hidden')
        //         $('#form').addClass('hidden')
        //     })

        //     $('#closeEditForm').on('click', function(){
        //         $('#overlay').addClass('hidden')
        //         $('#edit_form').addClass('hidden')
        //     })

        //     $('#livesearch').on('keyup', function(){
        //         var key = $(this).val();
        //         $.ajax({
        //             type: 'GET', // Change to GET if it's a read operation
        //             url: '/RGarage/user/livesearch',
        //             data: { key: key },
        //             dataType: 'json',
        //             success: function(response) {
        //                 console.log(response)
        //                 // Clear previous results
        //                 $('tbody').empty();

        //                 if (response.status && response.data.length > 0) {
        //                     // Loop through each unit in the response and append a new row
        //                     $.each(response.data, function(index, unit) {
        //                         var row = `
        //                             <tr>
        //                                 <td class="py-3 border-r border-b border-gray-300 pl-2">${index + 1}</td>
        //                                 <td class="border-r border-b border-gray-300 pl-2">${unit.plate_number}</td>
        //                                 <td class="border-r border-b border-gray-300 pl-2">${unit.year}</td>
        //                                 <td class="border-r border-b border-gray-300 pl-2">${unit.brand}</td>
        //                                 <td class="border-r border-b border-gray-300 pl-2">${unit.model}</td>
        //                                 <td class="border-r border-b border-gray-300 pl-2">${unit.price}</td>
        //                                 <td class="border-r border-b border-gray-300 pl-2">
        //                                     <button 
        //                                         data-id="${unit.id}"
        //                                         data-year="${unit.year}"
        //                                         data-brand="${unit.brand}"
        //                                         data-model="${unit.model}"
        //                                         data-type="${unit.type}"
        //                                         data-plate_number="${unit.plate_number}"
        //                                         data-mileage="${unit.mileage}"
        //                                         data-shand_price="${unit.shand_price}"
        //                                         data-bnew_price="${unit.price}"
        //                                         data-thread="${unit.thread}"
        //                                         data-color="${unit.color}"
        //                                         data-issue="${unit.issue}"
        //                                         data-status="${unit.modified}"
        //                                         class="text-blue-500 edit_unit">
        //                                         Edit
        //                                     </button>

        //                                     <a href="/RGarage/admin/delete-unit?plate_number=${unit.plate_number}" onclick="return confirm('Are you sure you want to delete this unit?');" class="text-red-500">Delete</a>
        //                                 </td>
        //                             </tr>
        //                         `;
        //                         // Append the new row to the table
        //                         $('tbody').append(row);
        //                     });
        //                 } else {
        //                     // If no units match, show the no result message
        //                     $('tbody').html('<tr><td colspan="7" class="text-center py-3">No units available</td></tr>');
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(error);
        //                 $('#livesearch-results').html('<p>An error occurred while searching. Please try again.</p>');
        //             }
        //         });
        //     });

        // })
    </script>

<script>
    $(document).ready(function () {
        // When the dropdown value changes
        $('select[name="action"]').on('change', function () {
            const selectedOption = $(this).val();

            // If "Sale" is selected
            if (selectedOption === "sale") {
                // Find the row data
                const row = $(this).closest('tr');
                const billedTo = row.find('td').eq(1).text().trim();
                const year = row.find('td').eq(2).text().trim();
                const brand = row.find('td').eq(3).text().trim();
                const model = row.find('td').eq(4).text().trim();
                const contact = row.data('contact');
                const email = row.data('email');
                const image = row.data('image');
                const price = row.data('price')
                const reservedID = row.data('reserved_id')

                // Update the #sales div with row data
                $('#billed_to').text(billedTo);
                $('#bill_year').text(year);
                $('#bill_brand').text(brand);
                $('#bill_model').text(model);
                $('#contact').text(contact);
                $('#email').text(email);
                $('#unit_image').attr('src', `/RGarage/public/images/${image}`);

                $('#input_customer').val(billedTo)
                $('#input_pay').val(price)
                $('#input_contact_number').val(contact)
                $('#input_email_address').val(email)
                $('#input_reservedID').val(reservedID)
                $('#input_unit').val(year + ' ' + brand + ' ' + model)

                // Open the #sales div
                $('#sales').removeClass('hidden');
                $('#overlay').removeClass('hidden');

                $('#confirm').on('click', function(){
                    $('#or_form').removeClass('hidden')
                })

                // Reset the dropdown back to the default option
                $(this).val('');
            }
        });

        // Close the #sales div when the close button is clicked
        $('#sales #closeForm').on('click', function () {
            $('#sales').addClass('hidden');
            $('#overlay').addClass('hidden');
        });
    });
</script>
</body>
</html>
