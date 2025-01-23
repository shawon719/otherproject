<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <style>
        .card_main {
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }
    </style>
</head>

<body>
    <section>
        <h3 class="titel md:text-5xl text-4xl text-center">Testimonials</h3>
        <p class="titel_content text-center lg:text-5xl md:text-4xl text-2xl py-5">WORDS FROM OUR GUEST</p>

        <!-- Component: Testimonial slider -->
        <div class="relative w-full glide-08 overflow-hidden">
            <!-- Slides -->
            <div class="overflow-hidden text-center text-slate-500 md:mx-8 mx-4 py-6" data-glide-el="track">
                <div
                    class="relative w-full overflow-hidden p-0 whitespace-no-wrap flex flex-no-wrap gap-5 [backface-visibility: hidden] [transform-style: preserve-3d] [touch-action: pan-Y] [will-change: transform]">
                    <?php
                    require_once('db_root.php');
                    // Query to get all reviews from the database
                    $getReviewData = $db_conn->query("SELECT * FROM reviews ORDER BY review_time DESC");

                    if ($getReviewData->num_rows > 0) {
                        // Loop through each review and display it
                        while ($row = $getReviewData->fetch_assoc()) {
                            $userId = $row['user_id'];
                            $user_name = $row['name'];
                            $rating = $row['rating'];
                            $description = $row['description'];
                            $review_time = $row['review_time'];

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
                            // Here, we display each review dynamically
                            ?>
                            <div class="w-full border rounded-lg border-blue-400">
                                <!-- Start Testimonial -->
                                <div class="overflow-hidden">
                                    <div class="relative p-5">
                                        <figure class="relative z-10">
                                            <blockquote class="p-5 text-lg leading-loose lg:text-xl">
                                                <p class="line-clamp-4"><?php echo $description; ?></p>
                                            </blockquote>
                                            <figcaption class="flex flex-col items-center gap-2 p-5 text-sm text-emerald-500">
                                                <!-- Rating Display -->
                                                <span class="flex gap-1 text-amber-400" role="img" aria-label="Rating">
                                                    <?php
                                                    // Generate the stars based on the rating
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rating) {
                                                            echo '<i class="fa-solid fa-star text-xl"></i>';
                                                        } else {
                                                            echo '<i class="fa-regular fa-star text-xl"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                <div class="flex items-center gap-4 pt-4 text-sm text-left text-emerald-500">
                                                    <img src="get_photo.php?id=<?= htmlspecialchars($user['id']); ?>"
                                                        alt="<?= htmlspecialchars($user['name']); ?>"
                                                        title="<?= htmlspecialchars($user['name']); ?>"
                                                        class="w-16 h-16 rounded-full" />
                                                    <div class="flex flex-col gap-1">
                                                        <span class="font-bold uppercase"><?php echo $user_name; ?></span>
                                                        <cite class="not-italic"><a href="#">Software Engineer</a></cite>
                                                        <p><?php echo $review_time; ?></p>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                        <img src="<?php echo '/hotelix_hotel_management/assets/logo/quotes.png' ?>" alt="quote"
                                            class="absolute z-0 h-16 left-6 top-6">
                                        </img>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No reviews found!</p>";
                    }
                    ?>
                </div>
            </div>
            <!-- Indicators -->
            <div class="flex items-center justify-center w-full gap-2 -mt-6" data-glide-el="controls[nav]">
                <button class="p-4 group" data-glide-dir="=0" aria-label="goto slide 1"><span
                        class="block w-2 h-2 transition-colors duration-300 rounded-full opacity-70 ring-1 ring-slate-700 bg-white/20 focus:outline-none"></span></button>
                <button class="p-4 group" data-glide-dir="=1" aria-label="goto slide 2"><span
                        class="block w-2 h-2 transition-colors duration-300 rounded-full opacity-70 ring-1 ring-slate-700 bg-white/20 focus:outline-none"></span></button>
                <button class="p-4 group" data-glide-dir="=2" aria-label="goto slide 3"><span
                        class="block w-2 h-2 transition-colors duration-300 rounded-full opacity-70 ring-1 ring-slate-700 bg-white/20 focus:outline-none"></span></button>
                <button class="p-4 group" data-glide-dir="=3" aria-label="goto slide 4"><span
                        class="block w-2 h-2 transition-colors duration-300 rounded-full opacity-70 ring-1 ring-slate-700 bg-white/20 focus:outline-none"></span></button>
            </div>
        </div>
    </section>

    <!-- glide -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.0.2/glide.js"></script>

    <script>
        var glide07 = new Glide('.glide-08', {
            type: 'carousel',
            focusAt: 1,
            animationDuration: 4000,
            autoplay: 4500,
            rewind: true,
            perView: 3,
            gap: 0,
            loop: true,
            classes: {
                activeNav: '[&>*]:bg-blue-700',
            },
            breakpoints: {
                768: {
                    perView: 2
                },
                640: {
                    perView: 1
                }
            },
        });

        glide07.mount();
    </script>
</body>

</html>