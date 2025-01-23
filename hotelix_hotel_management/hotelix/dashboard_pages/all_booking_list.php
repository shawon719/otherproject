<?php
require_once "db_root.php";
$success_message = '';
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no user is logged in
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$results_per_page = 10;
$subpage = isset($_GET['subpage']) && (int) $_GET['subpage'] > 0 ? (int) $_GET['subpage'] : 1;

$start_from = intval(($subpage - 1) * $results_per_page);

// Delete Bed Type
if (isset($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    $isDeleted = "DELETE FROM rooms WHERE id = $deletedId";
    if (mysqli_query($db_conn, $isDeleted)) {
        $success_message = "Room deleted successfully!";
        header("location:main_dashboard.php?page=room_list&success_message=$success_message");
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
            <table class="max-w-lg md:mx-auto mx-4 table table-xs md:table-md mb-20">
                <caption class="text-3xl mb-3 uppercase titel_content">Booking List</caption>
                <thead>
                    <tr
                        class="bg-[--secondary-color] text-[--primary-color] border-b border-gray-200 text-center text-xs md:text-sm font-thin">
                        <th>SL</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Booking Date</th>
                        <th>Checkin Date</th>
                        <th>Checkout Date</th>
                        <th>Payment Status</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-[--primary-color]">
                    <?php
                    // Fetch bookings with LIMIT for pagination
                    $getBookData = $db_conn->query("SELECT * FROM bookings ORDER BY booking_date DESC LIMIT $start_from, $results_per_page");
                    if ($getBookData->num_rows > 0) {
                        $counter = $start_from + 1; // Adjust counter for the current page
                        while ($row = $getBookData->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['user_name'];
                            $Email = $row['user_email'];
                            $room_type = $row['room_type'];
                            $room_number = $row['room_number'];
                            $booking_date = $row['booking_date'];
                            $checkin_date = $row['checkin_date'];
                            $checkout_date = $row['checkout_date'];
                            $payment_status = $row['payment_status'];
                            $total_amount = $row['total_amount'];

                            echo "
                        <tr class=' text-xs md:text-sm text-center'>
                            <td>$counter</td>
                            <td>$name</td>
                            <td>$Email</td>
                            <td>$room_type</td>
                            <td>$room_number</td>
                            <td>$booking_date</td>
                            <td>$checkin_date</td>
                            <td>$checkout_date</td>
                            <td>$payment_status</td>
                            <td>$total_amount</td>
                        </tr>
                    ";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No Booking found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-center">
                <?php
                $result = $db_conn->query("SELECT COUNT(id) AS total FROM bookings");
                $row = $result->fetch_assoc();
                $total_records = $row['total'];

                $total_pages = ceil($total_records / $results_per_page);
                $visible_pages = 3; // Maximum number of pagination tabs to display
                $subpage = isset($_GET['subpage']) && (int) $_GET['subpage'] > 0 ? (int) $_GET['subpage'] : 1;

                // Calculate the range of pages to display
                $start_page = max(1, $subpage - floor($visible_pages / 2));
                $end_page = min($total_pages, $start_page + $visible_pages - 1);

                // Adjust start_page if we're near the end
                $start_page = max(1, $end_page - $visible_pages + 1);

                // Display "Previous" button
                if ($subpage > 1) {
                    echo "<a href='main_dashboard.php?page=all_booking_list&subpage=" . ($subpage - 1) . "' class='mx-2 px-4 py-2 border rounded-md bg-gray-200 text-gray-700'>&laquo; Previous</a>";
                }

                // Display page numbers
                for ($i = $start_page; $i <= $end_page; $i++) {
                    echo "<a href='main_dashboard.php?page=all_booking_list&subpage=$i' class='mx-2 px-4 py-2 border rounded-md " . ($subpage == $i ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700') . "'>$i</a>";
                }

                // Display "Next" button
                if ($subpage < $total_pages) {
                    echo "<a href='main_dashboard.php?page=all_booking_list&subpage=" . ($subpage + 1) . "' class='mx-2 px-4 py-2 border rounded-md bg-gray-200 text-gray-700'>Next &raquo;</a>";
                }
                ?>
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
    </script>
</body>

</html>