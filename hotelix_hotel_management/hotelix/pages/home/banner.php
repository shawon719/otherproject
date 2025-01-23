<?php
$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; 
} 
// Set default check-in and check-out dates
$defaultCheckinDate = date('Y-m-d');
$defaultCheckoutDate = date('Y-m-d', strtotime('+1 day'));

// Store dates in session if they are posted
$checkinDate = isset($_POST['checkin']) && !empty($_POST['checkin']) ? $_POST['checkin'] : $defaultCheckinDate;
$checkoutDate = isset($_POST['checkout']) && !empty($_POST['checkout']) ? $_POST['checkout'] : $defaultCheckoutDate;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>

</head>

<body>
    <!-- md:h-[500px] lg:h-[600px] h-[300px] -->
    <div class="swiper mySwiper overflow-hidden w-full">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="relative overflow-hidden">
                    <img class="lg:h-[100%] md:h-[600px] h-[400px] w-full"
                        src="<?php echo 'assets/banner/banner-1.jpg' ?>" loading="lazy" alt="bannerImg" />
                    <div class="absolute inset-0 bg-black opacity-50 h-full w-full"></div>
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center leading-relaxed text-white">
                        <p class="md:text-5xl text-3xl titel ">Enjoy Your Stay</p>
                        <h3 class="lg:text-6xl md:text-5xl font-bold my-3 uppercase titel_content">
                            <span class="block">Enjoy & Relax </span>
                            <span>Luxury Hotel In City</span>
                        </h3>
                        <div class="exploreBtn">
                            <a href="#"
                                class="relative inline-block px-5 py-2 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group">
                                <span
                                    class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                                <div class="relative z-10 text-white">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Explore</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div> -->
            </div>

            <div class="swiper-slide">
                <div class="relative overflow-hidden">
                    <img class="lg:h-[100%] md:h-[600px] h-[400px] w-full"
                        src="<?php echo 'assets/banner/banner-2.jpg' ?>" loading="lazy" alt="bannerImg" />
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center leading-relaxed text-white">
                        <p class="md:text-5xl text-3xl titel">A memorable stay</p>
                        <h3 class="lg:text-6xl md:text-5xl font-bold my-3 uppercase titel_content">
                            <span class="block">stress-relieving </span>
                            <span>experience</span>
                        </h3>
                        <div class="exploreBtn">
                            <a href="#"
                                class="relative inline-block px-5 py-2 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group">
                                <span
                                    class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                                <div class="relative z-10 text-white">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Explore</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div> -->
            </div>

            <div class="swiper-slide">
                <div class="relative overflow-hidden">
                    <img class="lg:h-[100%] md:h-[600px] h-[400px] w-full"
                        src="<?php echo 'assets/banner/banner-3.jpg' ?>" loading="lazy" alt="bannerImg" />
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center leading-relaxed text-white">
                        <p class="md:text-5xl text-3xl titel">The budget rooms</p>
                        <h3 class="lg:text-6xl md:text-5xl font-bold my-3 uppercase titel_content">
                            <span class="block">Style accompanied </span>
                            <span>by comfort</span>
                        </h3>
                        <div class="exploreBtn">
                            <a href="#"
                                class="relative inline-block px-5 py-2 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group">
                                <span
                                    class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                                <div class="relative z-10 text-white">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                    <span>Explore</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div> -->
            </div>

        </div>

        <div class="swiper-pagination"></div>
    </div>

    <!-- ======== check out form ====== -->
    <?php if ($user !== null && isset($user['role']) && $user['role'] == 'admin'): ?>
    <div class="hidden">
        <form method="POST" action="hotelix/pages/room.php" class="md:mx-8 mx-5 my-2">
            <div class="form-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-6 rounded-lg shadow-md shadow-blue-100">
                <!-- Check-in Date -->
                <div class="form-section flex flex-col items-center md:border-r-2 md:border-gray-300 cursor-pointer"
                    onclick="focusInput('checkin')">
                    <h4 class="text-lg font-semibold mb-2 text-[--secondary-color] titel_content">CHECK IN &#128197;</h4>
                    <input type="date" id="checkin" name="checkin" value="<?php echo htmlspecialchars($checkinDate); ?>"
                        required min="<?php echo date('Y-m-d'); ?>"
                        class="md:w-[90%] w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-blue-500 bg-[--primary-color]">
                </div>

                <!-- Check-out Date -->
                <div class="form-section flex flex-col items-center md:border-r-2 md:border-gray-300 cursor-pointer"
                    onclick="focusInput('checkout')">
                    <h4 class="text-lg font-semibold mb-2 text-[--secondary-color] titel_content">CHECK OUT &#128197;</h4>
                    <input type="date" id="checkout" name="checkout"
                        value="<?php echo htmlspecialchars($checkoutDate); ?>" required
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                        class="md:w-[90%] w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-blue-500 bg-[--primary-color]">
                </div>

                <!-- Guests Section -->
                <div class="flex flex-col items-center md:border-r-2 md:border-gray-300">
                    <h4 class="text-lg font-semibold mb-2 text-[--secondary-color] titel_content">GUESTS &#128101;</h4>
                    <select name="guests"
                        class="md:w-[90%] w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 titel_content border-blue-500 bg-[--primary-color]">
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4+ Guests</option>
                    </select>
                </div>

                <!-- Check Availability Button -->
                <div class="check-availability flex flex-col items-center justify-center">
                    <button type="submit"
                        class="relative flex justify-center items-center w-full h-full py-2 md:py-0 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group">
                        <span
                            class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                        <span class="relative z-10 uppercase text-xl titel_content">Check Availability</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php else: ?>
        <div>
        <form method="POST" action="hotelix/pages/room.php" class="md:mx-8 mx-5 my-2">
            <div
                class="form-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-6 rounded-lg shadow-md shadow-blue-100">

                <!-- Check-in Date -->
                <div class="form-section flex flex-col items-center md:border-r-2 md:border-gray-300 cursor-pointer"
                    onclick="focusInput('checkin')">
                    <h4 class="text-lg font-semibold mb-2 text-[--secondary-color] titel_content">CHECK IN &#128197;
                    </h4>
                    <input type="date" id="checkin" name="checkin" value="<?php echo htmlspecialchars($checkinDate); ?>"
                        required min="<?php echo date('Y-m-d'); ?>"
                        class="md:w-[90%] w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-blue-500 bg-[--primary-color]">
                </div>

                <!-- Check-out Date -->
                <div class="form-section flex flex-col items-center md:border-r-2 md:border-gray-300 cursor-pointer"
                    onclick="focusInput('checkout')">
                    <h4 class="text-lg font-semibold mb-2 text-[--secondary-color] titel_content">CHECK OUT &#128197;
                    </h4>
                    <input type="date" id="checkout" name="checkout"
                        value="<?php echo htmlspecialchars($checkoutDate); ?>" required
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                        class="md:w-[90%] w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-blue-500 bg-[--primary-color]">
                </div>

                <!-- Guests Section -->
                <div class="flex flex-col items-center md:border-r-2 md:border-gray-300">
                    <h4 class="text-lg font-semibold mb-2 text-[--secondary-color] titel_content">GUESTS &#128101;</h4>
                    <select name="guests"
                        class="md:w-[90%] w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 titel_content border-blue-500 bg-[--primary-color]">
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4+ Guests</option>
                    </select>
                </div>

                <!-- Check Availability Button -->
                <div class="check-availability flex flex-col items-center justify-center">
                    <button type="submit"
                        class="relative flex justify-center items-center w-full h-full py-2 md:py-0 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group">
                        <span
                            class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                        <span class="relative z-10 uppercase text-xl titel_content">Check Availability</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
   
   

    <script>
        // function decrease(id) {
        //     let input = document.getElementById(id);
        //     let value = parseInt(input.value);
        //     if (value > input.min) {
        //         input.value = value - 1;
        //     }
        // }

        // function increase(id) {
        //     let input = document.getElementById(id);
        //     input.value = parseInt(input.value) + 1;
        // }

        function focusInput(inputId) {
            const input = document.getElementById(inputId);
            if (input) {
                input.focus();
                input.showPicker && input.showPicker(); // For browsers that support date pickers
            }
        }
    </script>
</body>

</html>