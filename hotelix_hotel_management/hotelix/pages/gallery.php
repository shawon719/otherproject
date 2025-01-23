<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotelix || Gallery</title>
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
        .masonry {
            column-count: 3;
            column-gap: 1rem;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1rem;
        }

        @media(max-width: 768px) {
            .masonry {
                column-count: 2;
            }
        }

        @media(max-width:640px) {
            .masonry {
                column-count: 1;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once('../shared/header.php');
    require_once('../components/banner_hook.php');

    $page = 'gallery'; // Current page identifier
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

    ?>
    <!-- our team part  -->
    <section class="md:mx-8 mx-6 py-5">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-10">
            <h4 class="titel_content md:text-5xl text-4xl flex items-center">Hello. Our Hotel has been present for over
                17 years in
                our City. Our
                rooms are
                clean & comfortable.</h4>
            <div class="relative overflow-hidden">
                <img src="<?php echo 'assets/about/munna.jpg' ?>" alt="about room" class="w-full h-[350px] rounded-md">
                <div
                    class="absolute bottom-0 bg-black bg-opacity-35 w-full h-full flex flex-col items-center justify-end pb-11 text-white">
                    <h5 class="titel_content text-xl">Md Mustafijur Rahman Munna</h5>
                    <p class="titel_content uppercase"><span>Hotel Manager</span></p>
                </div>
            </div>

            <div class="relative overflow-hidden block md:hidden lg:block">
                <img src="<?php echo 'assets/about/munna.jpg' ?>" alt="about room" class="w-full h-[350px] rounded-md">
                <div
                    class="absolute bottom-0 bg-black bg-opacity-35 w-full h-full flex flex-col items-center justify-end pb-11 text-white">
                    <h5 class="titel_content text-xl">Md Masud Rana</h5>
                    <p class="titel_content uppercase"><span>RECEPTIONIST</span></p>
                </div>
            </div>
        </div>

        <!-- ======== gallery tabs start ======== -->
        <!-- Component: Pill lg sized tab with leading icon -->
        <section class="max-w-full py-10" aria-multiselectable="false">
            <ul class="flex items-center justify-center gap-2" role="tablist">
                <li role="presentation">
                    <button
                        class="tab-button active inline-flex items-center justify-center h-12 gap-2 md:px-6 px-2 text-sm font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-blue-600 text-white hover:bg-blue-700 border border-blue-500 focus:text-white"
                        id="tab-label-1" role="tab" aria-controls="tab-panel-1" aria-selected="true" tabindex="0">
                        <span class="order-2">All</span>
                    </button>
                </li>
                <li role="presentation">
                    <button
                        class="tab-button inline-flex items-center justify-center h-12 gap-2 md:px-6 px-2 text-sm font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-[--primary-color] hover:text-white hover:bg-blue-600 border border-blue-500 focus:text-white"
                        id="tab-label-2" role="tab" aria-controls="tab-panel-2" aria-selected="false" tabindex="-1">
                        <span class="order-2">Events</span>
                    </button>
                </li>
                <li role="presentation">
                    <button
                        class="tab-button inline-flex items-center justify-center h-12 gap-2 md:px-6 px-2 text-sm font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-[--primary-color] hover:text-white hover:bg-blue-600 border border-blue-500 focus:text-white"
                        id="tab-label-3" role="tab" aria-controls="tab-panel-3" aria-selected="false" tabindex="-1">
                        <span class="order-2">Twin Room</span>
                    </button>
                </li>
                <li role="presentation">
                    <button
                        class="tab-button inline-flex items-center justify-center h-12 gap-2 md:px-6 px-2 text-sm font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-[--primary-color] hover:text-white hover:bg-blue-600 border border-blue-500 focus:text-white"
                        id="tab-label-4" role="tab" aria-controls="tab-panel-4" aria-selected="false" tabindex="-1">
                        <span class="order-2">Single Room</span>
                    </button>
                </li>
            </ul>
            <div>
                <!-- 1st tab panel -->
                <div class="tab-panel py-10" id="tab-panel-1" aria-hidden="false" role="tabpanel" tabindex="0">
                    <div class="">

                        <div class="masonry">
                            <!-- Image Items -->
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery1.jpg' ?>" alt="about room"
                                    class="w-full lg:h-[350px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 1</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery2.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 2</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery3.jpg' ?>" alt="about room"
                                    class="w-full md:h-[250px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 3</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery4.jpg' ?>" alt="about room"
                                    class="w-full lg:h-[450px] md:h-[350px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 4</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery5.jpg' ?>" alt="about room"
                                    class="w-full md:h-[400px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 5</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery6.jpg' ?>" alt="about room"
                                    class="w-full md:h-[350px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 6</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery7.jpg' ?>" alt="about room"
                                    class="w-full lg:h-[300px] md:h-[250px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 7</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery8.jpg' ?>" alt="about room"
                                    class="w-full md:h-[250px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 8</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery9.jpg' ?>" alt="about room"
                                    class="w-full md:h-[250px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 9</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery10.jpg' ?>" alt="about room"
                                    class="w-full md:h-[450px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 10</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery11.jpg' ?>" alt="about room"
                                    class="w-full md:h-[320px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 11</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery12.jpg' ?>" alt="about room"
                                    class="w-full md:h-[320px] h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 12</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2nd tab panel -->
                <div class="tab-panel hidden px-6 py-4" id="tab-panel-2" aria-hidden="true" role="tabpanel"
                    tabindex="-1">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">
                            <!-- Image Items -->
                            
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery9.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 9</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery10.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 10</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery11.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 11</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery12.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 12</p>
                            </div>
                        </div>
                </div>

                <!-- 3rd tab panel -->
                <div class="tab-panel hidden px-6 py-4" id="tab-panel-3" aria-hidden="true" role="tabpanel"
                    tabindex="-1">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">
                            <!-- Image Items -->
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery1.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 1</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery2.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 2</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery3.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 3</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery4.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 4</p>
                            </div>
                            
                        </div>
                </div>

                <!-- 4th tab panel -->
                <div class="tab-panel hidden px-6 py-4" id="tab-panel-4" aria-hidden="true" role="tabpanel"
                    tabindex="-1">
                    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">
                            <!-- Image Items -->
                            
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery5.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 5</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery6.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 6</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery7.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 7</p>
                            </div>
                            <div class="masonry-item bg-gray-800 rounded-lg shadow-lg p-4">
                                <img src="<?php echo 'assets/gallery/gallery8.jpg' ?>" alt="about room"
                                    class="w-full h-[300px] rounded-md">
                                <p class="mt-2 text-sm">Caption or description for Image 8</p>
                            </div>
                            
                        </div>
                </div>
            </div>
        </section>
        <!-- End Pill lg sized tab with leading icon -->
        <!-- ======== gallery tabs end ======== -->
    </section>

    <?php
    require_once('../shared/footer.php');
    ?>


    <script>
        const tabs = document.querySelectorAll('.tab-button');
        const panels = document.querySelectorAll('.tab-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active state from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active', 'bg-blue-600', 'text-white');
                    t.classList.add('bg-[--primary-color]', 'text-[--secondary-color]');
                    t.setAttribute('aria-selected', 'false');
                    t.tabIndex = -1;
                });

                // Hide all panels
                panels.forEach(panel => {
                    panel.classList.add('hidden');
                    panel.setAttribute('aria-hidden', 'true');
                });

                // Add active state to the clicked tab
                tab.classList.add('active', 'bg-blue-600', 'text-white');
                tab.classList.remove('bg-white', 'text-blue-600');
                tab.setAttribute('aria-selected', 'true');
                tab.tabIndex = 0;

                // Show the corresponding panel
                const panelId = tab.getAttribute('aria-controls');
                const panel = document.getElementById(panelId);
                panel.classList.remove('hidden');
                panel.setAttribute('aria-hidden', 'false');
            });
        });
    </script>

    <script src="../../main.js"></script>
</body>

</html>