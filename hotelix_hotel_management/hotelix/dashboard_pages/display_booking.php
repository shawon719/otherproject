<?php
require_once "db_root.php";
$success_message = '';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no user is logged in
    header("Location: auth/login.php");
    exit;
}


$user_id = $_SESSION['user_id'];

// Delete Bed Type
if (isset($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    $isDeleted = "DELETE FROM bookings WHERE id = $deletedId";
    if (mysqli_query($db_conn, $isDeleted)) {
        $success_message = "Booking Cancle successfully!";
        header("location:user_dashboard.php?page=display_booking&success_message=$success_message");
        exit; // Ensure the script stops after the redirect
    } else {
        echo "<p class='text-red-500'>Error: " . mysqli_error($db_conn) . "</p>";
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
    <!-- Include jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Include html2pdf.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">

    <style>
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

        input {
            padding-left: 10px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
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
    <!-- show details  -->
    <section class="py-20">
        <div class="overflow-x-auto">
            <p class="text-xl mb-2 titel_content">
                <marquee behavior="infinity" direction="left">Please make the payment for the room booking before the
                    payment deadline. The payment deadline is 1 hour. Thank You!</marquee>
            </p>
            <a href="/hotelix_hotel_management" class="border border-blue-500 px-4 py-2 font-medium"><i
                    class="text-[#079d49] fa-solid fa-arrow-left pe-3"></i>Book Room</a>
            <table class="max-w-lg md:mx-auto mx-4 table table-xs md:table-md mb-20">
                <caption class="text-3xl mb-3 uppercase titel_content">Booking List</caption>
                <thead>
                    <tr
                        class="bg-[--secondary-color] text-[--primary-color] border-b border-gray-200 text-center text-xs md:text-sm font-thin">
                        <th>SL</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Booking Date</th>
                        <th>Checkin Date</th>
                        <th>Checkout Date</th>
                        <th>Payment Status</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-[--primary-color]">
                    <?php

                    // Automatically delete pending bookings older than 2 minutes
                    $currentTimestamp = date('Y-m-d H:i:s');
                    $sql = "SELECT id FROM bookings WHERE payment_status = 'pending' AND TIMESTAMPDIFF(MINUTE, booking_date, NOW()) >= 30";
                    $stmt = $db_conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $paymentMethod = '';
                    while ($row = $result->fetch_assoc()) {
                        $bookingId = $row['id'];
                        $paymentStatus = $row['payment_status'];
                        // Delete the booking after 2 minutes if not paid
                        $deleteBookingSql = "DELETE FROM bookings WHERE id = ?";
                        $deleteStmt = $db_conn->prepare($deleteBookingSql);
                        $deleteStmt->bind_param("i", $bookingId);
                        $deleteStmt->execute();

                    }

                    $getBookData = $db_conn->query("SELECT * FROM bookings WHERE user_id = $user_id ORDER BY booking_date DESC");
                    if ($getBookData->num_rows > 0) {
                        $counter = 1;
                        while ($row = $getBookData->fetch_assoc()) {
                            $id = $row['id'];
                            $room_type = $row['room_type'];
                            $user_name = $row['user_name'];
                            $user_email = $row['user_email'];
                            $user_number = $row['user_number'];
                            $room_number = $row['room_number'];
                            $booking_date = $row['booking_date'];
                            $checkin_date = $row['checkin_date'];
                            $checkout_date = $row['checkout_date'];
                            $payment_status = $row['payment_status'];
                            $total_amount = $row['total_amount'];
                            $per_nights = $row['per_amount'];

                            $paymentMethod = 'Not Available';  // Default value
                            if ($payment_status === 'paid') {
                                $getPaymentMethodSql = "SELECT payment_method FROM payment_history WHERE booking_id = ?";
                                $getPaymentMethodStmt = $db_conn->prepare($getPaymentMethodSql);
                                $getPaymentMethodStmt->bind_param("i", $id);
                                $getPaymentMethodStmt->execute();
                                $getPaymentMethodResult = $getPaymentMethodStmt->get_result();

                                if ($getPaymentMethodResult && $getPaymentMethodResult->num_rows > 0) {
                                    $paymentMethodRow = $getPaymentMethodResult->fetch_assoc();
                                    $paymentMethod = $paymentMethodRow['payment_method'];
                                }
                            }

                            echo "
                        <tr class=' text-xs md:text-sm text-center'>
                            <td>$counter</td>
                            <td>$room_type</td>
                            <td>$room_number</td>
                            <td>$booking_date</td>
                            <td>$checkin_date</td>
                            <td>$checkout_date</td>
                            <td>$payment_status</td> 
                            <td>$total_amount</td>
                            <td class='flex gap-3'>";
                            if ($payment_status != 'paid') {
                                echo "<a href='user_dashboard.php?page=payment&bookId=$id' class='px-3 py-1 rounded-md text-xs md:text-sm border border-blue-500 font-medium hover:text-white hover:bg-blue-500 transition duration-150 flex gap-2 justify-center items-center tooltip' data-tip='Payment'>
                                        <i class='fa-solid fa-money-check-dollar'></i>
                                      </a>";
                            }
                                echo "<a class='px-3 py-1 rounded-md text-xs md:text-sm border border-blue-500 font-medium hover:text-white hover:bg-blue-500 transition duration-150 flex gap-2 justify-center items-center tooltip' data-tip='Invoice' 
                                onclick=\"openInvoiceModal($id, '$user_name', '$user_email', '$user_number', '$checkin_date', '$checkout_date', '$booking_date', '$per_nights', '$total_amount', '$room_type', '$room_number', '$paymentMethod')\">
                                        <i class='fa-solid fa-receipt'></i>
                                        </a>";

                            if ($payment_status != 'paid') {
                                echo "<a href='user_dashboard.php?page=display_booking&deleteId=$id' class='px-3 py-1 rounded-md text-xs md:text-sm border border-red-500 font-medium hover:text-white hover:bg-red-500 transition duration-150 flex gap-2 justify-center items-center tooltip' data-tip='Cancel'>
                                        <i class='fa-solid fa-store-slash'></i>
                                      </a>";
                            }

                            // Close the row
                            echo "</td></tr>";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No Booking found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Invoice Modal -->
        <div id="modelConfirm"
            class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
            <div class="relative top-5 left-[20%] shadow-xl rounded-md bg-[--primary-color] max-w-[80%]">
                <div class="flex justify-end mr-3 mt-1">
                    <span onclick="handleInvoice(event)" data-tip='Download' type="button"
                        class="text-gray-400 hover:text-white tooltip bg-transparent hover:bg-blue-800 focus:ring-red-300 font-medium text-base inline-flex items-center text-center p-1">
                        <i class="fa-solid fa-download"></i>
                    </span>
                    <span onclick="closeModal('modelConfirm')" type="button"
                        class="text-gray-400 bg-white hover:bg-gray-200 hover:text-gray-900 text-sm p-1">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </span>
                </div>

                <div class="p-6 pt-0 text-center">
                    <div class="flex justify-center items-center">
                        <img src="<?php echo './assets/hotel_logo/hotelix.png' ?>" class="w-[160px]" alt="">
                    </div>
                    <h3 class="text-3xl font-normal text-gray-500 mt-5 mb-6 titel_content uppercase">Invoice </h3>
                    <div class="">
                        <form method="POST" id="invoiceForm" download>
                            <input type="hidden" id="bookingId" name="bookingId">
                            <div class="divider"></div>
                            <!-- Invoice related info -->
                            <div class="grid md:grid-cols-3 gap-2">
                                <div class="">
                                    <label for="invoiceId"
                                        class="flex justify-start titel_content text-gray-600 ">Invoice
                                        ID</label>
                                    <input type="text" name="invoiceId" id="invoiceId" placeholder="invoice Id"
                                        class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                </div>
                                <div class="">
                                    <label for="invoiceDate"
                                        class="flex justify-start titel_content text-gray-600">Invoice
                                        Date</label>
                                    <input type="text" name="invoiceDate" id="invoiceDate"
                                        value="<?php echo date('Y-m-d'); ?>" placeholder="invoice date"
                                        class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                </div>
                                <div class="">
                                    <label for="invoiceDueDate"
                                        class="flex justify-start titel_content text-gray-600">Invoice Due
                                        Date</label>
                                    <input type="text" name="invoiceDueDate" id="invoiceDueDate"
                                        value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                                        placeholder="invoice due date"
                                        class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="grid md:grid-cols-2 gap-2">
                                <!-- User related info -->
                                <div class="grid gap-2">
                                    <div class="mb-4">
                                        <label for="g_name" class="flex justify-start titel_content text-gray-600">Guest
                                            Name</label>
                                        <input type="text" name="g_name" id="g_name" placeholder="guest name"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="g_email"
                                            class="flex justify-start titel_content text-gray-600">Email</label>
                                        <input type="email" name="g_email" id="g_email" placeholder="Email"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="g_phone"
                                            class="flex justify-start titel_content text-gray-600">Phone</label>
                                        <input type="text" name="g_phone" id="g_phone" placeholder="Phone"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                </div>
                                <!-- Booking related info -->
                                <div class="grid md:grid-cols-2 gap-2">
                                    <div class="mb-4">
                                        <label for="checkin"
                                            class="flex justify-start titel_content text-gray-600">Checkin
                                            Date</label>
                                        <input type="text" name="checkin" id="checkin" placeholder="Check in Date"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="checkout"
                                            class="flex justify-start titel_content text-gray-600">Checkout
                                            Date</label>
                                        <input type="text" name="checkout" id="checkout" placeholder="Check out Date"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="booking_date"
                                            class="flex justify-start titel_content text-gray-600">Booking
                                            Date</label>
                                        <input type="text" name="booking_date" id="booking_date"
                                            placeholder="Booking Date"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="night" class="flex justify-start titel_content text-gray-600">Per
                                            Nights</label>
                                        <input type="text" name="night" id="night" placeholder="Per Nights"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="room_price"
                                            class="flex justify-start titel_content text-gray-600">Room Price
                                        </label>
                                        <input type="text" name="room_price" id="room_price" placeholder="room_price"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="total_amount"
                                            class="flex justify-start titel_content text-gray-600">Total
                                            Amount</label>
                                        <input type="text" name="total_amount" id="total_amount"
                                            placeholder="Total Amount"
                                            class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                    </div>

                                </div>
                            </div>

                            <div class="grid md:grid-cols-3 gap-2">
                                <div class="mb-4">
                                    <label for="room_type" class="flex justify-start titel_content text-gray-600">Room
                                        Type
                                    </label>
                                    <input type="text" name="room_type" id="room_type" placeholder="Room Type"
                                        class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="room_number" class="flex justify-start titel_content text-gray-600">Room
                                        Number</label>
                                    <input type="text" name="room_number" id="room_number" placeholder="Room Number"
                                        class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="payment_met" class="flex justify-start titel_content text-gray-600">Payment Method</label>
                                    <input type="text" name="payment_method" id="payment_method" placeholder="Payment Method" class="rounded-sm w-full bg-gray-50 py-1 text-black" readonly>
                                </div>


                            </div>

                        </form>
                    </div>
                    <p class="text-5xl titel mt-3 text-gray-500">Thank You</p>
                </div>
            </div>
        </div>

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

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.classList.remove('overflow-y-hidden');
        }

        function openInvoiceModal(bookingId, userName, userEmail, userPhone, checkinDate, checkoutDate, bookingDate, perNights, totalAmount, room_type, room_number,paymentMethod) {
            // console.log(paymentMethod)
            document.getElementById('bookingId').value = bookingId;
            document.getElementById('g_name').value = userName;
            document.getElementById('g_email').value = userEmail;
            document.getElementById('g_phone').value = userPhone;
            document.getElementById('checkin').value = checkinDate;
            document.getElementById('checkout').value = checkoutDate;
            document.getElementById('booking_date').value = bookingDate;
            document.getElementById('night').value = perNights;
            document.getElementById('room_price').value = perNights;
            document.getElementById('total_amount').value = totalAmount;
            document.getElementById('room_type').value = room_type;
            document.getElementById('room_number').value = room_number;
            if (paymentMethod) {
                document.getElementById('payment_method').value = paymentMethod;
            } else {
                document.getElementById('payment_method').value = "Not Available";
            }

            if (perNights > 0) {
                const pricePerNight = (totalAmount / perNights);
                document.getElementById('night').value = pricePerNight;
            } else {
                document.getElementById('night').value = 0;
            }

            // Set Invoice ID as Booking ID
            const randomInvoiceId = 'INV-' + Math.floor(Math.random() * 1000000);
            document.getElementById('invoiceId').value = randomInvoiceId;

            document.getElementById('modelConfirm').style.display = 'block';
            document.body.classList.add('overflow-y-hidden');
        }

        // Handle the generation of PDF
        function handleInvoice(event) {
            event.preventDefault();

            const invoiceModal = document.getElementById('modelConfirm');
            const invoiceContent = invoiceModal.querySelector('.p-6');

            // Use html2pdf to generate the PDF
            const options = {
                margin: 10,
                filename: 'invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { dpi: 192, letterRendering: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().from(invoiceContent).set(options).save();
        }

    </script>
</body>

</html>