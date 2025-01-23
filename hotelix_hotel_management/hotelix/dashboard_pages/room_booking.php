<?php
ob_start();
// Include necessary files and setup page variables
require_once('../shared/header.php');
require_once('../components/banner_hook.php');
$page = 'Booking';
$banner = $pageBanners[$page];

function renderBanner($bannerImage, $title, $subtitle)
{
    echo "
    <div class='relative lg:h-[600px] h-[400px] w-full bg-cover bg-center bg-no-repeat' style='background-image: url($bannerImage);'>
        <div class='bg-black bg-opacity-60 w-full h-full p-6 text-center flex flex-col items-center justify-center'>
            <h1 class='md:text-6xl text-4xl font-bold text-white uppercase titel_content'>$title</h1>
            <p class='text-lg text-gray-300 mt-2 font-bold uppercase'>$subtitle</p>
        </div>
    </div>";
}
renderBanner($banner['bannerImage'], $banner['title'], $banner['subtitle']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotelix || Room Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/9ce82b2c02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .toast {
            transition: opacity 2s ease-in-out;
        }

        .toast-hidden {
            opacity: 0;
            visibility: hidden;
        }

        .toast-visible {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body>
    <section>
        <?php
        $success_message = '';
        $error_message = '';
        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
            // Store the current URL in the session
            $_SESSION['redirectTo'] = $_SERVER['REQUEST_URI'];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Save dates in session when form is submitted
                $_SESSION['checkin'] = $_POST['checkin'];
                $_SESSION['checkout'] = $_POST['checkout'];
                $_SESSION['room_id'] = $_POST['room_id'];
                $_SESSION['room_type'] = $_POST['room_type'];
                $_SESSION['room_number'] = $_POST['room_number'];
                $_SESSION['price'] = $_POST['price'];
                $room_price = (float) $_POST['price'];
            }
            header("Location: ../../auth/login.php");
            exit;
        }

        $checkinDate = isset($_POST['checkin']) ? $_POST['checkin'] : $_SESSION['checkin'];
        $checkoutDate = isset($_POST['checkout']) ? $_POST['checkout'] : $_SESSION['checkout'];
        $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : $_SESSION['room_id'];
        $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : $_SESSION['room_type'];
        $room_number = isset($_POST['room_number']) ? $_POST['room_number'] : $_SESSION['room_number'];
        $room_price = isset($_POST['price']) ? $_POST['price'] : $_SESSION['price'];

        // Database connection to fetch user data
        include '../../db_root.php';
        $userId = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $db_conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "User not found.";
        }

        // Booking check-in and check-out dates
        if (!isset($_SESSION['checkin'])) {
            $_SESSION['checkin'] = $checkinDate;  // Set a default value if not set
        }
        if (!isset($_SESSION['checkout'])) {
            $_SESSION['checkout'] = $checkoutDate;  // Set a default value if not set
        }
        if (!isset($_SESSION['room_id'])) {
            $_SESSION['room_id'] = $room_id;  // Set a default value if not set
        }
        if (!isset($_SESSION['room_type'])) {
            $_SESSION['room_type'] = $room_type;  // Set a default value if not set
        }
        if (!isset($_SESSION['room_price'])) {
            $_SESSION['price'] = $room_price;
        }
        if (!isset($_SESSION['room_number'])) {
            $_SESSION['room_number'] = $room_number;
        }

        $amount = $room_price;

        if (!empty($checkinDate) && !empty($checkoutDate)) {
            // Calculate the number of nights
            $checkinDateTimestamp = strtotime($checkinDate);
            $checkoutDateTimestamp = strtotime($checkoutDate);

            if ($checkinDateTimestamp === false || $checkoutDateTimestamp === false) {
                die('Invalid check-in or check-out date.');
            }

            $nights = (float) ($checkoutDateTimestamp - $checkinDateTimestamp) / (60 * 60 * 24);

            if ($nights <= 0) {
                die('Check-out date must be after check-in date.');
            }
            $room_price = (float) $room_price;
            $amount = $nights * $room_price;
        }

        // Handle form submission to store booking details
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkoutBtn'])) {
            $payment_status = 'pending';
            $userName = $_POST['u_name'];
            $userEmail = $_POST['email'];
            $number = $_POST['number'];
            // var_dump($userName, $userEmail, $number);
        
            $sqlInsert = "INSERT INTO bookings (user_id, user_name, user_email, user_number, room_id, room_type, room_number, checkin_date, checkout_date, payment_status, per_amount, total_amount)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtInsert = $db_conn->prepare($sqlInsert);
            $stmtInsert->bind_param("isssisssssdd", $userId, $userName, $userEmail, $number, $room_id, $room_type, $room_number, $checkinDate, $checkoutDate, $payment_status, $room_price, $amount);
            if ($stmtInsert->execute()) {
                // update status after booking 
                // $UpdateRoomStatus = "UPDATE rooms set av_status = 'booked' where id = ?";
                // $stmtUpdateRoomStatus = $db_conn->prepare("$UpdateRoomStatus");
                // $stmtUpdateRoomStatus->bind_param("i", $room_id);
                // $stmtUpdateRoomStatus->execute();
        
                $success_message = "Room Booking successfully!";
                header('location: ../../user_dashboard.php?page=display_booking&success_message=' . urlencode($success_message));
            } else {
                echo "<p class='text-red-500'>Error: " . $stmtInsert->error . "</p>";
            }
        }

        ?>


        <div class="">
            <?php if (isset($_GET['success_message'])) { ?>
                <div id="successMessage" class="toast toast-top toast-center toast-visible z-30">
                    <div class="alert alert-success">
                        <span class="text-white"><?= htmlspecialchars($_GET['success_message']) ?></span>
                    </div>
                </div>
            <?php } ?>

            <div class="grid grid-cols-2 gap-5 w-full max-w-7xl mx-auto p-4">
                <!-- Info Card Section -->

                <div
                    class=" p-8 text-center rounded-xl shadow-xl hover:shadow-2xl transition-shadow duration-300 titel_content">
                    <h3 class="text-4xl font-semibold titel_content mb-6 uppercase">Booking Details</h3>
                    <p class="text-xl font-medium mb-2">Room Type: <span
                            class=""><?= htmlspecialchars($room_type); ?></span></p>
                    <p class="text-xl font-medium mb-2">Room Number: <span
                            class=""><?= htmlspecialchars($room_number); ?></span></p>
                    <p class="text-xl font-medium mb-2">Check-in Date: <span
                            class=""><?= htmlspecialchars($checkinDate); ?></span></p>
                    <p class="text-xl font-medium mb-2">Check-out Date: <span
                            class=""><?= htmlspecialchars($checkoutDate); ?></span></p>
                    <p class="text-xl font-medium mb-2">Room Price: <span
                            class=""><?= htmlspecialchars($room_price); ?></span></p>
                    <p class="text-xl font-medium mb-2">Total Amount: <span
                            class=""><?= htmlspecialchars($amount); ?></span></p>
                </div>

                <!-- Booking Form Section -->
                <div class="card w-full shrink-0 rounded-xl hover:shadow-2xl transition-shadow duration-300">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="mx-4 md:p-8 px-4 py-4 rounded-xl main_form">
                        <div class="flex justify-center mb-3">
                            <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
                        </div>
                        <h2 class="text-2xl font-bold text-center mb-4 uppercase titel_content">Booking Form</h2>

                        <!-- Name & Email Fields -->
                        <div class="grid md:grid-cols-1 gap-3 mb-4">
                            <div>
                                <input type="text" name="u_name" id="u_name" placeholder="Name"
                                    class="py-2 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                                    value="<?php echo htmlspecialchars($user['name']); ?>" readonly required>
                            </div>
                            <div>
                                <input type="email" name="email" id="email" placeholder="Email Address"
                                    class="py-2 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" readonly required>
                                <small class="text-red-500"><?= $errors['email'] ?? '' ?></small>
                            </div>
                        </div>

                        <!-- Phone Number & Profile Photo Fields -->
                        <div class="grid grid-cols-1 gap-3 mb-4">
                            <div>
                                <input type="tel" name="number" id="number" placeholder="Phone Number"
                                    class="py-2 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                                    value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                            </div>
                            <div>
                                <input type="hidden" name="room_id" id="room_id"
                                    value="<?php echo htmlspecialchars($room_id) ?>">
                            </div>
                        </div>

                        <!-- Hidden Fields for Booking Info -->
                        <div class="grid md:grid-cols-2 gap-3">
                            <div>
                                <input type="hidden" name="room_type" id="room_type"
                                    value="<?php echo htmlspecialchars($room_type) ?>">
                            </div>
                            <div>
                                <input type="hidden" name="price" id="price"
                                    value="<?php echo htmlspecialchars($room_price) ?>">
                            </div>
                            <div>
                                <input type="hidden" name="room_number" id="room_number"
                                    value="<?php echo htmlspecialchars($room_number) ?>">
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div>
                                <input type="hidden" name="checkin" id="checkin"
                                    value="<?php echo htmlspecialchars($checkinDate) ?>">
                            </div>
                            <div>
                                <input type="hidden" name="checkout" id="checkout"
                                    value="<?php echo htmlspecialchars($checkoutDate) ?>">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" name="checkoutBtn" id="checkout"
                                class="relative flex justify-center items-center w-full py-3 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                                <span
                                    class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                                <span class="relative z-10 uppercase titel_content">CheckOut</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="main.js"></script>
</body>

</html>

<?php
require_once('../shared/footer.php');
ob_end_flush(); // End output buffering and flush the output
?>