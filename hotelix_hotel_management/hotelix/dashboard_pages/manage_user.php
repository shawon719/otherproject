<?php
require_once "db_root.php"; // Ensure this file connects to your database
$success_message = '';
$results_per_page = 10;
$subpage = isset($_GET['subpage']) && (int) $_GET['subpage'] > 0 ? (int) $_GET['subpage'] : 1;

$start_from = intval(($subpage - 1) * $results_per_page);
// Handle Role Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateUserBtn'])) {
        $updateRole = $db_conn->real_escape_string($_POST['role']);
        $updateId = $db_conn->real_escape_string($_POST['userId']);

        $update_user = "UPDATE users SET role = '$updateRole' WHERE id = '$updateId'";
        if (mysqli_query($db_conn, $update_user)) {
            $success_message = "User Update successfully!";
            header("Location:main_dashboard.php?page=manage_user&success_message=" . urlencode($success_message));
            exit();
        } else {
            $error = "Failed to update user role.";
        }
    }

    // Handle User Deletion
    if (isset($_POST['deleteUserBtn'])) {
        $deleteId = $db_conn->real_escape_string($_POST['userId']);

        $delete_user = $db_conn->query("DELETE FROM users WHERE id = '$deleteId'");
        if ($delete_user) {
            $success_message = "User Deleted successfully!";
            header("Location:main_dashboard.php?page=manage_user&success_message=" . urlencode($success_message));
            exit();
        } else {
            $error = "Failed to delete user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/9ce82b2c02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">
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
    <section class="pt-16">
        <h3 class="lg:text-5xl md:text-4xl text-2xl uppercase titel_content text-center">Manage Users</h3>

        <div class="overflow-x-auto">
            <table class="w-full table table-xs md:table-md mb-20">
                <thead>
                    <tr
                        class="bg-[--secondary-color] text-[--primary-color] border-b border-gray-200 text-center text-xs md:text-sm font-thin">
                        <th>SL</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-[--primary-color]">
                    <?php
                    $getUsers = $db_conn->query("SELECT * FROM users LIMIT $start_from, $results_per_page");
                    if ($getUsers->num_rows > 0) {
                        $counter = $start_from + 1;
                        while ($row = $getUsers->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $role = $row['role'];
                            $photo = $row['photo'];
                            $photo_mime = $row['mime_type'];
                            echo "
                                <tr class=' text-xs md:text-sm text-center'>
                                    <td>
                                      $counter
                                    </td>
                                    <td>
                                        <img class='h-10 w-10 object-cover rounded-full' 
                                            src='data:$photo_mime;base64," . base64_encode($photo) . "' alt='User Photo'>
                                    </td>
                                    <td>$name</td>
                                    <td>$email</td>
                                    <td>$role</td>
                                    <td>
                                        <button data-tip='Edit User' class='tooltip px-3 py-1 rounded-md text-xs md:text-sm border border-blue-500 font-medium 
                                                        hover:text-white hover:bg-blue-500 transition duration-150' 
                                                        onclick=\"openUpdateModal($id, '$role')\">
                                            <i class='fa-solid fa-pen-to-square'></i>
                                        </button>
                                        <button data-tip='delete user' class='tooltip px-3 py-1 rounded-md text-xs md:text-sm border border-red-500 font-medium 
                                                        hover:text-white hover:bg-red-500 transition duration-150' 
                                                        onclick=\"openModal($id, '$name')\">
                                            <i class='fa-solid fa-trash-can'></i>
                                        </button>
                                    </td>
                                </tr>
                            ";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Users not found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-center">
                <?php
                $result = $db_conn->query("SELECT COUNT(id) AS total FROM users");
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
                    echo "<a href='main_dashboard.php?page=manage_user&subpage=" . ($subpage - 1) . "' class='mx-2 px-4 py-2 border rounded-md bg-gray-200 text-gray-700'>&laquo; Previous</a>";
                }
                // Display page numbers
                for ($i = $start_page; $i <= $end_page; $i++) {
                    echo "<a href='main_dashboard.php?page=manage_user&subpage=$i' class='mx-2 px-4 py-2 border rounded-md " . ($subpage == $i ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700') . "'>$i</a>";
                }
                // Display "Next" button
                if ($subpage < $total_pages) {
                    echo "<a href='main_dashboard.php?page=manage_user&subpage=" . ($subpage + 1) . "' class='mx-2 px-4 py-2 border rounded-md bg-gray-200 text-gray-700'>Next &raquo;</a>";
                }
                ?>
            </div>
        </div>

        <!-- Update Modal -->
        <div id="updateModel"
            class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-[--primary-color] max-w-md">
                <div class="flex justify-end p-2">
                    <button onclick="closeModal('updateModel')" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <i class="fa-solid fa-xmark w-5 h-5 text-2xl"></i>
                    </button>
                </div>

                <div class="p-6 pt-0 text-center">
                    <h3 class="text-xl font-normal text-gray-500 mb-6">Update User Details</h3>
                    <form id="updateUserForm" action="" method="POST">
                        <input type="hidden" id="updateUserId" name="userId" />
                        <div class="mb-4">
                            <label for="updateRole" class="block text-left">Role</label>
                            <select id="updateRole" name="role"
                                class="w-full px-3 py-2 mt-2 text-black border rounded-md">
                                <option value="admin" id="roleAdmin">Admin</option>
                                <option value="user" id="roleUser">User</option>
                            </select>
                        </div>

                        <div class="flex justify-center gap-x-2 mt-4">
                            <button type="submit" name="updateUserBtn"
                                class="text-white bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded-md">
                                Update User
                            </button>
                            <button type="button" onclick="closeModal('updateModel')"
                                class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 px-4 py-2 rounded-md">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="modelConfirm"
            class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-[--primary-color] max-w-md">
                <div class="flex justify-end p-2">
                    <button onclick="closeModal('modelConfirm')" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <i class="fa-solid fa-xmark w-5 h-5 text-2xl"></i>
                    </button>
                </div>

                <div class="p-6 pt-0 text-center">
                    <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Are you sure you want to delete this <span
                            id="deleteUserName"></span>?</h3>
                    <div class="flex justify-center items-center">
                        <form method="POST" id="deleteForm">
                            <input type="hidden" id="deleteUserId" name="userId">
                            <button type="submit" name="deleteUserBtn"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button type="button" onclick="closeModal('modelConfirm')"
                            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
                            No, cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function openUpdateModal(userId, role) {
            document.getElementById('updateUserId').value = userId;
            document.getElementById('updateRole').value = role;
            document.getElementById('updateModel').style.display = 'block';
            document.body.classList.add('overflow-y-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.classList.remove('overflow-y-hidden');
        }

        function openModal(userId, name) {
            document.getElementById('deleteUserName').innerText = name;
            document.getElementById('deleteUserId').value = userId;
            document.getElementById('modelConfirm').style.display = 'block';
            document.body.classList.add('overflow-y-hidden');
        }

        // success message 
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