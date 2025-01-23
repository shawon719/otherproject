<?php
require_once('hotelix/shared/get_indi_data.php');
$errors = [];
if (isset($_POST['updateBtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $uploaded_photo = $_FILES['upload_photo'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@gmail.com')) {
        $errors['email'] = "Enter a valid Gmail address.";
    }

    // Validate uploaded photo
    if ($uploaded_photo['error'] === UPLOAD_ERR_NO_FILE) {
        $photo_content = null;
        $mime_type = null;
    } else {
        $allowed_exten = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_size_limit = 400 * 1024; // 400 KB
        $file_exten = strtolower(pathinfo($uploaded_photo['name'], PATHINFO_EXTENSION));
        $mime_type = mime_content_type($uploaded_photo['tmp_name']);

        if (!in_array($file_exten, $allowed_exten) || !in_array($mime_type, $allowed_mime_types)) {
            $errors['upload_photo'] = "Invalid file format. Only JPG, PNG, or GIF are allowed.";
        } elseif ($uploaded_photo['size'] > $file_size_limit) {
            $errors['upload_photo'] = "File size must not exceed 400 KB.";
        }

        if ($uploaded_photo['error'] === UPLOAD_ERR_OK) {
            $photo_content = @file_get_contents($uploaded_photo['tmp_name']);
            if ($photo_content === false) {
                $errors['upload_photo'] = "Error reading the uploaded file.";
            }
        }
    }

    if (empty($errors)) {
        // If no errors, proceed to update the database
        if ($uploaded_photo['error'] === UPLOAD_ERR_NO_FILE) {
            // If no new photo was uploaded, exclude photo and mime_type from the query
            $updateInfo = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$userId'";
            header('location:user_dashboard.php?page=user_profile');
        } else {
            // If a photo was uploaded, include photo and mime_type in the query
            $updateInfo = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', photo = ?, mime_type = ? WHERE id = '$userId'";
            header('location:user_dashboard.php?page=user_profile');
        }

        // Prepare the SQL statement to avoid direct input in the query (for security)
        if ($stmt = mysqli_prepare($db_conn, $updateInfo)) {
            if ($uploaded_photo['error'] !== UPLOAD_ERR_NO_FILE) {
                // Bind the photo content and mime type only if a photo was uploaded
                mysqli_stmt_bind_param($stmt, 'ss', $photo_content, $mime_type);
            }
            // Execute the update query
            if (mysqli_stmt_execute($stmt)) {
                echo "User info updated!";
            } else {
                echo "Error: " . mysqli_error($db_conn);
            }
            mysqli_stmt_close($stmt);
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
    </style>
</head>

<body>
    <section class="pt-20">

        <form action="" method="post" enctype="multipart/form-data"
            class=" mx-4  md:p-8 px-4 py-4 rounded-xl main_form ">
            <!-- logo  -->
            <div class="flex justify-center mb-3">
                <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
            </div>
            <h2 class="text-2xl font-bold text-center mb-4 uppercase titel_content">Update Profile</h2>
            <!-- === Name Fields ==== -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="name" id="name" placeholder=" Name"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                        value="<?php echo htmlspecialchars($user['name']); ?>">
                </div>
                <div>
                    <input type="email" name="email" id="email" placeholder="Email Address"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                        value="<?php echo htmlspecialchars($user['email']); ?>">
                    <small class="text-red-500"><?= $errors['email'] ?? '' ?></small>
                </div>
            </div>
            <!-- ==== Email & Mobile Fields ==== -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="tel" name="number" id="number" placeholder="Phone Number"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle text-black"
                        value="<?php echo htmlspecialchars($user['phone']); ?>">
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
                <button type="submit" name="updateBtn" id="update"
                    class="relative flex justify-center items-center w-full py-3  border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                    <span
                        class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    <span class="relative z-10 uppercase  titel_content">Update Profile</span>
                </button>
            </div>
        </form>
    </section>
</body>

</html>