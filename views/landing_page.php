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
  <div class="w-4/5 mx-auto flex items-center">
    <div class="w-1/2 flex px-10 items-center justify-center h-[700px]">
      <p class="text-4xl font-medium text-black-v1 text-center"><span class="font-bold">RGarage:</span> Your Trusted Stop for Quality Pre-Owned Motorcycles & Cars</p>
    </div>
    <div>
      <img src="public/images/rgarage-hero.jpg" alt="Hero image!" class="w-3/4 block mx-auto">
    </div>
  </div>

  <div id="about" class="w-4/5 h-fit shadow-2xl block mx-auto mb-10 py-10">
    <p class="text-center text-4xl font-medium text-black-v1 mb-10">About Us</p>
    <div class="">
      <p class="text-md text-center font-medium text-black-v1 px-24 mb-10">Welcome to RGarage, your trusted destination for high-quality second-hand motorcycles and cars. Located in General Mariano Alvarez, Cavite, we pride ourselves on offering a wide selection of pre-owned vehicles that cater to all kinds of riders and drivers. Whether you're looking for a reliable motorcycle or a durable car, our team is dedicated to helping you find the perfect match for your needs and budget.</p>

      <p class="text-md text-center font-medium text-black-v1 px-24">At RGarage, we believe in transparency and customer satisfaction. Every unit in our inventory undergoes thorough inspections to ensure it meets our high standards for performance and safety. Visit us today and discover how we can help you drive away with confidence.</p>
    </div>

    <div class="w-4/5 block mx-auto mt-24 mb-24">
      <div class="flex items-center justify-center gap-4">
        <!-- customers -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-md text-white">Total Customers</p>
          <p class="text-[2rem] font-bold text-[#4962f1]"><?php echo htmlspecialchars($totalCustomers); ?></p>
        </div>
        <!-- sold units -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-md text-white">Total Units Sold</p>
          <p class="text-[2rem] font-bold text-[#f149ee]"><?php echo htmlspecialchars($totalUnitsSold); ?></p>
        </div>
        <!-- on hand units -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-md text-white">Units on Garage</p>
          <p class="text-[2rem] font-bold text-[#76f149]"><?php echo htmlspecialchars($totalUnits); ?></p>
        </div>
        <!-- rating -->
        <div class="w-1/4 p-4 rounded-lg bg-black-v1">
          <p class="font-light text-md text-white">Customers Rating</p>
          <div class="w-full flex items-center gap-2">
            <p class="text-[2rem] font-bold text-[#f1dd49]"><?php echo htmlspecialchars(number_format($average, 1)); ?>/5
            </p>
            <img src="public/icons/star.png" alt="" class="w-[18%]">
          </div>
        </div>
      </div>
    </div>
    <div class="w-4/5 block mx-auto">
      <p class="text-2xl font-medium">Location:</p>
      <iframe class="w-full" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1366.9598262852405!2d121.00099705365666!3d14.291303563108773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d7a81aceec13%3A0x50d035113d12e3b9!2sR%20GARAGE!5e0!3m2!1sen!2sph!4v1732892522304!5m2!1sen!2sph" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

  </div>

  <!-- available brands -->
  <div class="w-4/5 block mx-auto py-2 mt-24">
    <p class="text-4xl font-medium text-black-v1 mb-10">Available Brands</p>
    <div class="carousel carousel-end rounded-box flex justify-evenly gap-16">
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
    </div>
  </div>

  <!-- featured units -->
  <div class="w-4/5 block mx-auto py-24">
    <p class="text-4xl font-medium text-black-v1 mb-10">Featured Units</p>
    <div id="unit-cards-container" class="w-full flex items-center justify-evenly gap-4">
      <?php
$counter = 0; // Initialize the counter
foreach ($units as $unit):
    $imagesString = htmlspecialchars($unit['image']); // Get the image string safely
    $imageNames = explode(',', $imagesString); // Split the string into an array
    $firstImage = isset($imageNames[0]) ? trim($imageNames[0]) : '';

    // Stop the loop after 4 iterations
    if ($counter >= 4) {
        break;
    }

    $counter++;
    ?>
		          <div id="card-btn" class="card bg-base-100 w-80 shadow-xl h-[550px] text-white unit-card">
		              <figure>
		                  <img
		                      src="/RGarage/public/images/<?php echo $firstImage ?>"
		                      alt="<?php echo $firstImage ?>" />
		              </figure>
		              <div class="card-body bg-black-v1 rounded-bl-2xl rounded-br-2xl">
		                  <h2 class="card-title text-sm"><?php echo $unit['year'] . ' ' . $unit['brand'] . ' ' . $unit['model'] ?></h2>
		                  <p class="text-xs">For only <?php echo number_format($unit['shand_price']); ?>.00!</p>
		                  <div class="card-actions justify-end">
		                      <button onclick="window.location.href='/RGarage/user/unit-detail?unitID=<?php echo $unit['id'] ?>'" id="inquire" data-id="<?php echo $unit['id'] ?>" type="button" class="btn btn-primary inquire-btn">Inquire Now</button>
		                  </div>
		              </div>
		          </div>
		      <?php endforeach;?>
    </div>
  </div>


  <div class="w-4/5 block mx-auto py-24">
    <p class="text-4xl font-medium text-black-v1 mb-10 text-center">Contact Us</p>
    <div class="w-full flex gap-10">
      <div class="w-1/2">
        <p class="text-3xl font-light mb-10">Getting in touch is easy!</p>

        <div class="w-full flex gap-2 items-center mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
          <p class="font-light">+63 977 309 9041</p>
        </div>
        <div class="w-full flex gap-2 items-center mb-10">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="20" height="20"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
          <p class="font-light">BLOCK 10 LOT 61, 72R2+RMC, General Mariano Alvarez, 4117 Cavite</p>
        </div>
        <p class="mb-2">Follow us on:</p>
        <div class="w-full flex gap-7 items-center">
          <a href="https://www.facebook.com/RGagarage">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="40" height="40"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/></svg>
          </a>
          <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="40" height="40"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
          </a>
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="40" height="40"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg>
          </a>
        </div>
      </div>
      <div class="w-1/2">
        <form action="/RGarage/user/send-email" method="POST">
          <div class="mb-3">
            <label for="">Name</label>
            <input type="text" name="name" class="w-full outline-none rounded-md border border-black py-2 px-4 bg-white">
          </div>
          <div class="mb-3">
            <label for="">Contact Number</label>
            <input type="text" name="contact_number" class="w-full outline-none rounded-md border border-black py-2 px-4 bg-white">
          </div>
          <div class="mb-3">
            <label for="">Email Address</label>
            <input type="text" name="email_address" class="w-full outline-none rounded-md border border-black py-2 px-4 bg-white">
          </div>
          <div class="mb-3">
            <label for="">Message</label>
            <textarea rows="10" name="message" class="w-full outline-none rounded-md border border-black py-2 px-4 bg-white"></textarea>
          </div>
          <button class="w-full bg-black-v1 text-white text-sm uppercase font-medium rounded-md py-2">Submit</button>
        </form>
      </div>
    <div>
  </div>
</body>
</html>