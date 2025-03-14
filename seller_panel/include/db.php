<?php
$host = "localhost";  // Change if your database is hosted elsewhere
$user = "root";       // Default XAMPP user is "root"
$pass = "";           // Default XAMPP password is empty
$dbname = "add_product"; // Your actual database name

$connection = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
