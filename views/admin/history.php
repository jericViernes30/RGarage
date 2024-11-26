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
        <p class="text-white px-5 py-3 mb-6 bg-blue-500">RGarage.</p>
        <div class="w-full flex flex-col">
        <a href="/RGarage/admin/dashboard" class="py-2 px-5 text-white w-full">Dashboard</a>
            <a href="/RGarage/admin/units" class="py-2 px-5 text-white w-full">Unit's List</a>
            <a href="/RGarage/admin/reserved-units" class="py-2 px-5 text-white w-full">Reserved Units</a>
            <a href="/RGarage/admin/messages" class="py-2 px-5 text-white w-full">Messages</a>
            <a href="/RGarage/admin/history" class="bg-blue-500 py-2 px-5 text-white w-full">History</a>
        </div>
    </div>
    <div class="w-[84%]">
        <div class="w-full py-3 flex justify-between bg-white shadow-xl">
            <div class="flex items-center gap-8 pl-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="23" height="23" fill="#000"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg>
                <p class="pt-[2px] text-gray-400 text-sm">RGarage: Pre-owned Motorcycles Dealership System - Admin</p>
            </div>
            <div class="px-16 flex items-center">
                <p class="text-black-v1">Administrator Admin</p>
            </div>
        </div>
        <div class="p-8 w-full">
        <div class="bg-white w-full p-5 rounded-lg border-2 border-gray-300 border-t-4 border-t-blue-500">
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