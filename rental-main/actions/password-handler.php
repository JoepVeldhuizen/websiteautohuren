<?php
session_start();
require_once "../database/connection.php";

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "U moet ingelogd zijn om uw wachtwoord te wijzigen";
    header('Location: ./login-form');
    exit;
}

// Validate input
if (!isset($_POST['current_password']) || !isset($_POST['new_password']) || !isset($_POST['confirm_password'])) {
    $_SESSION['error'] = "Alle velden moeten worden ingevuld";
    header('Location: ./account');
    exit;
}

$userId = $_SESSION['id'];
$currentPassword = $_POST['current_password'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

// Validate new password
if (strlen($newPassword) < 8) {
    $_SESSION['error'] = "Het nieuwe wachtwoord moet minimaal 8 tekens lang zijn";
    header('Location: ./account');
    exit;
}

if ($newPassword !== $confirmPassword) {
    $_SESSION['error'] = "De nieuwe wachtwoorden komen niet overeen";
    header('Location: ./account');
    exit;
}

try {
    // Get current user data
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify current password
    if (!password_verify($currentPassword, $user['password'])) {
        $_SESSION['error'] = "Het huidige wachtwoord is onjuist";
        header('Location: ./account');
        exit;
    }

    // Hash new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update password
    $updateStmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :user_id");
    $updateStmt->bindParam(':password', $hashedPassword);
    $updateStmt->bindParam(':user_id', $userId);
    $updateStmt->execute();

    $_SESSION['success'] = "Uw wachtwoord is succesvol gewijzigd";
    header('Location: ./account');
    exit;

} catch(PDOException $e) {
    error_log("Error updating password: " . $e->getMessage());
    $_SESSION['error'] = "Er is een fout opgetreden bij het wijzigen van uw wachtwoord";
    header('Location: ./account');
    exit;
} 