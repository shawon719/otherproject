<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location: index.php');
} else {
    if (isset($_GET['bookingno'])) {
        $bookingno = $_GET['bookingno'];
        $useremail = $_SESSION['login'];

        // Get booking details based on booking number and user email
        $sql = "SELECT * FROM tblbooking WHERE BookingNumber = :bookingno AND userEmail = :useremail";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if (!$result) {
            echo "<script>alert('Booking not found!');</script>";
            echo "<script>window.location = 'my-booking.php';</script>";
        }
    }
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Payment | Car Rental Portal</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>
<body>
    <h1>this is payment form</h1>

<?php include('includes/header.php'); ?>

<section class="payment-section">
    <div class="container">
        <h2>Payment Details</h2>
        <div class="payment-info">
            <p><strong>Booking Number:</strong> <?php echo htmlentities($result->BookingNumber); ?></p>
            <p><strong>From Date:</strong> <?php echo htmlentities($result->FromDate); ?></p>
            <p><strong>To Date:</strong> <?php echo htmlentities($result->ToDate); ?></p>
            <p><strong>Total Amount:</strong> $<?php echo htmlentities($result->TotalAmount); ?></p>
        </div>

        <!-- Payment Form -->
        <form method="post" action="payment_process.php">
            <div class="form-group">
                <label for="paymentMethod">Payment Method:</label>
                <select class="form-control" name="paymentMethod" id="paymentMethod" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cardNumber">Card Number (if Credit Card selected):</label>
                <input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="Enter card number" required>
            </div>

            <div class="form-group">
                <label for="expiryDate">Expiry Date:</label>
                <input type="text" class="form-control" name="expiryDate" id="expiryDate" placeholder="MM/YY" required>
            </div>

            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="CVV" required>
            </div>

            <input type="hidden" name="bookingno" value="<?php echo htmlentities($result->BookingNumber); ?>">
            <input type="hidden" name="totalAmount" value="<?php echo htmlentities($result->TotalAmount); ?>">

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </form>
    </div>
</section>

<?php include('includes/footer.php'); ?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>

<?php } ?>
