<?php
require_once "connection.php";

try {
    // Create users table
    $usersSql = file_get_contents(__DIR__ . '/users.sql');
    $conn->exec($usersSql);
    echo "Users table created successfully<br>";
    
    // Create rentals table
    $rentalsSql = file_get_contents(__DIR__ . '/rentals.sql');
    $conn->exec($rentalsSql);
    echo "Rentals table created successfully<br>";
    
    echo "All tables created successfully!";
} catch(PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
} 