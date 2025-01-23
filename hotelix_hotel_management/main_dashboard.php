<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/9ce82b2c02.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body class="">
    <section>
        <?php require_once 'hotelix/shared/topbar.php'; ?>
        <div class="flex ">
            <?php require_once 'hotelix/shared/sidebar.php'; ?>
            <main class="flex-1 p-6 h-screen overflow-y-auto">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
                $file = "hotelix/dashboard_pages/{$page}.php";
                if (file_exists($file)) {
                    include $file;
                } else {
                    echo "<h1 class='text-2xl'>Page not found</h1>";
                }
                ?>
            </main>
        </div>
        <div class="flex items-center justify-center bg-gray-800 text-white py-5">
            <span>Copyright © <?php echo date('Y'); ?> Hotelix. All Rights Reserved.</span>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $('.ajax-link').on('click', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $('main').html('<div class="text-center py-10 flex justify-center items-center h-screen"><span class="loading loading-ring  w-20"></span></div>');
                $.get(url, function (data) {
                    const content = $(data).find('main').html();
                    $('main').html(content);
                    history.pushState(null, '', url);
                }).fail(function () {
                    $('main').html('<div class="text-center py-10"><span>Error loading content.</span></div>');
                });
            });
            window.onpopstate = function () {
                const url = window.location.href;
                $.get(url, function (data) {
                    const content = $(data).find('main').html();
                    $('main').html(content);
                });
            };
        });
    </script>
</body>

</html>