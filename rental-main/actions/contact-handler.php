<?php
session_start();
require_once '../includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Ongeldig e-mailadres";
        header("Location: ../pages/hulp.php");
        exit();
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO contact_requests (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $subject, $message]);
        
        // Send email notification to admin
        $to = "info@rydr.nl";
        $email_subject = "Nieuw contactformulier bericht: " . $subject;
        $email_body = "Naam: " . $name . "\n";
        $email_body .= "Email: " . $email . "\n";
        $email_body .= "Onderwerp: " . $subject . "\n\n";
        $email_body .= "Bericht:\n" . $message;
        
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        
        mail($to, $email_subject, $email_body, $headers);
        
        $_SESSION['success'] = "Bedankt voor uw bericht. We nemen zo spoedig mogelijk contact met u op.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
    }
    
    header("Location: ../pages/hulp.php");
    exit();
} else {
    header("Location: ../pages/hulp.php");
    exit();
}
?> 