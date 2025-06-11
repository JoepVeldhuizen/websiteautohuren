<?php
// Database configuration
$host = 'localhost';
$dbname = 'rental';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // Log the error (in a production environment, you should log this to a file)
    error_log("Connection failed: " . $e->getMessage());
    
    // Show a user-friendly message
    die("Er is een probleem met de database verbinding. Probeer het later opnieuw.");
}
?> 