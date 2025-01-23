<?php
require_once "db_root.php";

$errors = [];
$success_message = '';

if (isset($_POST['addRoomTypeBtn'])) {
    $room_type = trim($_POST['room_type']);

    // Validate inputs
    if (empty($room_type)) {
        $errors['room_type'] = "Room Type is required.";
    }

    if (empty($errors)) {
        // Insert room type data into the database
        $insert = "INSERT INTO add_room_type (room_type) values('$room_type') ";
        if (mysqli_query($db_conn, $insert)) {
            $success_message = "Room type added successfully!";
            header("location:main_dashboard.php?page=room_type&success_message=$success_message");
            exit; // Make sure the script stops after redirect
        } else {
            echo "<p class='text-red-500'>Error: " . mysqli_error($db_conn) . "</p>";
        }
    }
}

// delete room Type 
if (isset($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    $isDeleted = "DELETE FROM add_room_type WHERE id = $deletedId";
    if (mysqli_query($db_conn, $isDeleted)) {
        $success_message = "Room type deleted successfully!";
        // Redirect after successful deletion
        header("location:main_dashboard.php?page=room_type&success_message=$success_message");
        exit; // Make sure the script stops after redirect
    } else {
        echo "<p class='text-red-500'>Error: " . mysqli_error($db_conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Room type</title>
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
        .inStyle:is(:focus) {
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #3b82f6, #9333ea) 1;
            border-radius: 5px;
        }

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

<body class="">
    <?php if (isset($_GET['success_message'])) { ?>
        <div id="successMessage" class="toast toast-top toast-center toast-visible z-30">
            <div class="alert alert-success">
                <span class="text-white"><?= htmlspecialchars($_GET['success_message']) ?></span>
            </div>
        </div>
    <?php } ?>
    <section class="pt-10">
        <section class="w-full py-10 " id="form_container">

            <form action="" method="post" enctype="multipart/form-data"
                class="max-w-lg md:mx-auto mx-4 md:p-8 px-4 py-4 rounded-xl hover:shadow-2xl transition-shadow duration-300 main_form">

                <!-- logo  -->
                <div class="flex justify-center mb-3">
                    <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
                </div>

                <h2 class="text-2xl font-bold text-center mb-4 uppercase titel_content">Add Room Types</h2>

                <!-- === Name Fields ==== -->
                <div class="grid grid-cols-1 gap-3 mb-4">
                    <div>
                        <input type="text" name="room_type" id="room_type" placeholder="Room Type Name"
                            class="py-3 px-4 border-2 bg-transparent border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                            value="<?= isset($room_type) ? htmlspecialchars($room_type) : '' ?>">
                        <small class="text-red-500"><?= $errors['room_type'] ?? '' ?></small>
                    </div>
                </div>

                <!-- === Add room types Button ==== -->
                <div>
                    <button type="submit" name="addRoomTypeBtn" id="addRoomTypeBtn"
                        class="relative flex justify-center items-center w-full py-3  border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                        <span
                            class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                        <span class="relative z-10 uppercase  titel_content">Add Room Type</span>
                    </button>
                </div>
            </form>
        </section>
        <!-- show details  -->
        <section class="">
            <div class="overflow-x-auto">
                <table class="max-w-lg md:mx-auto mx-4 table table-xs md:table-md mb-20">
                    <thead>
                        <tr
                            class="bg-[--secondary-color] text-[--primary-color] border-b border-gray-200 text-center text-xs md:text-sm font-thin">
                            <th>SL</th>
                            <th>Room Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[--primary-color]">
                        <?php
                        $getroomTypes = $db_conn->query("select * from add_room_type");
                        if ($getroomTypes->num_rows > 0) {
                            $counter = 1;
                            while (list($id, $room_type_name) = $getroomTypes->fetch_row()) {
                                echo "
                        <tr class=' text-xs md:text-sm text-center'>
                            <td>$counter</td>
                            <td>$room_type_name</td>
                            <td>
                             <a href='main_dashboard.php?page=room_type&deleteId=$id' data-tip='Delete Room Type' class='tooltip px-3 py-1 rounded-md text-xs md:text-sm border border-red-500 font-medium hover:text-white hover:bg-red-500 transition duration-150'>
                                    <i class='fa-solid fa-trash-can'></i>
                                </a>
                            </td>
                        </tr>
                    ";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>Room Types not found</td></tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </section>
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