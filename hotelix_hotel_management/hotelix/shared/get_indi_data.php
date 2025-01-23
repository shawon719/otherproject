<?php
// Ensure no whitespace before this line
ob_start();
// session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php"); // Redirect to login page
    exit;
}

include 'db_root.php';

$userId = $_SESSION['user_id'];
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
?>