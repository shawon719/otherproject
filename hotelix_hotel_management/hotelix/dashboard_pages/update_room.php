<?php
$errors = [];
$success_message = '';
// get and show 
if (isset($_GET['updateId'])) {
    $updateRoomId = $_GET['updateId'];
    $showRoomData = "SELECT * FROM rooms WHERE id = $updateRoomId";
    $query = mysqli_query($db_conn, $showRoomData);
    $roomData = mysqli_fetch_assoc($query);

    $room_type = $roomData['room_type'];
    $room_number = $roomData['room_number'];
    $bed_type = $roomData['bed_type'];
    $price = $roomData['price_per_night'];
    $view = $roomData['view'];
    $floor_number = $roomData['floor_number'];
    $room_size = $roomData['room_size'];
    $desription = $roomData['room_desc'];
    $capacity = $roomData['capacity'];
    $photo = $roomData['room_photo'];
    $photo_mime = $roomData['room_mime_type'];
    $base64_photo = base64_encode($photo);
}

// update 
if (isset($_POST['updateRoomBtn'])) {
    $ed_room_type = trim($_POST['room_type']);
    $ed_room_number = trim($_POST['room_number']);
    $ed_bed_type = trim($_POST['bed_type']);
    $ed_price = trim($_POST['price']);
    $ed_view = trim($_POST['view']);
    $ed_floor_number = trim($_POST['floor_number']);
    $ed_room_size = trim($_POST['room_size']);
    $ed_desription = trim($_POST['describ']);
    $ed_capacity = trim($_POST['capacity']);
    $uploaded_photo = $_FILES['upload_photo'];

    $photo_content = null;
    $mime_type = null;

    if ($uploaded_photo['error'] === UPLOAD_ERR_OK) {
        $allowed_exten = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_size_limit = 700 * 1024; // 700 KB
        $file_exten = strtolower(pathinfo($uploaded_photo['name'], PATHINFO_EXTENSION));
        $mime_type = mime_content_type($uploaded_photo['tmp_name']);

        if (!in_array($file_exten, $allowed_exten) || !in_array($mime_type, $allowed_mime_types)) {
            $errors['upload_photo'] = "Invalid file format. Only JPG, PNG, or GIF are allowed.";
        } elseif ($uploaded_photo['size'] > $file_size_limit) {
            $errors['upload_photo'] = "File size must not exceed 700 KB.";
        } else {
            $photo_content = file_get_contents($uploaded_photo['tmp_name']);
        }
    }

    if (empty($errors)) {
        if ($photo_content === null) {
            // If no new photo, update only text fields
            $updateInfo = "UPDATE rooms SET room_type = ?, room_number = ?, price_per_night = ?, room_size = ?, view = ?, floor_number = ?, room_desc = ?, bed_type = ?, capacity = ? WHERE id = ?";
            $stmt = mysqli_prepare($db_conn, $updateInfo);
            mysqli_stmt_bind_param(
                $stmt,
                'sssssssssi',
                $ed_room_type,
                $ed_room_number,
                $ed_price,
                $ed_room_size,
                $ed_view,
                $ed_floor_number,
                $ed_desription,
                $ed_bed_type,
                $ed_capacity,
                $updateRoomId
            );
        } else {
            // If new photo uploaded, include it in the update
            $updateInfo = "UPDATE rooms SET room_type = ?, room_number = ?, price_per_night = ?, room_size = ?, view = ?, floor_number = ?, room_desc = ?, room_photo = ?, room_mime_type = ?, bed_type = ?, capacity = ? WHERE id = ?";
            $stmt = mysqli_prepare($db_conn, $updateInfo);
            mysqli_stmt_bind_param(
                $stmt,
                'sssssssssssi',
                $ed_room_type,
                $ed_room_number,
                $ed_price,
                $ed_room_size,
                $ed_view,
                $ed_floor_number,
                $ed_desription,
                $photo_content,
                $mime_type,
                $ed_bed_type,
                $ed_capacity,
                $updateRoomId
            );
        }

        if ($stmt && mysqli_stmt_execute($stmt)) {
            $success_message = "Room updated successfully!";
            header("Location: main_dashboard.php?page=room_list&success_message=" . urlencode($success_message));
            exit();
        } else {
            $errors['database'] = "Failed to update room: " . mysqli_error($db_conn);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- FancyBox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        .main_form {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border: 1px solid #60a5fa;
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

<body>
    <section class="pt-20">
        <?php if (isset($_GET['success_message'])) { ?>
            <div id="successMessage" class="toast toast-top toast-center toast-visible z-30">
                <div class="alert alert-success">
                    <span class="text-white"><?= htmlspecialchars($_GET['success_message']) ?></span>
                </div>
            </div>
        <?php } ?>

        <div class="grid md:grid-cols-2 gap-5">
            <form action="" method="post" enctype="multipart/form-data"
                class=" mx-4  md:p-8 px-4 py-4 rounded-xl main_form ">
                <!-- logo  -->
                <div class="flex justify-center mb-3">
                    <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
                </div>
                <h2 class="text-2xl font-bold text-center mb-4 uppercase titel_content">Update Room Info</h2>
                <!-- ===  ==== -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label for="room_type">Room Type</label>
                        <input type="text" name="room_type" id="room_type" placeholder=" Room Type"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($room_type); ?>">
                    </div>
                    <div>
                        <label for="room_type">Room Number</label>
                        <input type="text" name="room_number" id="room_number" placeholder="Room Number"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($room_number); ?>">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label for="room_type">Bed Type</label>
                        <input type="text" name="bed_type" id="bed_type" placeholder=" bed_type"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($bed_type); ?>">
                    </div>
                    <div>
                        <label for="room_type">Room Price</label>
                        <input type="text" name="price" id="price" placeholder="Price"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($price); ?>">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label for="room_type">Floor Number</label>
                        <input type="text" name="floor_number" id="floor_number" placeholder=" floor_number"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($floor_number); ?>">
                    </div>
                    <div>
                        <label for="room_type">Room Size</label>
                        <input type="text" name="room_size" id="room_size" placeholder="Room Size"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($room_size); ?>">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label for="room_type">Room View</label>
                        <input type="text" name="view" id="view" placeholder=" Room View"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($view); ?>">
                    </div>
                    <div>
                        <label for="room_type">Capacity</label>
                        <input type="text" name="capacity" id="capacity" placeholder="Capacity"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($capacity); ?>">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-3 mb-4">
                    <div>
                        <label for="room_type">Room Descrip</label>
                        <input type="text" name="describ" id="describ" placeholder="Description"
                            class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                            value="<?php echo htmlspecialchars($desription); ?>">
                    </div>
                    <!-- ==== Upload Profile Photo ==== -->
                    <div class="mb-4">
                        <input type="file" name="upload_photo" id="upload_photo"
                            class="file-input w-full file-input-ghost bg-gray-200 outline-none text-black"
                            value="<?php echo htmlspecialchars($user['mime_type']); ?>">
                        <small class="text-red-500"><?= $errors['upload_photo'] ?? '' ?></small>
                    </div>
                </div>

                <!-- === update Button ==== -->
                <div>
                    <button type="submit" name="updateRoomBtn" id="update"
                        class="relative flex justify-center items-center w-full py-3  border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                        <span
                            class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                        <span class="relative z-10 uppercase  titel_content">Update Room</span>
                    </button>
                </div>
            </form>

            <div>
                <div class="flex justify-center items-center">
                    <a data-fancybox="gallery" href="data:$photo_mime;base64,$base64_photo">
                        <img class="object-cover"
                            src="data:<?php echo htmlspecialchars($photo_mime); ?>;base64,<?php echo htmlspecialchars($base64_photo); ?>"
                            alt="Room Photo">

                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FancyBox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="main.js"></script>
</body>

</html>