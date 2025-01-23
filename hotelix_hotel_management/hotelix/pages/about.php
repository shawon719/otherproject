<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Hotel</title>
    <!-- tailwind css plugin cdn link (daisyui) -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- ======== font awesome  link ========= -->
    <script src="https://kit.fontawesome.com/9ce82b2c02.js" crossorigin="anonymous"></script>
    <!-- ========= tailwind css cdn link ======== -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ======== swiper cdn link css ======= -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- ======= vanila css ====== -->
    <link rel="stylesheet" href="../../style.css">
    <style>
        .swiper-slide-active img {
            transform: none;
            transition: none;
        }

        .slide_main img {
            transition: transform 0.3s ease;
        }

        .slide_main:hover img {
            transform: scale(1.2) rotate(5deg);
        }

        .social-icons {
            transform: translateX(-50%) translateY(96px);
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            /* Animate both opacity and position */
        }

        .slide_main:hover .social-icons {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            /* Move to its original position */
        }
    </style>
</head>

<body>
    <?php
    require_once('../shared/header.php');
    require_once('../components/banner_hook.php');

    $page = 'about'; // Current page identifier
    $banner = $pageBanners[$page];

    // Render the banner
    function renderBanner($bannerImage, $title, $subtitle)
    {
        echo "
            <div class='relative lg:h-[600px] h-[400px] w-full bg-cover bg-center bg-no-repeat ' style='background-image: url($bannerImage);'>
                <div class='bg-black bg-opacity-60 w-full h-full p-6 text-center rounded-lg flex flex-col items-center justify-center'>
                    <h1 class='md:text-6xl text-4xl font-bold text-white uppercase titel_content'>$title</h1>
                    <p class='text-lg text-gray-300 mt-2 font-bold uppercase'>$subtitle</p>
                </div>
            </div>";
    }
    renderBanner($banner['bannerImage'], $banner['title'], $banner['subtitle']);

    require_once('home/about.php');
    require_once('home/services.php');
    ?>
    <!-- our team part  -->
    <section>
        <h3 class="titel md:text-5xl text-4xl text-center">Professionals</h3>
        <p class="titel_content text-center lg:text-5xl md:text-4xl text-2xl py-5 uppercase">Behind our Team</p>
        <!-- Component: team member slider -->
        <!-- Swiper Component -->
        <div class="swiper swiper-container md:mx-8 mx-4 py-10 relative overflow-hidden">
            <div class="swiper-wrapper">
                <!-- member Card 1 -->
                <div
                    class="swiper-slide border rounded-lg border-blue-400 px-6 py-4 relative overflow-hidden slide_main">
                    <div class="relative overflow-hidden">
                        <img src="<?php echo '/hotelix_hotel_management/assets/about/munna.jpg' ?>" alt=""
                            class="h-[300px] w-full rounded-md relative overflow-hidden">
                    </div>
                    <div class="social-icons absolute left-1/2">
                        <a href="#"
                            class="mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>

                    <div class="pt-10 pb-4 text-center">
                        <h3 class="font-semibold text-xl">Md Mustafijur Rahman Munna</h3>
                        <p class="text-gray-400 font-semibold">Hotel Manager</p>
                    </div>
                </div>

                <!-- member Card 2 -->
                <div
                    class="swiper-slide border rounded-lg border-blue-400 px-6 py-4 relative overflow-hidden slide_main">
                    <div class="relative overflow-hidden">
                        <img src="<?php echo '/hotelix_hotel_management/assets/about/munna.jpg' ?>" alt=""
                            class="h-[300px] w-full rounded-md relative overflow-hidden">
                    </div>
                    <div class="social-icons absolute left-1/2">
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>

                    <div class="pt-10 pb-4 text-center">
                        <h3 class="font-semibold text-xl">Md Mustafijur Rahman Munna</h3>
                        <p class="text-gray-400 font-semibold">Hotel Manager</p>
                    </div>
                </div>

                <!-- member Card 3 -->
                <div
                    class="swiper-slide border rounded-lg border-blue-400 px-6 py-4 relative overflow-hidden slide_main">
                    <div class="relative overflow-hidden">
                        <img src="<?php echo '/hotelix_hotel_management/assets/about/munna.jpg' ?>" alt=""
                            class="h-[300px] w-full rounded-md relative overflow-hidden">
                    </div>
                    <div class="social-icons absolute left-1/2">
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>

                    <div class="pt-10 pb-4 text-center">
                        <h3 class="font-semibold text-xl">Md Mustafijur Rahman Munna</h3>
                        <p class="text-gray-400 font-semibold">Hotel Manager</p>
                    </div>
                </div>

                <!-- member Card 4 -->
                <div
                    class="swiper-slide border rounded-lg border-blue-400 px-6 py-4 relative overflow-hidden slide_main">
                    <div class="relative overflow-hidden">
                        <img src="<?php echo '/hotelix_hotel_management/assets/about/munna.jpg' ?>" alt=""
                            class="h-[300px] w-full rounded-md relative overflow-hidden">
                    </div>
                    <div class="social-icons absolute left-1/2">
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class=" mx-2 text-[25px] hover:text-blue-500 transition-transform duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>

                    <div class="pt-10 pb-4 text-center">
                        <h3 class="font-semibold text-xl">Md Mustafijur Rahman Munna</h3>
                        <p class="text-gray-400 font-semibold">Hotel Manager</p>
                    </div>
                </div>

            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

        </div>
    </section>

    <?php
    require_once('../shared/footer.php');
    ?>

    <!-- Swiper JS -->
    <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            speed: 3000,
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

        });
    </script>

    <script src="../../main.js"></script>
</body>

</html>