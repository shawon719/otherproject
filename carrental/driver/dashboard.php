<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else {
    // ড্রাইভার আইডি যাচাই
    $driver_id = $_GET['driver_id']; // অথবা সেশন ভেরিয়েবল ব্যবহার করুন

    // PDO স্টেটমেন্ট প্রস্তুত করা এবং এক্সিকিউট করা
    $stmt = $conn->prepare("SELECT * FROM driver WHERE id = :driver_id");
    $stmt->bindParam(':driver_id', $driver_id, PDO::PARAM_INT); // ড্রাইভার আইডি বাইন্ড করা
    $stmt->execute();

    // ড্রাইভার তথ্য ফেচ করা
    if ($stmt->rowCount() > 0) {
        // ড্রাইভারের তথ্য পাওয়া গেছে
        $driver = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "No driver found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Car Rental Portal | Admin Dashboard</title>

   <!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
	<?php include('includes/leftbar.php'); ?>
    <div class="ts-main-content">
        <div class="dashboard-container">
            <?php if (isset($driver)): ?>
                <div class="driver-info">
                    <h1>Welcome, <?php echo htmlspecialchars($driver['UserName']); ?></h1>

                    <!-- Displaying Driver's Profile -->
                    <div class="profile-picture">
                        <img src="<?php echo !empty($driver['profile_picture']) ? htmlspecialchars($driver['profile_picture']) : 'default.jpg'; ?>" alt="Profile Picture">
                    </div>

                    <div class="details">
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($driver['email']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($driver['phone']); ?></p>
                        <p><strong>License Number:</strong> <?php echo htmlspecialchars($driver['license_number']); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p>Driver details not found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scripts -->
   <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>

