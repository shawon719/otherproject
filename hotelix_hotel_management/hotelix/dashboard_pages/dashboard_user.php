<?php
require_once "db_root.php";
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no user is logged in
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .card {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            transition: all 0.4s ease-out;
            text-decoration: none;
            border: 1px solid #60a5fa;
        }

        .card:hover {
            transform: translateY(-5px) scale(1.005) translateZ(0);
            box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
                0 3px 10px var(--box-shadow-color);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <section class="py-16">
        <h3 class="titel_content text-3xl mb-2">Hello Dashboard!</h3>
        <div class="grid md:grid-cols-2 gap-4">

            <div class="card border border-blue-500 p-4 rounded-lg text-center">
                <span class="text-center mb-3"><i class="fa-solid fa-clipboard-list text-4xl"></i></span>
                <h2 class="text-xl uppercase titel_content">Total Booking List</h2>
                <?php
                $getUsers = $db_conn->query("SELECT * FROM bookings WHERE user_id = $user_id");
                echo "<p class='text-2xl titel_content'>" . $getUsers->num_rows . ' Bookings' . "</p>";
                ?>
                <a href="user_dashboard.php?page=display_booking"
                    class="border border-blue-600 text-center rounded-md py-3 mt-3 font-medium hover:bg-blue-600 hover:text-white transition-all titel_content">View
                    More</a>
            </div>

            <div class="card border border-blue-500 p-4 rounded-lg text-center">
                <span class="text-center mb-3"><i class="fa-solid fa-hand-holding-dollar text-4xl"></i></span>
                <h2 class="text-xl uppercase titel_content">Total Amount</h2>
                <p class="text-2xl font-bold titel_content">$2,258</p>
                <a href=""
                    class="border border-blue-600 text-center rounded-md py-3 mt-3 font-medium hover:bg-blue-600 hover:text-white transition-all titel_content">View
                    More</a>
            </div>
            <!-- Add more cards -->
        </div>
    </section>
</body>

</html>