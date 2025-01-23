<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        .social_box a img {
            width: 30px;
        }
    </style>
</head>

<body>
    <footer class="bg-[--primary-color] py-5 px-4 shadow-xl shadow-cyan-300">
        <section class="max-w-7xl mx-auto grid lg:grid-cols-3 md:grid-cols-2 gap-5">
            <!-- ======== footer left content ====== -->
            <div class="">
                <div class="footer_logo cursor-pointer flex justify-center md:justify-start">
                    <img src="<?php echo '/hotelix_hotel_management/assets/hotel_logo/hotelix.png'; ?>"
                        alt="Hotelix_logo" class="w-[150px] ">
                </div>
                <p class="py-3 md:text-start text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Perferendis
                    odit
                    officiis
                    molestias temporibus
                    ipsam.
                </p>
                <div class="readbtn mt-2 text-center md:text-start">
                    <!-- <a href="#" class="px-5 py-2 border-2 rounded-lg border-blue-500">Read More</a> -->
                    <a href="#"
                        class="relative inline-block px-5 py-2 border-2 rounded-lg border-blue-500 hover:text-white overflow-hidden group">
                        <span
                            class="absolute inset-0 bg-blue-500 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                        <span class="relative z-10">Read More</span>
                    </a>

                </div>
            </div>

            <!-- ========== footer middel content ======= -->
            <div class="text-center">
                <h3 class="uppercase text-2xl">Connect With Us</h3>
                <p class="py-3">SOCIAL MEDIA CHANNELS</p>
                <div class="social_box flex justify-center items-center gap-2">
                    <a href="">
                        <img src="<?php echo '/hotelix_hotel_management/assets/footer_social_logo/facebook.png' ?>"
                            alt="facebook">
                    </a>
                    <a href="">
                        <img src="<?php echo '/hotelix_hotel_management/assets/footer_social_logo/youtube.png' ?>"
                            alt="facebook">
                    </a>
                    <a href="">
                        <img src="<?php echo '/hotelix_hotel_management/assets/footer_social_logo/instagram.png' ?>"
                            alt="facebook">
                    </a>
                    <a href="">
                        <img src="<?php echo '/hotelix_hotel_management/assets/footer_social_logo/media.png' ?>"
                            alt="facebook">
                    </a>
                    <a href="">
                        <img src="<?php echo '/hotelix_hotel_management/assets/footer_social_logo/twitter.png' ?>"
                            alt="facebook">
                    </a>
                </div>
            </div>

            <!-- ======= footer right content ======= -->
            <div class="">
                <h3 class="uppercase">Subscribe To Receive News Updates & Offers</h3>
                <p class="py-3">SIGN UP FOR SPECIAL OFFERS</p>
                <form action="">
                    <input type="email" id="email" name="email" placeholder="insert your email"
                        class="w-full outline-none bg-[--primary-color] rounded-md shadow-md shadow-blue-500 ps-4 py-3">
                    <input type="submit" value="Subscribe Us"
                        class="border-2 border-y-blue-500 border-x-blue-500 w-full p-4 my-4 hover:bg-green-600 text-[--serondary-color] uppercase duration-100 transition-all hover:text-white rounded-sm">
                </form>
            </div>

        </section>
    </footer>
    <!-- == privacy == -->
    <div class="md:grid grid-cols-2 py-3 md:px-10 px-4 bg-gray-800 text-white">
        <div class="flex gap-8">
            <a href=""
                class=" border-r-2 border-gray-800 hover:border-white rounded-sm transition-all p-2 relative inline-block overflow-hidden group">
                <span
                    class="absolute inset-0 bg-blue-500 translate-x-[-110%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                <span class="relative z-10">Home</span>
            </a>
            <a href=""
                class="border-r-2 border-gray-800 hover:border-white rounded-sm transition-all p-2 relative inline-block overflow-hidden group">
                <span
                    class="absolute inset-0 bg-blue-500 translate-x-[-110%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                <span class="relative z-10">About</span>
            </a>
            <a href=""
                class="border-r-2 border-gray-800 hover:border-white rounded-sm transition-all p-2 relative inline-block overflow-hidden group">
                <span
                    class="absolute inset-0 bg-blue-500 translate-x-[-110%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                <span class="relative z-10">Gallery</span>
            </a>
            <a href=""
                class="border-r-2 border-gray-800 hover:border-white rounded-sm transition-all p-2 relative inline-block overflow-hidden group">
                <span
                    class="absolute inset-0 bg-blue-500 translate-x-[-110%] group-hover:translate-x-0 transition-transform duration-300 ease-out"></span>
                <span class="relative z-10">Contact</span>
            </a>
        </div>
        <div class="flex items-center md:justify-end justify-center">
            <span>Copyright © <?php echo date('Y'); ?> Hotelix. All Rights Reserved.</span>
        </div>
    </div>
</body>

</html>