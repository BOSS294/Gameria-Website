
<?php

// Database connection parameters
$servername = ""; // Change this to your MySQL host
$username = ""; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = ""; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
include 'security_system.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    log_event($conn, 'Database Connection', 'Database connection failed.');

}
log_event($conn, 'Database Connection', 'Connected to the database successfully.', null, [
    'host' => $conn->host_info,
    'database' => $conn->$database
]);



?>

