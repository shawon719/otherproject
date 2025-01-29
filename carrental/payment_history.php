<?php
session_start();
include('includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header('location:login.php'); // Redirect to login page if the user is not logged in
    exit;
}

$payment_id = $_SESSION['login']; // Assuming this is an email

// Prepare the query to prevent SQL injection
$query = $dbh->prepare("SELECT * FROM payment_history WHERE UserEmail = :userEmail ORDER BY Amount DESC");
$query->bindParam(':userEmail', $payment_id, PDO::PARAM_STR);
$query->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment history</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!-- Other CSS files (optional, keep if necessary) -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    
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

        input {
            padding-left: 10px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }
    </style>
</head>

<body>
    <section class="py-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <caption class="text-center text-3xl mb-3">Payment List</caption>
                            <thead class="thead-dark">
                                <tr>
                                    <th>SL</th>
                                    <th>Payment Id</th>
                                    <th>Booking Number</th>
                                    <th>User Email</th>
                                    <th>Paid Amount</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if any payment records exist for the logged-in user
                                if ($query->rowCount() > 0) {
                                    $counter = 1;
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        // Assign the data to variables from the row
                                        $paymentid = $row['id'];
                                        $booking_num = $row['BookingNumber'];
                                        $userEmail = $row['UserEmail'];
                                        $paid_amount = $row['Amount'];  // Assuming the column name for the amount is 'Amount'
                                        $payment_method = $row['PaymentMethod'];
                                        $payment_status= $row['payment_status'];

                                        echo "
                                            <tr>
                                                <td>{$counter}</td>
                                                <td>{$paymentid}</td>
                                                <td>{$booking_num}</td>
                                                <td>{$userEmail}</td>
                                                <td>{$paid_amount}</td>
                                                <td>{$payment_method}</td>
                                                <td>{$payment_status}</td>
                                            </tr>
                                        ";
                                        $counter++;
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No Payment found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts --> 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> 
    <script src="assets/js/interface.js"></script> 
    <!--Switcher-->
    <script src="assets/switcher/js/switcher.js"></script>
    <!-- Bootstrap Slider JS -->
    <script src="assets/js/bootstrap-slider.min.js"></script> 
    <!-- Slick Slider JS -->
    <script src="assets/js/slick.min.js"></script> 
    <!-- Owl Carousel JS -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <script>
        // Automatically hide the success message after 2 seconds (if used)
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
