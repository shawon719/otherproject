<?php
require_once('../db_root.php');

$errors = [];
$success_message = '';
if (isset($_POST['registerBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $name = $first_name . " " . $last_name;
    $email = trim($_POST['email']);
    $phone = trim($_POST['number']);
    $password = $_POST['password'];
    $con_password = $_POST['co_pass'];
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    $uploaded_photo = $_FILES['upload_photo'];
    $default_role = 'user'; // Default role

    // Validate inputs
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required.";
    }
    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@gmail.com')) {
        $errors['email'] = "Enter a valid Gmail address.";
    }
    if (empty($phone)) {
        $errors['number'] = "Phone Number is required.";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{4,12}$/', $password)) {
        $errors['password'] = "Password must be 4-12 characters long, with at least one uppercase letter, one lowercase letter, and one special character.";
    }
    if (empty($con_password)) {
        $errors['co_pass'] = "Confirm Password is required.";
    }
    if ($password !== $con_password) {
        $errors['co_pass'] = "Passwords do not match.";
    }
    $allowed_genders = ['male', 'female', 'other'];
    if (!in_array($gender, $allowed_genders)) {
        $errors['gender'] = "Invalid gender value.";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }

    // Validate uploaded photo
    if ($uploaded_photo['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['upload_photo'] = "Photo is required.";
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

        $photo_content = @file_get_contents($uploaded_photo['tmp_name']);
        if ($photo_content === false) {
            $errors['upload_photo'] = "Error reading the uploaded file.";
        }
    }

    if (empty($errors)) {
        // Check if email is already registered
        $stmt = $db_conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors['email'] = "Email is already registered.";
        } else {
            // Hash the password
            $hash_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data into the database
            $insert = $db_conn->prepare("INSERT INTO users (name, email, role, phone, gender, photo, mime_type, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("ssssssss", $name, $email, $default_role, $phone, $gender, $photo_content, $mime_type, $hash_password);

            if ($insert->execute()) {
                $success_message = "User Register successfully!";
                header("Location: login.php?success_message=" . urlencode($success_message));
                exit();
            } else {
                $errors['insert'] = "Error: " . $insert->error;
            }
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
    <link rel="stylesheet" href="style.css">

    <style>
        /* .inStyle:is(:focus) {
            border: 2px solid transparent;
            transition: all 0.1s ease;
            background: linear-gradient(#121125, #121125) padding-box, linear-gradient(45deg, blue, red) border-box;

        } */

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
    <section class="w-full py-10 bg-gray-200 min-h-[100vh]" id="form_container">

        <form action="" method="post" enctype="multipart/form-data"
            class="max-w-lg md:mx-auto mx-4 bg-white md:p-8 px-4 py-4 rounded-xl shadow-md ">
            <!-- go to home  -->
            <div class=" flex justify-center items-center gap-2 mb-4">
                <a href="index.php"><i class="text-[#079d49] fa-solid fa-arrow-left"></i></a>
                <a class="text-black font-medium titel_content" href="index.php">Go To Home Page</a>
            </div>

            <!-- logo  -->
            <div class="flex justify-center mb-3">
                <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
            </div>

            <h2 class="text-2xl font-bold text-center mb-4 uppercase titel_content">Create an Account</h2>

            <!-- === Name Fields ==== -->
            <div class="grid grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="first_name" id="first_name" placeholder="First Name"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($first_name) ? htmlspecialchars($first_name) : '' ?>">
                    <small class="text-red-500"><?= $errors['first_name'] ?? '' ?></small>
                </div>
                <div>
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($last_name) ? htmlspecialchars($last_name) : '' ?>">
                    <small class="text-red-500"><?= $errors['last_name'] ?? '' ?></small>
                </div>
            </div>

            <!-- ==== Email & Mobile Fields ==== -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="email" name="email" id="email" placeholder="Email Address"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                    <small class="text-red-500"><?= $errors['email'] ?? '' ?></small>
                </div>
                <div>
                    <input type="tel" name="number" id="number" placeholder="Phone Number"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($phone) ? htmlspecialchars($phone) : '' ?>">
                    <small class="text-red-500"><?= $errors['number'] ?? '' ?></small>
                </div>
            </div>

            <!-- ==== Password Fields ==== -->
            <div class="grid grid-cols-2 gap-3 mb-4">
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($password) ? htmlspecialchars($password) : '' ?>">
                    <small class="text-red-500"><?= $errors['password'] ?? '' ?></small>

                    <label class="swap swap-rotate absolute top-4 right-0">
                        <!-- this hidden checkbox controls the state -->
                        <input onclick="handleVisiblePassword(event)" type="checkbox" class="" value="synthwave" />

                        <!-- eye icon -->
                        <i class="fa-solid fa-eye swap-off h-10 w-10 "></i>
                        <!-- eye slash icon -->
                        <i class="fa-solid fa-eye-slash swap-on h-10 w-10 "></i>

                    </label>
                </div>
                <div class="relative">
                    <input type="password" name="co_pass" id="co_pass" placeholder="Confirm Password"
                        class="py-3 px-4 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($con_password) ? htmlspecialchars($con_password) : '' ?>">
                    <small class="text-red-500"><?= $errors['co_pass'] ?? '' ?></small>

                    <label class="swap swap-rotate absolute top-4 right-0">
                        <!-- this hidden checkbox controls the state -->
                        <input onclick="handleVisibleConPassword(event)" type="checkbox" class="" value="synthwave" />

                        <!-- eye icon -->
                        <i class="fa-solid fa-eye swap-off h-10 w-10 "></i>
                        <!-- eye slash icon -->
                        <i class="fa-solid fa-eye-slash swap-on h-10 w-10 "></i>

                    </label>
                </div>
            </div>

            <!-- ==== gender and address Fields ==== -->
            <div class="grid grid-cols-2 gap-3 mb-4">
                <div>
                    <select name="gender" id="gender"
                        class='w-full py-3 px-4 border-2 border-violet-300 rounded-lg focus:outline-none inStyle text-gray-400'
                        value="<?= isset($gender) ? htmlspecialchars($gender) : '' ?>">
                        <option value="" <?= empty($gender) ? 'selected' : '' ?>>Gender</option>
                        <option value="male" <?= (isset($gender) && $gender === 'male') ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= (isset($gender) && $gender === 'female') ? 'selected' : '' ?>>Female
                        </option>
                    </select>
                    <small class="text-red-500"><?= $errors['gender'] ?? '' ?></small>
                </div>
                <div>
                    <textarea name="address" id="address" cols="2" rows="1"
                        class=" px-4 py-3 border-2 border-violet-300 rounded-lg w-full focus:outline-none inStyle"
                        value="<?= isset($address) ? htmlspecialchars($address) : '' ?>"
                        placeholder="Address"></textarea>
                    <small class="text-red-500"><?= $errors['address'] ?? '' ?></small>
                </div>
            </div>

            <!-- ==== Upload Profile Photo ==== -->
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Upload Photo</label>
                <input type="file" name="upload_photo" id="upload_photo"
                    class="file-input w-full file-input-ghost bg-gray-200 outline-none">
                <small class="text-red-500"><?= $errors['upload_photo'] ?? '' ?></small>
            </div>

            <!-- already have account  -->

            <div class="flex justify-between mx-2 mb-3 font-medium">
                <p>Already, have an account?</p>
                <a href="auth/login.php" class="uppercase titel_content font-medium text-red-500">Log In</a>
            </div>

            <!-- === Register Button ==== -->
            <div>
                <button type="submit" name="registerBtn" id="register"
                    class="relative flex justify-center items-center w-full py-3  border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                    <span
                        class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    <span class="relative z-10 uppercase  titel_content">Register</span>
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

        const handleVisiblePassword = (event) => {
            const passField = document.getElementById('password');
            const checkbox = document.querySelector('input[type="checkbox"]');
            if (event.target.checked) {
                passField.type = 'text';
            } else {
                passField.type = 'password';
            }
        }
        const handleVisibleConPassword = (event) => {
            const passField = document.getElementById('co_pass');
            const checkbox = document.querySelector('input[type="checkbox"]');
            if (event.target.checked) {
                passField.type = 'text';
            } else {
                passField.type = 'password';
            }
        }
    </script>
</body>

</html>