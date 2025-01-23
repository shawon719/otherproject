<?php
ob_start();
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php"); // Redirect to login page
    exit;
}
require_once 'db_root.php';
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $db_conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar_main {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
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
    </style>
</head>

<body>
    <section>
        <div
            class=" p-4 h-full hidden bg-[--primary-color] lg:block w-72 mt-18 sidebar_main pt-16 overflow-y-auto max-h-screen scroll-smooth scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100 ">
            <div class="flex flex-col items-center gap-4 p-6 border-b ">
                <div class="shrink-0">
                    <a href="#" class="relative flex items-center justify-center w-16 h-16 text-white rounded-full ">
                        <img src="get_photo.php?id=<?= htmlspecialchars($user['id']); ?>"
                            alt="<?= htmlspecialchars($user['name']); ?>"
                            title="<?= htmlspecialchars($user['name']); ?>" class="w-16 h-16 rounded-full" />
                        <span
                            class="absolute bottom-0 right-0 inline-flex items-center justify-center gap-1 p-1 text-sm text-white border-2 border-white rounded-full bg-emerald-500"><span
                                class="sr-only"> online </span></span>
                    </a>
                </div>
                <div class="flex flex-col gap-0 min-h-[2rem] items-start justify-center w-full min-w-0 text-center">
                    <h4 class="w-full text-base truncate text-slate-700"><?= htmlspecialchars($user['name']); ?></h4>
                    <p class="w-full text-sm truncate text-slate-500">Hotel Manager</p>
                </div>
            </div>
            <!-- side nav  -->
            <nav class="titel_content">
                <!-- dashboard  -->
                <a href="main_dashboard.php?page=dashboard"
                    class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 text-lg ajax-link focus:text-emerald-500 ">
                    <i class="fa-solid fa-house-chimney"></i>
                    Dashboard
                </a>
                <!-- manageUser  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-user-management" data-collapse-toggle="dropdown-user-management">
                    <div class="flex justify-between items-center text-lg">
                        <span><i class="fa-solid fa-gears"></i> Users Management</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-user-management" class="hidden py-2 space-y-2 ">
                    <li><a href="main_dashboard.php?page=add_user"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Add
                            User
                        </a></li>
                    <li><a href="main_dashboard.php?page=manage_user"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">manage
                            Users
                        </a></li>
                </ul>

                <!-- room settings  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-rooms-setting" data-collapse-toggle="dropdown-rooms-setting">
                    <div class="flex justify-between items-center text-lg">
                        <i class="fa-solid fa-people-roof"></i> Room Management</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-rooms-setting" class="hidden py-2 space-y-2">
                    <li><a href="main_dashboard.php?page=add_room"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">ADD
                            Room
                        </a></li>
                    <li><a href="main_dashboard.php?page=room_list"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            List</a></li>
                    <li><a href="main_dashboard.php?page=update_room"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Update
                            Room
                        </a></li>

                    <li><a href="main_dashboard.php?page=room_type"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Add
                            Room
                            Types
                        </a></li>
                    <li><a href="main_dashboard.php?page=bed_type"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Bed
                            List</a></li>

                    <li><a href="main_dashboard.php?page=room_imge"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            Images</a></li>
                </ul>

                <!-- room booking  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-room-book" data-collapse-toggle="dropdown-room-book">
                    <div class="flex justify-between items-center text-lg">
                        <span> <i class="fa-solid fa-calendar-days"></i> Booking Management</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-room-book" class="hidden py-2 space-y-2 ">
                    <li><a href="main_dashboard.php?page=all_booking_list"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Booking
                            List</a></li>
                    <li><a href="main_dashboard.php?page=room_status"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            Status</a></li>
                </ul>

                <!-- transition  -->
                <a href="main_dashboard.php?page=hotel"
                    class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 text-lg ajax-link focus:text-emerald-500">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    Transaction
                </a>
                <!-- Room Facilities  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-room-facilities" data-collapse-toggle="dropdown-room-facilities">
                    <div class="flex justify-between items-center text-lg">
                        <span> <i class="fa-solid fa-person-booth"></i> Room Facilities</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-room-facilities" class="hidden py-2 space-y-2">
                    <li><a href="#"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Facilities
                            List</a></li>
                    <li><a href="#"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Facilities
                            Details</a></li>
                    <li><a href="#"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            Size</a></li>
                </ul>

                <!-- logout  -->
                <footer class="p-3 border-t border-slate-200">
                    <a href="auth/logout.php"
                        class="flex items-center gap-3 p-3 transition-colors rounded hover:text-emerald-500 ">
                        <div class="flex items-center self-center">
                            <i class="fa-solid fa-share-from-square"></i>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-lg font-medium truncate">
                            Logout
                        </div>
                    </a>
                </footer>
            </nav>
        </div>
        <!-- Mobile Sidebar -->
        <div class="lg:hidden h-full p-4 bg-[--primary-color] fixed z-30 inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out sidebar_main pt-16 backdrop:blur-[8px"
            id="mobile-sidebar">
            <button onclick="toggleSidebar()" class=" absolute top-4 right-4">✕</button>
            <div class="flex flex-col items-center gap-4 p-6 border-b ">
                <div class="shrink-0">
                    <a href="#" class="relative flex items-center justify-center w-16 h-16  rounded-full">
                        <img src="get_photo.php?id=<?= htmlspecialchars($user['id']); ?>"
                            alt="<?= htmlspecialchars($user['name']); ?>"
                            title="<?= htmlspecialchars($user['name']); ?>" class="w-16 h-16 rounded-full" />
                        <span
                            class="absolute bottom-0 right-0 inline-flex items-center justify-center gap-1 p-1 text-sm text-white border-2 border-white rounded-full bg-emerald-500"><span
                                class="sr-only"> online </span></span>
                    </a>
                </div>
                <div class="flex flex-col gap-0 min-h-[2rem] items-start justify-center w-full min-w-0 text-center">
                    <h4 class="w-full text-base truncate text-slate-700"><?= htmlspecialchars($user['name']); ?></h4>
                    <p class="w-full text-sm truncate text-slate-500">Hotel Manager</p>
                </div>
            </div>
            <!-- side nav  -->
            <nav class="titel_content">
                <!-- dashboard  -->
                <a href="main_dashboard.php?page=dashboard"
                    class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 text-lg ajax-link focus:text-emerald-500">
                    <i class="fa-solid fa-house-chimney"></i>
                    Dashboard
                </a>

                <!-- users management  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-user-management2" data-collapse-toggle="dropdown-user-management2">
                    <div class="flex justify-between items-center text-lg">
                        <span><i class="fa-solid fa-gears"></i> Users Management</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-user-management2" class="hidden py-2 space-y-2 ">
                    <li><a href="main_dashboard.php?page=add_user"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">ADD
                            Users
                        </a></li>
                    <li><a href="main_dashboard.php?page=manage_user"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">
                            Manage Users
                        </a></li>
                </ul>

                <!-- room Management  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-room-book2" data-collapse-toggle="dropdown-room-book2">
                    <div class="flex justify-between items-center text-lg">
                        <span><i class="fa-solid fa-people-roof"></i> Room Management</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-room-book2" class="hidden py-2 space-y-2 ">
                    <li><a href="main_dashboard.php?page=add_room"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">ADD
                            Room
                        </a></li>
                    <li><a href="main_dashboard.php?page=room_list"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            List</a></li>
                    <li><a href="main_dashboard.php?page=update_room"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Update
                            Room
                        </a></li>

                    <li><a href="main_dashboard.php?page=room_type"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Add
                            Room
                            Types
                        </a></li>
                    <li><a href="main_dashboard.php?page=bed_type"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Bed
                            List</a></li>

                    <li><a href="main_dashboard.php?page=room_imge"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            Images</a></li>
                </ul>

                <!-- room booking  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-room-book2" data-collapse-toggle="dropdown-room-book2">
                    <div class="flex justify-between items-center text-lg">
                        <span> <i class="fa-solid fa-calendar-days"></i> Booking Management</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-room-book2" class="hidden py-2 space-y-2 ">
                    <li><a href="main_dashboard.php?page=all_booking_list"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Booking
                            List</a></li>
                    <li><a href="main_dashboard.php?page=room_status"
                            class="flex items-center w-full p-2 text-lg font-normal  transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            Status</a></li>
                </ul>

                <!-- transition  -->
                <a href="main_dashboard.php?page=hotel"
                    class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 text-lg ajax-link focus:text-emerald-500">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    Transaction
                </a>

                <!-- Room Facilities  -->
                <div class="block py-3 px-4 rounded transition-colors hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50"
                    aria-controls="dropdown-room-facilities2" data-collapse-toggle="dropdown-room-facilities2">
                    <div class="flex justify-between items-center text-lg">
                        <span><i class="fa-solid fa-person-booth"></i> Room Facilities</span> <span><i
                                class="fa-solid fa-angle-down"></i></span>
                    </div>
                </div>
                <ul id="dropdown-room-facilities2" class="hidden py-2 space-y-2">
                    <li><a href="#"
                            class="flex items-center w-full p-2 text-lg font-normal transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Facilities
                            List</a></li>
                    <li><a href="#"
                            class="flex items-center w-full p-2 text-lg font-normal transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Facilities
                            Details</a></li>
                    <li><a href="#"
                            class="flex items-center w-full p-2 text-lg font-normal transition duration-75 rounded-lg group hover:text-emerald-500 hover:bg-emerald-50 focus:bg-emerald-50 aria-[current=page]:text-emerald-500 aria-[current=page]:bg-emerald-50 pl-11 ajax-link focus:text-emerald-500">Room
                            Size</a></li>
                </ul>

                <!-- logout  -->
                <footer class="p-3 border-t border-slate-200">
                    <a href="#" class="flex items-center gap-3 p-3 transition-colors rounded hover:text-emerald-500 ">
                        <div class="flex items-center self-center">
                            <i class="fa-solid fa-share-from-square"></i>
                        </div>
                        <div
                            class="flex flex-col items-start justify-center flex-1 w-full gap-0 overflow-hidden text-lg font-medium truncate">
                            Logout
                        </div>
                    </a>
                </footer>
            </nav>
        </div>
    </section>
    <script>
        // toggle sidebar for mobile device  
        function toggleSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
        // dropdown script 
        document.querySelectorAll('[data-collapse-toggle]').forEach((toggle) => {
            toggle.addEventListener('click', (e) => {
                const target = document.getElementById(toggle.getAttribute('aria-controls'));
                target.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>