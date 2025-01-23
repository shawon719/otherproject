<?php
require_once "db_root.php";

$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <!-- Styles and Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/9ce82b2c02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <section class="py-20">
        <div class="overflow-x-auto">
            <table class="max-w-lg md:mx-auto mx-4 table table-xs md:table-md mb-20">
                <caption class="text-3xl mb-3 uppercase titel_content">Room Status List</caption>
                <thead>
                    <tr
                        class="bg-[--secondary-color] text-[--primary-color] border-b border-gray-200 text-center text-xs md:text-sm font-thin">
                        <th>SL</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Checkout Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="bg-[--primary-color]">
                    <?php
                    $query = "
                        SELECT 
                            rooms.id AS room_id,
                            rooms.room_type,
                            rooms.room_number, 
                            bookings.checkout_date 
                        FROM rooms
                        LEFT JOIN bookings ON rooms.room_number = bookings.room_number
                        ORDER BY rooms.room_number ASC
                    ";
                    $result = $db_conn->query($query);

                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            $room_number = $row['room_number'];
                            $room_type = $row['room_type'];
                            $checkout_date = $row['checkout_date'];

                            // Determine room status
                            if (empty($checkout_date)) {
                                $status = "<span class='text-green-500'>Available</span>";
                            } elseif ($checkout_date < $currentDate) {
                                $status = "<span class='text-gray-500'>None</span>";
                            } else {
                                $status = "<span class='text-red-500'>Checkin</span>";
                            }

                            if (strpos($status, 'None') !== false) {
                                continue;
                            }

                            echo "
                                <tr class='text-center text-sm'>
                                    <td>$counter</td>
                                    <td>$room_type</td>
                                    <td>$room_number</td>
                                    <td>" . (!empty($checkout_date) ? $checkout_date : "None") . "</td>
                                    <td>$status</td>
                                </tr>
                            ";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No rooms found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>