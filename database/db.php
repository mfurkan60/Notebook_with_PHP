<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Create a new PDO instance
    $db = new PDO("mysql:host=$servername;dbname=ergdn", $username, $password);
    
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment the line below for debugging
    // echo "Connected successfully";
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
