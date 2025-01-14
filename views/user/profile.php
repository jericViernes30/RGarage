
<?php
    // Fetch user data from the database using the session user_id
    $userId = $_SESSION['user']['user_id'];
    $conn = new mysqli('localhost', 'root', '', 'buy_n_sell');

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT email_address, contact_number, address FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="/RGarage/src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-200 min-h-screen overflow-y-auto text-black-v1 relative">
    <div class="sticky top-0 left-0 z-50">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/RGarage/views/components/header.php');
        ?>
    </div>
    <div class="w-1/2 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white drop-shadow-2xl rounded-lg py-10">
        <div class="w-10/12 mx-auto">
          <div>
            <div class="mb-5">
              <div class="w-[170px] h-[170px] border-2 bg-white rounded-full block mx-auto">
                  <img src="/RGarage/public/images/profile_pictures/<?php echo $_SESSION['user']['profile']?>" alt="" class="rounded-full w-full h-full object-cover">
              </div>
            </div>
            <div class="w-full flex justify-center items-center gap-2 mb-5">
              <p class="text-black-v1 text-center font-bold text-2xl"><?php echo $_SESSION['user']['last_name'].', '.$_SESSION['user']['first_name']?></p>
              <button id="editButton">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/></svg>
              </button>
              <button id="checkButton" class="hidden">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  width="20" height="20"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
              </button>
            </div>
            <div class="w-full flex gap-2">
              <div class="mt-5 text-left w-1/2">
                <p class="text-sm text-gray-700 mb-2">Email Address</p>
                <p class="text-black-v1 overflow-x-auto bg-white font-semibold text-lg py-3 px-2 w-full border border-[#7e7e7e] rounded-md"><?php echo $user['email_address']; ?></p>
              </div>
              <div class="mt-5 text-left w-1/2">
                <p class="text-sm text-gray-700 mb-2">Contact Number</p>
                <input type="text" class="text-black-v1 bg-white font-semibold text-lg py-3 px-2 w-full border border-[#7e7e7e] rounded-md" id="contact" value="<?php echo $user['contact_number']; ?>" readonly>
              </div>
            </div>
            <div class="mt-5 text-left">
              <p class="text-sm text-gray-700 mb-2">Home Address</p>
              <input type="text" class="text-black-v1 bg-white font-semibold text-lg py-3 px-2 w-full border border-[#7e7e7e] rounded-md" id="address" value="<?php echo $user['address']; ?>" readonly>
              <input type="hidden" id="userId" name="id" value="<?php echo $userId; ?>">
            </div>
            </div>
          </div>
        </div>
    </div>
    <script>
  $(document).ready(function () {
    $('#editButton').click(function () {
      $('input').removeAttr('readonly');
      $('#editButton').addClass('hidden');
      $('#checkButton').removeClass('hidden');
    });

    $('#checkButton').click(function () {
      var userId = $('#userId').val();
      var contact = $('#contact').val();
      var address = $('#address').val();

      // Log userId for debugging
      console.log("User ID: ", userId);

      if (!userId) {
        alert('User ID is missing. Please try again.');
        return;
      }

      $.ajax({
        url: '/RGarage/user/update-profile',
        type: 'POST',
        data: {
          id: userId,
          contact: contact,
          address: address
        },
        success: function (response) {
          var fetchId = userId;
          console.log("User ID: ", fetchId);
          console.log(response);
          alert('Profile updated successfully');
        },
        error: function (xhr, status, error) {
          alert('Error updating profile');
          console.log("Error: " + error);
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>

</body>
</html>