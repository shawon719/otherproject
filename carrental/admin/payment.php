<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Ensure the user is logged in, and fetch their information from the database
if (isset($_SESSION['alogin'])) {
    $userId = $_SESSION['alogin'];

    // Fetch user data from the database
    // $query = "SELECT * FROM tblusers WHERE id = :userId";
    $query = "SELECT * FROM tblusers WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // If no user is found, handle the case (maybe redirect or show an error)
        echo "User not found!";
        exit;
    }
} else {
    // Redirect to login if the user is not logged in
    header('Location: login.php');
    exit;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Car Rental Portal | Admin Update Brand</title>

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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        #form_container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            max-width: 600px;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 12px;
            font-size: 16px;
        }

        .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 12px;
            font-size: 16px;
            background-color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 16px;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: none;
        }

        .alert.success {
            display: block;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body>

    <section class="w-full py-20 min-h-[100vh] titel_content" id="form_container">
        <form action="" method="post" enctype="multipart/form-data">

            <h2 class="text-2xl font-bold text-center mb-4">Payment</h2>

            <input type="hidden" name="userId" id="userId" value="<?= htmlspecialchars($user['id']) ?>">
            <input type="hidden" name="booking_id" id="booking_id" value="<?= htmlspecialchars($booking['id']) ?>">

            <div class="mb-3">
                <input type="text" name="u_name" id="u_name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" readonly required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly required>
            </div>

            <div class="mb-3">
                <input type="text" name="room_type" id="room_type" class="form-control" value="<?= htmlspecialchars($booking['room_type']) ?>" readonly required>
            </div>
            <div class="mb-3">
                <input type="text" name="room_number" id="room_number" class="form-control" value="<?= htmlspecialchars($booking['room_number']) ?>" readonly required>
            </div>

            <div class="mb-3">
                <input type="text" name="total_price" id="total_price" class="form-control" value="<?= htmlspecialchars($booking['total_amount']) ?>" readonly required>
            </div>

            <div class="mb-3">
                <input type="text" name="reciver_name" id="reciver_name" class="form-control" value="<?= htmlspecialchars($receiver_name) ?>" readonly required>
            </div>

            <div class="mb-3">
                <select name="payment_method" id="payment_method" class="form-select">
                    <option value="" selected>Choose Payment Method</option>
                    <option value="SSL">SSL</option>
                    <option value="PayPal">PayPal</option>
                </select>
                <small class="text-danger"><?= $errors['payment_method'] ?? '' ?></small>
            </div>

            <div>
                <button type="submit" name="paymentBtn" class="btn btn-primary w-100">Pay</button>
            </div>
        </form>
    </section>

    <!-- Loading Scripts -->
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
