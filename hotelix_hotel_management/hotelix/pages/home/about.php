<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <style>
        /* .signature {
            filter: invert(56%) sepia(0%) saturate(3677%) hue-rotate(333deg) brightness(78%) contrast(66%);
        } */
    </style>
</head>

<body>
    <section class="py-5">
        <h3 class="titel md:text-5xl text-4xl text-center">About Our Hotel</h3>
        <div class="md:mx-8 mx-6 py-5">
            <div class="flex justify-center items-center z-0 p-0 gap-10 flex-col lg:flex-row">
                <div class="lg:w-[350px] md:w-full">
                    <img src="<?php echo 'assets/about/about-1.jpg' ?>" alt="about room"
                        class="w-full md:h-[550px] lg:h-[auto] rounded-md">
                </div>
                <div>
                    <div class="relative overflow-hidden">
                        <img src="<?php echo 'assets/about/about-2.jpg' ?>" alt="about room"
                            class="w-[85%] md:w-[270px] h-[228px] rounded-md">
                        <div
                            class="absolute text-6xl w-36 h-36 rounded-full border flex flex-col justify-center items-center bg-blue-300 lg:left-[20%] md:left-[25%] left-[57%] top-[13%] titel_content">
                            17+ <span class="text-3xl">Years</span></div>
                    </div>
                    <h3 class="titel md:text-4xl text-3xl py-4">Our Hotel</h3>
                    <p class=" lg:text-6xl md:text-5xl text-4xl titel_content uppercase">
                        The worlds
                        luxurious hotel
                    </p>
                </div>
            </div>

            <!-- 2nd part  -->
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5 my-8">
                <div class="hidden lg:block ">
                    <h4 class="titel_content uppercase font-semibold text-4xl ">Enjoy an extra-ordinary
                        retreat with
                        exclusive
                        offers</h4>
                    <div class="relative">
                        <div class="my-5 flex items-center gap-5">
                            <img src="<?php echo 'assets/about/munna.jpg' ?>" alt="manager pic"
                                class="w-20 h-20 rounded-full">
                            <div class="titel_content">
                                <h2 class="font-semibold text-xl">Md Mustafijur Rahman Munna</h2>
                                <p>Hotel Manager</p>
                            </div>
                        </div>
                        <img src="<?php echo 'assets/about/sign_white.png' ?>" alt="manager sign"
                            class="signature w-64 absolute left-10 top-[70px]" stoke="white">
                    </div>
                </div>
                <div>
                    <img src="<?php echo 'assets/about/about-3.jpg' ?>" alt="about room" class="rounded-md">
                </div>
                <div class="titel_content">
                    <p class=" text-xl">The masterbuilder of human happiness no one dislikes, too avoids
                        pleasure
                        itself because it is
                        pleasure, but because those who do not knows pleasure rationally encounters consequences pursues
                        or desires to obtain.</p>
                    <p class="text-xl py-5"><i class="fa-solid fa-circle-check mr-3"></i><span>Experience luxury in the
                            lap
                            of nature</span>
                    </p>
                    <p class="text-xl pb-5"><i class="fa-solid fa-circle-check mr-3"></i><span>Providing iconic
                            experiences</span>
                    </p>
                    <!-- about more btn  -->
                    <a href="" class="uppercase text-xl hover:text-blue-500 transition-all"><i
                            class="fa-solid fa-arrow-right-long mr-3"></i>More
                        About
                        Us</a>

                </div>
            </div>

        </div>


    </section>
</body>

</html>

<!-- #ecfdf5  -->
<!-- // document.addEventListener('DOMContentLoaded', () => {
        //     const dropdownToggles = document.querySelectorAll('[data-collapse-toggle]');

        //     dropdownToggles.forEach(toggle => {
        //         const menuId = toggle.getAttribute('aria-controls');
        //         const dropdownMenu = document.getElementById(menuId);

        //         toggle.addEventListener('click', () => {
        //             dropdownMenu.classList.toggle('hidden');
        //         });
        //     });
        // }); -->