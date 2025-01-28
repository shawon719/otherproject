<?php
session_start();
include('includes/config.php');

if ($_SESSION['login']) {
    $useremail = $_SESSION['login'];
    $booking_id = $_GET['booking_id']; // Get booking ID from URL

    // Retrieve booking information
    $sql = "SELECT * FROM tblbooking WHERE BookingId = :booking_id AND user_email = :useremail";
    $query = $dbh->prepare($sql);
    $query->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->execute();
    $booking = $query->fetch(PDO::FETCH_ASSOC);

    // Retrieve landlord (or recipient) information
    $sql_landlord = "SELECT * FROM users WHERE email = :landlord_email"; // assuming 'users' table for landlords
    $query_landlord = $dbh->prepare($sql_landlord);
    $query_landlord->bindParam(':landlord_email', $booking['landlord_email'], PDO::PARAM_STR); // assuming there's a landlord_email field
    $query_landlord->execute();
    $landlord = $query_landlord->fetch(PDO::FETCH_ASSOC);

    if ($booking && $landlord) {
        // Show the payment form
        echo "<h2>Payment Details</h2>";
        echo "<p><strong>Booking ID:</strong> " . $booking['BookingId'] . "</p>";
        echo "<p><strong>Total Amount:</strong> $" . $booking['total_amount'] . "</p>";

        echo "<h3>Landlord Information</h3>";
        echo "<p><strong>Name:</strong> " . $landlord['first_name'] . " " . $landlord['last_name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $landlord['email'] . "</p>";
        echo "<p><strong>Phone:</strong> " . $landlord['phone'] . "</p>";

        // Payment Method Selection Form
        echo "<h3>Select Payment Method</h3>";
        echo "<form action='confirm_payment.php' method='POST'>";
        echo "<input type='hidden' name='booking_id' value='{$booking['BookingId']}'>"; // hidden field to send booking ID
        echo "<input type='hidden' name='landlord_email' value='{$landlord['email']}'>"; // hidden field for landlord email

        echo "<label for='payment_method'>Choose Payment Method:</label>";
        echo "<select name='payment_method' id='payment_method' required>
                <option value='SSL'>SSL</option>
                <option value='PayPal'>PayPal</option>
                <option value='BankTransfer'>Bank Transfer</option>
                <option value='Cash'>Cash</option>
              </select><br><br>";

        echo "<input type='submit' value='Confirm Payment'>";
        echo "</form>";
    } else {
        echo "Booking or landlord not found.";
    }
} else {
    echo "Please log in first.";
}
?>
