<?php
require_once "db_root.php";
$success_message = '';
$errors = [];
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no user is logged in
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $db_conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
}

if (isset($_GET['bookId'])) {
    $paymentId = $_GET['bookId'];
}

// Fetch booking data for the user
$getBookData = $db_conn->prepare("SELECT * FROM bookings WHERE id = ?");
$getBookData->bind_param("i", $paymentId);
$getBookData->execute();
$bookResult = $getBookData->get_result();
if ($bookResult->num_rows > 0) {
    $booking = $bookResult->fetch_assoc();
} else {
    echo "No bookings found.";
    exit;
}

$is_admin = $user;
$receiver_name = "";
if ($is_admin) {
    // Fetch admin name from users table
    $admin_sql = "SELECT name FROM users WHERE role = 'admin' LIMIT 1";
    $admin_result = $db_conn->query($admin_sql);
    if ($admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();
        $receiver_name = $admin['name'];
    }
}

if (isset($_POST['paymentBtn'])) {
    $providerId = $_POST['userId'];
    $providerName = $_POST['u_name'];
    $providerEmail = $_POST['email'];
    $room_type = $_POST['room_type'];
    $room_number = $_POST['room_number'];
    $paid_total_price = $_POST['total_price'];
    $payment_method = $_POST['payment_method'];
    $receiver_name = $_POST['reciver_name'];
    $booking_id = $_POST['booking_id'];

    if (empty($payment_method)) {
        $errors['payment_method'] = "Payment Method are required.";
    }
    if (empty($errors)) {
        // Insert payment into payment_history
        $insertPayment = "INSERT INTO payment_history (booking_id, user_id, name, email, room_type, room_number, paid_amount, payment_method, reciver_name) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $db_conn->prepare($insertPayment);
        $stmt->bind_param("iisssidss", $booking_id, $providerId, $providerName, $providerEmail, $room_type, $room_number, $paid_total_price, $payment_method, $receiver_name);

        if ($stmt->execute()) {
        // Update booking payment status
        $updateBooking = "UPDATE bookings SET payment_status = 'paid' WHERE user_id = ? AND room_number = ?";
        $updateStmt = $db_conn->prepare($updateBooking);
        $updateStmt->bind_param("ii", $providerId, $room_number);

        if ($updateStmt->execute()) {
        $success_message = "Payment Paid successfully!";
        header("location:user_dashboard.php?page=payment_history&success_message=$success_message");
        exit;
        } else {
        echo "<p class='text-red-500'>Error updating booking: " . $updateStmt->error . "</p>";
        }
        } else {
        echo "<p class='text-red-500'>Error inserting payment: " . $stmt->error . "</p>";
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <!-- Tailwind CSS plugin CDN link (DaisyUI) -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- Font Awesome link -->
    <script src="https://kit.fontawesome.com/9ce82b2c02.js" crossorigin="anonymous"></script>
    <!-- Tailwind CSS CDN link -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CDN link CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .main_form {
            box-shadow: rgba(0, 0, 0, 0.45) 0px 2px 8px;
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
    <?php if (isset($_GET['success_message'])) { ?>
        <div id="successMessage" class="toast toast-top toast-center toast-visible z-30">
            <div class="alert alert-success">
                <span class="text-white"><?= htmlspecialchars($_GET['success_message']) ?></span>
            </div>
        </div>
    <?php } ?>

    <section class="w-full py-20 min-h-[100vh] titel_content" id="form_container">
        <form action="" method="post" enctype="multipart/form-data"
            class="max-w-lg md:mx-auto mx-4 md:p-8 px-4 py-4 rounded-xl hover:shadow-2xl transition-shadow duration-300 main_form">

            <!-- logo -->
            <div class="flex justify-center mb-3">
                <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
            </div>

            <h2 class="text-2xl font-bold text-center mb-4 uppercase">Payment</h2>
            <input type="hidden" name="userId" id="userId" value="<?php echo htmlspecialchars($user['id']) ?>">
            <input type="hidden" name="booking_id" id="booking_id" value="<?php echo htmlspecialchars($booking['id']) ?>">
            <!-- Name and Email Fields -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="u_name" id="u_name" placeholder="Name"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($user['name']); ?>" readonly required>
                </div>
                <div>
                    <input type="email" name="email" id="email" placeholder="Email Address"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($user['email']); ?>" readonly required>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="room_type" id="room_type" placeholder="Room Type"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($booking['room_type']); ?>" readonly required>
                </div>
                <div>
                    <input type="text" name="room_number" id="room_number" placeholder="Room Number"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($booking['room_number']); ?>" readonly required>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="total_price" id="total_price" placeholder="Room Total Price"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($booking['total_amount']); ?>" readonly required>
                </div>
                <div>
                    <input type="text" name="reciver_name" id="reciver_name" placeholder="Receiver Name"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($receiver_name); ?>" readonly required>
                </div>
            </div>

            <div>
                <select name="payment_method" id="payment_method" placeholder="Payment Method"
                    class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none">
                    <option value="" selected>Choose Payment Method</option>
                    <option value="SSL">SSL</option>
                    <option value="PayPal">PayPal</option>
                </select>
                <small class="text-red-500"><?= $errors['payment_method'] ?? '' ?></small>
            </div>

            <!-- Submit Button -->
            <div class="mt-3">
                <button type="submit" name="paymentBtn" id="payment"
                    class="relative flex justify-center items-center w-full py-3 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                    <span
                        class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    <span class="relative z-10 uppercase">Pay</span>
                </button>
            </div>
        </form>
    </section>

   
    <script>
        // Automatically hide the success message after 2 seconds
        setTimeout(function () {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.classList.remove('toast-visible');
                successMessage.classList.add('toast-hidden');
            }
        }, 2000);
    </script>
</body>

</html>