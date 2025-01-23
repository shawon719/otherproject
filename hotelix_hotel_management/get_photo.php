<?php
require_once 'db_root.php'; // Include your database connection

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Sanitize input

    // Fetch the photo binary data and the MIME type from the database
    $stmt = $db_conn->prepare("SELECT photo, mime_type FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Ensure the photo and MIME type exist
        if (!empty($row['photo']) && !empty($row['mime_type'])) {
            // Set the appropriate content type header
            header("Content-Type: " . $row['mime_type']);
            echo $row['photo']; // Output the photo binary data
        } else {
            // Serve a default image if no photo or MIME type is found
            header("Content-Type: image/png");
            echo file_get_contents('profile.png'); // Path to your default image
        }
    } else {
        // Serve a default image if no user record exists
        header("Content-Type: image/png");
        echo file_get_contents('profile.png'); // Path to your default image
    }
} else {
    http_response_code(400); // Bad Request
    echo "Invalid request.";
}


?>