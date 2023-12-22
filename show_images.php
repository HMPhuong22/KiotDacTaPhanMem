<?php
// Replace these with your actual database credentials
$db_name = 'mysql:host=localhost;dbname=test';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Retrieve image data from the database
$query = "SELECT * FROM anh";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Set the appropriate headers for image display
    header("Content-type: image/jpg");
    echo $result['images'];
} else {
    echo "Image not found.";
}
?>
