<?php
require_once "db_root.php";

$errors = [];
$success_message = '';

if (isset($_POST['addRoomBtn'])) {
    $room_name = trim($_POST['room_name']);
    $room_number = trim($_POST['room_number']);
    $bed_type = trim($_POST['bed_type']);
    $price = trim($_POST['price']);
    $view = trim($_POST['view']);
    $floor_number = trim($_POST['floor_number']);
    $room_size = trim($_POST['room_size']);
    $desription = trim($_POST['describ']);
    $capacity = trim($_POST['capacity']);
    $uploaded_photo = $_FILES['upload_photo'];
    $default_status = 'Available';

    // Validate inputs
    if (empty($room_name)) {
        $errors['room_name'] = "Room name is required.";
    }
    if (empty($room_number)) {
        $errors['room_number'] = "Room number is required.";
    }
    if (empty($view)) {
        $errors['view'] = "Room View is required.";
    }

    if (empty($desription)) {
        $errors['describ'] = "Description is required.";
    }
    if (empty($bed_type)) {
        $errors['bed_type'] = "bed_type is required.";
    }
    if (empty($floor_number)) {
        $errors['floor_number'] = "floor_number is required.";
    }

    if (empty($room_size)) {
        $errors['room_size'] = "room_size is required.";
    }
    if (empty($capacity)) {
        $errors['capacity'] = "Capacity is required.";
    }
    if (empty($price)) {
        $errors['price'] = "Price is required.";
    }

    // Validate uploaded photo
    if ($uploaded_photo['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['upload_photo'] = "Photo is required.";
    } else {
        $allowed_exten = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_size_limit = 700 * 1024; // 400 KB
        $file_exten = strtolower(pathinfo($uploaded_photo['name'], PATHINFO_EXTENSION));
        $mime_type = mime_content_type($uploaded_photo['tmp_name']);

        if (!in_array($file_exten, $allowed_exten) || !in_array($mime_type, $allowed_mime_types)) {
            $errors['upload_photo'] = "Invalid file format. Only JPG, PNG, or GIF are allowed.";
        } elseif ($uploaded_photo['size'] > $file_size_limit) {
            $errors['upload_photo'] = "File size must not exceed 700 KB.";
        } else {
            // Safely handle file content
            $photo_content = file_get_contents($uploaded_photo['tmp_name']);
            if ($photo_content === false) {
                $errors['upload_photo'] = "Error reading the uploaded file.";
            }
        }
    }
    if (empty($errors)) {

        $insertRoom = $db_conn->prepare("INSERT INTO rooms (room_type, room_number, price_per_night, av_status, room_size, view, floor_number, room_desc,room_mime_type,room_photo,bed_type,capacity) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)");

        $insertRoom->bind_param("ssssssssssss", $room_name, $room_number, $price, $default_status, $room_size, $view, $floor_number, $desription, $mime_type, $photo_content, $bed_type, $capacity);

        if ($insertRoom->execute()) {
            $success_message = "Room added successfully!";
            header("location:main_dashboard.php?page=room_list&success_message=$success_message");
            exit;
        } else {
            echo "<p class='text-red-500'>Error: " . $stmt->error . "</p>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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

        * {
            scrollbar-width: thin;
            scrollbar-color: gray !important;
        }

        ::-webkit-scrollbar-track {
            background: blue;
        }

        ::-webkit-scrollbar-thumb {
            background-color: blue;
        }

        .inStyle:is(:focus) {
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #3b82f6, #9333ea) 1;
            border-radius: 5px;
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
    <section class="w-full py-20 min-h-[100vh]" id="form_container">

        <form action="" method="post" enctype="multipart/form-data"
            class="max-w-lg md:mx-auto mx-4 md:p-8 px-4 py-4 rounded-xl hover:shadow-2xl transition-shadow duration-300 main_form">

            <!-- logo  -->
            <div class="flex justify-center mb-3">
                <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
            </div>

            <h2 class="text-2xl font-bold text-center mb-4 uppercase titel_content">Add Rooms </h2>

            <!-- === Name Fields ==== -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <select name="room_name" id="room_name"
                        class='w-full py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg focus:outline-none inStyle text-gray-700'>
                        <option value='' selected>Select Room Type</option>
                        <?php
                        $getroomType = $db_conn->query("select * from add_room_type");
                        while (list($roomId, $room_type) = $getroomType->fetch_row()) {
                            echo "
                                    <option value='$room_type'>$room_type</option>
                                ";
                        }
                        ?>
                    </select>
                    <small class="text-red-500"><?= $errors['room_name'] ?? '' ?></small>
                </div>
                <div>
                    <input type="text" name="room_number" id="room_number" placeholder="Room Number"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($room_number) ? htmlspecialchars($room_number) : '' ?>">
                    <small class="text-red-500"><?= $errors['room_number'] ?? '' ?></small>
                </div>
            </div>
            <!-- ===  ==== -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="price" id="price" placeholder="Room Price"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($price) ? htmlspecialchars($price) : '' ?>">
                    <small class="text-red-500"><?= $errors['price'] ?? '' ?></small>
                </div>

                <div>
                    <select name="bed_type" id="bed_type"
                        class='w-full py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg focus:outline-none inStyle text-gray-700'>
                        <option value='' selected>Select Bed Type</option>
                        <?php
                        $getbedType = $db_conn->query("select * from add_bed_type");
                        while (list($bedId, $bed_type) = $getbedType->fetch_row()) {
                            echo "
                                    <option value='$bed_type'>$bed_type</option>
                                ";
                        }
                        ?>
                    </select>
                    <small class="text-red-500"><?= $errors['bed_type'] ?? '' ?></small>
                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="room_size" id="room_size" placeholder="Room Size"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($room_size) ? htmlspecialchars($room_size) : '' ?>">
                    <small class="text-red-500"><?= $errors['room_size'] ?? '' ?></small>
                </div>
                <div>
                    <input type="text" name="floor_number" id="floor_number" placeholder="Floor Number"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($floor_number) ? htmlspecialchars($floor_number) : '' ?>">
                    <small class="text-red-500"><?= $errors['floor_number'] ?? '' ?></small>
                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="view" id="view" placeholder="View"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($view) ? htmlspecialchars($view) : '' ?>">
                    <small class="text-red-500"><?= $errors['view'] ?? '' ?></small>
                </div>

                <div>
                    <input type="text" name="capacity" id="capacity" placeholder="Room Capacity"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($capacity) ? htmlspecialchars($capacity) : '' ?>">
                    <small class="text-red-500"><?= $errors['$capacity'] ?? '' ?></small>
                </div>

            </div>

            <div>
                <div>
                    <textarea name="describ" id="describ" placeholder="Description" cols="2" rows="1"
                        class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($desription) ? htmlspecialchars($desription) : '' ?>"></textarea>
                    <small class="text-red-500"><?= $errors['describ'] ?? '' ?></small>
                </div>
                <!-- ==== Upload Profile Photo ==== -->
                <div div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Upload Photo</label>
                    <input type="file" name="upload_photo" id="upload_photo"
                        class="file-input w-full file-input-ghost bg-gray-200 outline-none">
                    <small class="text-red-500"><?= $errors['upload_photo'] ?? '' ?></small>
                </div>
            </div>

            <!-- === Register Button ==== -->
            <div>
                <button type="submit" name="addRoomBtn" id="addroom"
                    class="relative flex justify-center items-center w-full py-3  border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                    <span
                        class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    <span class="relative z-10 uppercase  titel_content">Add Room</span>
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