<?php
require_once "db_root.php";

$success_message = '';
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no user is logged in
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $db_conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
}

if (isset($_POST['reviewBtn'])) {
    $rating = $_POST['rating'];  // Get the rating value
    $name = $_POST['u_name'];
    $email = $_POST['email'];
    $description = $_POST['describ'];

    // Save the review and rating to the database (make sure to sanitize inputs)
    $sql = "INSERT INTO reviews (user_id, name, email, description, rating) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db_conn->prepare($sql);
    $stmt->bind_param("isssi", $user_id, $name, $email, $description, $rating);
    $stmt->execute();
    $success_message = "Review submit successfully!";
    // Redirect to the same page with a success message
    header("location:user_dashboard.php?page=dashboard_user&success_message=$success_message");

    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
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
        .main_form {
            box-shadow: rgba(0, 0, 0, 0.45) 0px 2px 8px;
        }

        .star-rating i {
            font-size: 2rem;
            /* Size the stars */
        }

        .star-rating i.selected {
            color: #f59e0b;
            /* Yellow color when selected */
        }

        .star-rating i:hover {
            color: #f59e0b;
            /* Yellow on hover */
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
    <?php if (isset($_GET['success_message'])) { ?>
        <div id="successMessage" class="toast toast-top toast-center toast-visible z-30">
            <div class="alert alert-success">
                <span class="text-white"><?= htmlspecialchars($_GET['success_message']) ?></span>
            </div>
        </div>
    <?php } ?>

    <!-- Review Form -->
    <section class="w-full py-20 min-h-[100vh] titel_content" id="form_container">
        <form action="" method="post" enctype="multipart/form-data"
            class="max-w-lg md:mx-auto mx-4 md:p-8 px-4 py-4 rounded-xl hover:shadow-2xl transition-shadow duration-300 main_form">

            <!-- logo -->
            <div class="flex justify-center mb-3">
                <img src="assets/hotel_logo/hotelix.png" alt="Hotelix Logo" class="w-[170px]">
            </div>

            <h2 class="text-2xl font-bold text-center mb-4 uppercase">Give Review</h2>

            <!-- Rating Section -->
            <div class="text-center mb-3">
                <label for="rating" class="block text-lg font-semibold mb-2">Rate Your Experience</label>
                <div class="flex justify-center">
                    <div id="rating" class="star-rating flex space-x-1">
                        <i class="fa fa-star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="1"></i>
                        <i class="fa fa-star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="2"></i>
                        <i class="fa fa-star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="3"></i>
                        <i class="fa fa-star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="4"></i>
                        <i class="fa fa-star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="5"></i>
                    </div>
                </div>
                <input type="hidden" name="rating" id="rating_value" value="0">
            </div>

            <!-- Name and Email Fields -->
            <div class="grid md:grid-cols-2 gap-3 mb-4">
                <div>
                    <input type="text" name="u_name" id="u_name" placeholder="Name"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($user['name']); ?>" readonly required>
                </div>
                <div>
                    <input type="email" name="email" id="email" placeholder="Email Address"
                        class="py-3 px-4 text-xl bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"
                        value="<?php echo htmlspecialchars($user['email']); ?>" readonly required>
                </div>
            </div>

            <!-- Review Description -->
            <div>
                <textarea name="describ" id="describ" placeholder="Review Description" cols="2" rows="3"
                    class="py-3 px-4 bg-transparent border-2 border-violet-300 rounded-lg w-full focus:outline-none"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-3">
                <button type="submit" name="reviewBtn" id="review"
                    class="relative flex justify-center items-center w-full py-3 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group transition-transform duration-500">
                    <span
                        class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                    <span class="relative z-10 uppercase">Submit Review</span>
                </button>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll('#rating i');
            const ratingValue = document.getElementById('rating_value');

            // Update the stars to reflect the initial rating value if available
            const initialRating = ratingValue.value;
            if (initialRating) {
                for (let i = 0; i < initialRating; i++) {
                    stars[i].classList.add('selected');
                }
            }

            // Add event listeners to handle star click events
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const selectedRating = this.getAttribute('data-value');
                    ratingValue.value = selectedRating; // Set the hidden input with the rating value

                    // Remove the 'selected' class from all stars
                    stars.forEach(star => star.classList.remove('selected'));

                    // Add the 'selected' class to the clicked star and all previous stars
                    for (let i = 0; i < selectedRating; i++) {
                        stars[i].classList.add('selected');
                    }
                });
            });
        });
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