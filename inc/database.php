<?php
try {
    // Create a new PDO instance to connect to the database
    $pdo = new PDO("mysql:host=localhost;dbname=video", "video", "1234");
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
