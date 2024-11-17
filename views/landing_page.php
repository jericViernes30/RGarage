<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="./src/output.css" rel="stylesheet">
  <style>
    #profileDropdown{
      --animate-duration: 0.3s;
    }
  </style>
</head>
<body class="w-full bg-white overflow-x-hidden text-black-v1">
  <div class="sticky top-0 left-0 z-50">
    <?php
    include 'components/header.php';
    ?>
  </div>
  <div class="w-full flex items-center">
    <div class="w-1/2 flex px-10 items-center justify-center h-[700px]">
      <p class="text-4xl font-medium text-black-v1 text-center"><span class="font-bold">RGarage:</span> Your Trusted Stop for Quality Pre-Owned Motorcycles & Cars</p>
    </div>
    <div>
      <img src="public/images/hero.jpg" alt="Hero image!" class="w-4/5 block mx-auto">
    </div>
  </div>

  <div id="about" class="w-4/5 h-[700px] shadow-2xl block mx-auto mb-10 py-10">
    <p class="text-center text-4xl font-medium text-black-v1 mb-10">About Us</p>
    <div class="">
      <p class="text-md text-center font-medium text-black-v1 px-24 mb-10">Welcome to RGarage, your trusted destination for high-quality second-hand motorcycles and cars. Located in General Mariano Alvarez, Cavite, we pride ourselves on offering a wide selection of pre-owned vehicles that cater to all kinds of riders and drivers. Whether you're looking for a reliable motorcycle or a durable car, our team is dedicated to helping you find the perfect match for your needs and budget.</p>

      <p class="text-md text-center font-medium text-black-v1 px-24">At RGarage, we believe in transparency and customer satisfaction. Every unit in our inventory undergoes thorough inspections to ensure it meets our high standards for performance and safety. Visit us today and discover how we can help you drive away with confidence.</p>
    </div>

    <div class="w-4/5 block mx-auto mt-24">
      <div class="flex items-center justify-center gap-4">
        <!-- customers -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-lg text-white">New Customers</p>
          <p class="text-[3rem] font-bold text-[#4962f1]">12</p>
          <p class="text-sm text-[#9f9f9f]">36 customers in total</p>
        </div>
        <!-- sold units -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-lg text-white">Units Sold</p>
          <p class="text-[3rem] font-bold text-[#f149ee]">36</p>
          <p class="text-sm text-[#9f9f9f]">21% more than last month</p>
        </div>
        <!-- on hand units -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-lg text-white">Units on Garage</p>
          <p class="text-[3rem] font-bold text-[#76f149]">10</p>
          <p class="text-sm text-[#9f9f9f]">58% more than last month</p>
        </div>
        <!-- rating -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-lg text-white">Customers Rating</p>
          <div class="w-full flex items-center gap-2">
            <p class="text-[3rem] font-bold text-[#f1dd49]">4.9/5</p>
            <img src="public/icons/star.png" alt="" class="w-[18%]">
          </div>
          <p class="text-sm text-[#9f9f9f]">72% of the customers</p>
        </div>
      </div>
    </div>
  </div>

  <!-- available brands -->
  <div class="w-full px-24 py-2 mt-24">
    <p class="text-4xl font-medium text-black-v1 mb-10">Available Brands</p>
    <div class="carousel carousel-end rounded-box flex gap-16">
      <button onclick="window.location.href='/RGarage/user/honda'" class="carousel-item w-1/6 h-1/6">
        <img src="public/logo/honda.png" alt="Drink" />
      </button>
      <button onclick="window.location.href='/RGarage/user/yamaha'" class="carousel-item w-[15%] h-[15%]">
        <img src="public/logo/yamaha.png" alt="Drink" />
      </button>
      <button onclick="window.location.href='/RGarage/user/suzuki'" class="carousel-item w-1/6 h-1/6">
        <img src="public/logo/suzuki.png" alt="Drink" />
      </button>
      <button onclick="window.location.href='/RGarage/user/kawasaki'" class="carousel-item w-1/6 h-1/6">
        <img src="public/logo/kawasaki.png" alt="Drink" />
      </button>
      <button class="carousel-item w-1/6 h-1/6">
        <img src="public/logo/toyota.png" alt="Drink" />
      </button>
      <button class="carousel-item w-1/6 h-1/6">
        <img src="public/logo/mitsubishi.png" alt="Drink" />
      </button>
    </div>
  </div>

  <!-- featured units -->
  <div class="w-full px-24 py-24">
    <p class="text-4xl font-medium text-black-v1 mb-10">Featured Units</p>
    <div class="w-full flex items-center justify-evenly gap-4">
      <?php 
        $counter = 0; // Initialize the counter
        foreach ($units as $unit):
          $imagesString = htmlspecialchars($unit['image']); // Get the image string safely
          $imageNames = explode(',', $imagesString); // Split the string into an array
          $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';
      
          // Stop the loop after 4 iterations
          if ($counter >= 4) break;
          $counter++;
          ?>
          <div id="card-btn" class="card bg-base-100 w-80 shadow-xl h-[550px] text-white">
              <figure>
                  <img
                      src="/RGarage/public/images/<?php echo $firstImage ?>" 
                      alt="<?php echo $firstImage ?>" />
              </figure>
              <div class="card-body bg-black-v1 rounded-bl-2xl rounded-br-2xl">
                  <h2 class="card-title text-sm"><?php echo $unit['year']. ' ' . $unit['brand'] . ' ' . $unit['model']?></h2>
                  <p class="text-xs">For only <?php echo $unit['shand_price'] ?>.00 !</p>
                  <div class="card-actions justify-end">
                      <button onclick="window.location.href='/RGarage/user/unit-detail?unitID=<?php echo $unit['id'] ?>'" id="inquire" data-id="<?php echo $unit['id'] ?>" type="button" class="btn btn-primary inquire-btn">Inquire Now</button>
                  </div>
              </div>
          </div>
      <?php 
      endforeach; 
      ?>
    </div>
  </div>
</body>
</html>