<?php
require_once __DIR__ . '/../database/connection.php';

if (!isset($_GET['id'])) {
    header('HTTP/1.0 400 Bad Request');
    exit('Geen auto ID opgegeven');
}

try {
    $stmt = $conn->prepare("SELECT image, image_type FROM cars WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$result) {
        header('HTTP/1.0 404 Not Found');
        exit('Auto niet gevonden');
    }
    
    // Set the appropriate content type
    header('Content-Type: ' . $result['image_type']);
    
    // Output the image data
    echo $result['image'];
} catch (PDOException $e) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('Database fout: ' . $e->getMessage());
} 