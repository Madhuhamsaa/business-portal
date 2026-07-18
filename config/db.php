<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "business_portal_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Uncomment this line if you want to test the connection
// echo "Database Connected Successfully!";

?>