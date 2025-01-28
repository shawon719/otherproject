<?php
session_start();
include('includes/config.php');

// চেক করুন, যদি ইউজার লগইন করে থাকে
if (!isset($_SESSION['login'])) {
    header('location:login.php'); // ইউজার যদি লগইন না থাকে তবে লগইন পেজে রিডাইরেক্ট করুন
}

if (isset($_POST['pay'])) {
    $useremail = $_SESSION['login'];
    $bookingno = $_GET['bookingno']; // বুকিং নম্বর গ্রহণ
    $paymentmethod = $_POST['paymentmethod']; // পেমেন্ট পদ্ধতি
    $amount = $_POST['amount']; // পরিমাণ

    // পেমেন্ট সফল হলে, tblbooking এবং paymenthistory টেবিল আপডেট করুন
    // $status = 'paid'; // পেমেন্ট সম্পন্ন হয়েছে

    // প্রথমে tblbooking টেবিল আপডেট করুন
    $sql = "UPDATE tblbooking SET payment_status='paid' WHERE BookingNumber=:bookingno";
    $query = $dbh->prepare($sql);
    // $query->bindParam(':status', $status, PDO::PARAM_INT);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->execute();

    $sql = "UPDATE tblbooking SET payment_method=:paymentmethod WHERE BookingNumber=:bookingno";
    $query = $dbh->prepare($sql);
    $query->bindParam(':paymentmethod', $paymentmethod, PDO::PARAM_STR);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->execute();

    // এখন paymenthistory টেবিল আপডেট করুন
    $paymentid = mt_rand(100000000, 999999999); // পেমেন্ট আইডি তৈরি
    $sql_payment = "INSERT INTO payment_history (PaymentId, BookingNumber, UserEmail, Amount, PaymentMethod) VALUES (:paymentid, :bookingno, :useremail, :amount, :paymentmethod)";
    $query_payment = $dbh->prepare($sql_payment);
    $query_payment->bindParam(':paymentid', $paymentid, PDO::PARAM_INT);
    $query_payment->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query_payment->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query_payment->bindParam(':amount', $amount, PDO::PARAM_STR);
    $query_payment->bindParam(':paymentmethod', $paymentmethod, PDO::PARAM_STR);
    $query_payment->execute();


    $sql = "UPDATE payment_history SET payment_status='paid' WHERE BookingNumber=:bookingno";
    $query = $dbh->prepare($sql);
    // $query->bindParam(':status', $status, PDO::PARAM_INT);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->execute();


    echo "<script>alert('Payment Successful!');</script>";
    echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
   

    
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Payment | Car Rental</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!-- FontAwesome -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include('includes/header.php');?>

<!-- Payment Form -->
<section class="container">
    <h2>Payment Details</h2>
    <form method="post">
        <div class="form-group">
            <label>Booking Number:</label>
            <input type="text" class="form-control" name="bookingno" value="<?php echo $_GET['bookingno']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Total Amount:</label>
            <!-- <input type="text" class="form-control" name="amount" value="<?php //echo $_GET['amount']; ?>" readonly> -->
            <input type="text" class="form-control" name="amount"  >

        </div>
        <div class="form-group">
            <label>Payment Method:</label>
            <select class="form-control" name="paymentmethod" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>
        <button type="submit" name="pay" class="btn btn-primary">Pay</button>
    </form>
</section>

<!-- Footer -->
<?php include('includes/footer.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>


</body>
</html>
