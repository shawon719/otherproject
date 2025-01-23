<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/hotelix_hotel_management/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotelix || Services</title>

    <style>
        /* From Uiverse.io by Pradeepsaranbishnoi */
        .wallet {
            --bg-color: #71a5e5bf;
            --bg-color-light: #ffffff;
            --text-color-hover: #fff;
            --box-shadow-color: #3ed766;
        }

        .card {
            width: 100%;
            height: 321px;
            border-top-right-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            transition: all 0.4s ease-out;
            text-decoration: none;
            border: 1px solid #60a5fa;

        }

        .card:hover {
            transform: translateY(-5px) scale(1.005) translateZ(0);
            box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
                0 3px 10px var(--box-shadow-color);
            cursor: pointer;
        }

        .card:hover .overlay {
            transform: scale(4) translateZ(0);
            height: 146px;
            width: 146px;
        }

        .card:hover .circle {
            border-color: var(--bg-color-light);
            background: var(--bg-color);
        }

        .card:hover .circle:after {
            background: var(--bg-color-light);
        }

        .card:hover p {
            color: var(--text-color-hover);
        }

        .card p {
            font-size: 17px;
            color: #4c5656;
            z-index: 10;
            transition: color 0.4s ease-out;
        }

        .card h4 {
            transition: color 0.4s ease-out;
        }

        .circle {
            border: 2px solid var(--bg-color);
            transition: all 0.4s ease-out;
        }

        .circle:after {
            content: "";
            width: 118px;
            height: 118px;
            display: block;
            position: absolute;
            background: #ffffff96;
            border-radius: 50%;
            top: 7px;
            left: 7px;
            transition: opacity 0.4s ease-out;
        }

        .circle img {
            z-index: 10;
            transform: translateZ(0);
        }

        .overlay {
            background: var(--bg-color);
            transition: transform 0.4s ease-out;
        }
    </style>

</head>

<body>
    <section class="md:mx-8 mx-4 py-5">
        <h3 class="titel md:text-5xl text-4xl text-center">Why Choose Us</h3>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5 py-5">
            <div
                class="card wallet bg-[--primary-color] flex overflow-hidden flex-col justify-center items-center relative">
                <div
                    class="overlay w-[130px] h-[130px] absolute rounded-full lg:top-[32px] md:top-[28px] top-[20px] lg:left-[135px] md:left-[100px] left-[105px] z-0">
                </div>
                <div
                    class="circle w-[131px] h-[131px] flex justify-center items-center relative rounded-full bg-white z-10">
                    <img src="<?php echo 'assets/services/cctv-camera.png' ?>" alt="security" class="w-[68px]">
                </div>
                <h4 class="py-5 text-2xl z-10 titel_content">24 Hrs Security</h4>
                <p class="text-center px-1">Desires to obtain pain of itself it is because occasional circumstance some
                    great
                    pleasure of us ...</p>
            </div>

            <div
                class="card wallet bg-[--primary-color] flex overflow-hidden flex-col justify-center items-center relative">
                <div
                    class="overlay w-[130px] h-[130px] absolute rounded-full lg:top-[32px] md:top-[28px] top-[20px] lg:left-[135px] md:left-[100px] left-[105px] z-0">
                </div>
                <div
                    class="circle w-[131px] h-[131px] flex justify-center items-center relative rounded-full bg-white z-10">
                    <img src="<?php echo 'assets/services/free-wifi.png' ?>" alt="free-wifi" class="w-16">
                </div>
                <h4 class="py-5 text-2xl z-10 titel_content">Wi-Fi Connection</h4>
                <p class="text-center px-1">DTake a trivial example, which of us ever undertakes laborious physical
                    obtain
                    some
                    advantage.</p>
            </div>

            <div
                class="card wallet bg-[--primary-color] hidden md:flex overflow-hidden flex-col justify-center items-center relative">
                <div
                    class="overlay w-[130px] h-[130px] absolute rounded-full lg:top-[32px] md:top-[28px] top-[20px] lg:left-[135px] md:left-[100px] left-[105px] z-0">
                </div>
                <div
                    class="circle w-[131px] h-[131px] flex justify-center items-center relative rounded-full bg-white z-10">
                    <img src="<?php echo 'assets/services/laundry.png' ?>" alt="laundry" class="w-16">
                </div>
                <h4 class="py-5 text-2xl z-10 titel_content">Laundry & Dry Cleaning</h4>
                <p class="text-center px-1">Right to find fault with a man who chooses to enjoy a pleasure that annoying
                    consequences.</p>
            </div>

            <div
                class="card wallet bg-[--primary-color] flex overflow-hidden flex-col justify-center items-center relative">
                <div
                    class="overlay w-[130px] h-[130px] absolute rounded-full lg:top-[32px] md:top-[28px] top-[20px] lg:left-[135px] md:left-[100px] left-[105px] z-0">
                </div>
                <div
                    class="circle w-[131px] h-[131px] flex justify-center items-center relative rounded-full bg-white z-10">
                    <img src="<?php echo 'assets/services/room-service.png' ?>" alt="room-service" class="w-16">
                </div>
                <h4 class="py-5 text-2xl z-10 titel_content">24 Hrs Room Service</h4>
                <p class="text-center px-2">hello !How all this mistake idea denonce all like to pleasure complete
                    account
                    off
                    the
                    system. . .
                </p>
            </div>

            <div
                class="card wallet bg-[--primary-color] flex overflow-hidden flex-col justify-center items-center relative">
                <div
                    class="overlay w-[130px] h-[130px] absolute rounded-full lg:top-[32px] md:top-[28px] top-[20px] lg:left-[135px] md:left-[100px] left-[105px] z-0">
                </div>
                <div
                    class="circle w-[131px] h-[131px] flex justify-center items-center relative rounded-full bg-white z-10">
                    <img src="<?php echo 'assets/services/satisfaction.png' ?>" alt="low-rated" class="w-16">
                </div>
                <h4 class="py-5 text-2xl z-10 titel_content">Best Rate Guarantee</h4>
                <p class="text-center px-1">If you find a lower online rate, we will match it and give you an additional
                    25%
                    off
                    on your stay.</p>
            </div>

            <div
                class="card wallet bg-[--primary-color] hidden md:flex overflow-hidden flex-col justify-center items-center relative">
                <div
                    class="overlay w-[130px] h-[130px] absolute rounded-full lg:top-[32px] md:top-[28px] top-[20px] lg:left-[135px] md:left-[100px] left-[95px] z-0">
                </div>
                <div
                    class="circle w-[131px] h-[131px] flex justify-center items-center relative rounded-full bg-white z-10">
                    <img src="<?php echo 'assets/services/cloudy-night.png' ?>" alt="night-service" class="w-16">
                </div>
                <h4 class="py-5 text-2xl z-10 titel_content">Enjoy Free Nights</h4>
                <p class="text-center px-1">to the family, has been completely renovated with care
                    &amp; passion while respecting the spirit of place.</p>
            </div>

        </div>
    </section>
</body>

</html>