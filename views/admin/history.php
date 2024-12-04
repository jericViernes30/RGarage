<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="w-full flex h-screen text-black-v1 bg-gray-200">
    <div class="w-[16%] bg-gray-700">
    <div class="w-full bg-[#1b1c1e]">
            <img src="/RGarage/public/logo/rgarage.png" alt="" class="px-5 mb-3 filter grayscale brightness-[1000%] w-[60%]">
        </div>
        <div class="w-full flex flex-col">
            <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/reserved-units" class="py-2 px-5 text-white w-full">Reserved Units</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">Messages</a>
            <a href="/RGarage/admin/history" class="bg-[#1b1c1e] py-2 px-5 text-white w-full">History</a>
        </div>
    </div>
    <div class="w-[84%]">
        <div class="w-full py-3 flex justify-between bg-white shadow-xl">
            <div class="flex items-center gap-8 pl-8">
                
                <p class="pt-[2px] text-gray-400 text-sm">RGarage: Pre-owned Motorcycles Dealership System - Admin</p>
            </div>
            <div class="px-16 flex items-center">
                <p class="text-black-v1">Administrator Admin</p>
            </div>
        </div>
        <div class="p-8 w-full">
        <div class="bg-white w-full p-5 rounded-lg border-2 border-gray-300 border-t-4 border-t-[#1b1c1e]">
                <div class="w-full flex justify-between border-b border-gray-300 mb-4 pb-3">
                    <p class="text-lg text-black-v1">List of Sold Units</p>
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
                                    <th class="w-[8%] border-r border-gray-300 py-3 pl-2">OR#</th>
                                    <th class="w-[15%] border-r border-gray-300 pl-2">Sold To</th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Sold Date</th>
                                    <th class="w-[25%] border-r border-gray-300 pl-2">Unit</th>
                                    <th class="w-[10%] border-r border-gray-300 pl-2">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($sales) && !empty($sales)): ?>
                                    <?php foreach ($sales as $index => $sale):
                                        ?>
                                        <tr>
                                            <td class="py-3 border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($sale['or_number']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($sale['name']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($sale['created_at']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars($sale['unit']); ?></td>
                                            <td class="border-r border-b border-gray-300 pl-2"><?php echo htmlspecialchars(number_format($sale['price'], 2)); ?></td>
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
    <script>

    </script>
</body>
</html>