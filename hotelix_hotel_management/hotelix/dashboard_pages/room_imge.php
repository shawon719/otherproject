<?php
$results_per_page = 10;
$subpage = isset($_GET['subpage']) && (int) $_GET['subpage'] > 0 ? (int) $_GET['subpage'] : 1;

$start_from = intval(($subpage - 1) * $results_per_page);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Images</title>
    <!-- FancyBox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
</head>

<body>
    <section class="py-20">
        <h3 class="titel_content text-4xl uppercase text-center">Room Images</h3>
        <div class="overflow-x-auto">
            <table class="max-w-xl md:mx-auto mx-4 table table-xs md:table-md mb-20">
                <thead>
                    <tr
                        class="bg-[--secondary-color] text-[--primary-color] border-b border-gray-200 text-center text-xs md:text-sm font-thin">
                        <th>SL</th>
                        <th>RoomId</th>
                        <th>Room Type</th>
                        <th>Room Images</th>
                    </tr>
                </thead>
                <tbody class="bg-[--primary-color]">
                    <?php
                    $getroomsInfo = $db_conn->query("SELECT * FROM rooms LIMIT $start_from, $results_per_page");
                    if ($getroomsInfo->num_rows > 0) {
                        $counter = $start_from + 1;
                        while ($row = $getroomsInfo->fetch_assoc()) {
                            $id = $row['id'];
                            $room_type = $row['room_type'];
                            $photo = $row['room_photo'];
                            $photo_mime = $row['room_mime_type'];
                            $base64_photo = base64_encode($photo);
                            echo "
                                <tr class='text-xs md:text-sm text-center'>
                                    <td>$counter</td>
                                    <td>$id</td>
                                    <td class='font-medium'>$room_type</td>
                                    <td class='flex justify-center items-center'>
                                        <a data-fancybox='gallery' href='data:$photo_mime;base64,$base64_photo'>
                                            <img class='h-16 w-16 object-cover rounded-full' 
                                                src='data:$photo_mime;base64,$base64_photo' alt='Room Photo'>
                                        </a>
                                    </td>
                                </tr>
                            ";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Rooms not found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-center">
                <?php
                $result = $db_conn->query("SELECT COUNT(id) AS total FROM rooms");
                $row = $result->fetch_assoc();
                $total_records = $row['total'];

                $total_pages = ceil($total_records / $results_per_page);
                $visible_pages = 3; // Maximum number of pagination tabs to display
                $subpage = isset($_GET['subpage']) && (int) $_GET['subpage'] > 0 ? (int) $_GET['subpage'] : 1;

                $start_page = max(1, $subpage - floor($visible_pages / 2));
                $end_page = min($total_pages, $start_page + $visible_pages - 1);

                $start_page = max(1, $end_page - $visible_pages + 1);
                // Display "Previous" button
                if ($subpage > 1) {
                    echo "<a href='main_dashboard.php?page=room_imge&subpage=" . ($subpage - 1) . "' class='mx-2 px-4 py-2 border rounded-md bg-gray-200 text-gray-700'>&laquo; Previous</a>";
                }
                // Display page numbers
                for ($i = $start_page; $i <= $end_page; $i++) {
                    echo "<a href='main_dashboard.php?page=room_imge&subpage=$i' class='mx-2 px-4 py-2 border rounded-md " . ($subpage == $i ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700') . "'>$i</a>";
                }
                // Display "Next" button
                if ($subpage < $total_pages) {
                    echo "<a href='main_dashboard.php?page=room_imge&subpage=" . ($subpage + 1) . "' class='mx-2 px-4 py-2 border rounded-md bg-gray-200 text-gray-700'>Next &raquo;</a>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- FancyBox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</body>

</html>