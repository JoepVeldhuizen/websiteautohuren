<?php
session_start();
require_once "../database/connection.php";

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "U moet ingelogd zijn om uw profiel te wijzigen";
    header('Location: ./login-form');
    exit;
}

// Validate input
if (!isset($_POST['name']) || !isset($_POST['email'])) {
    $_SESSION['error'] = "Alle velden moeten worden ingevuld";
    header('Location: ./account');
    exit;
}

$userId = $_SESSION['id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Ongeldig e-mailadres";
    header('Location: ./account');
    exit;
}

try {
    // Check if email is already in use by another user
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = :email AND id != :user_id");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->bindParam(':user_id', $userId);
    $checkEmail->execute();
    
    if ($checkEmail->fetch()) {
        $_SESSION['error'] = "Dit e-mailadres is al in gebruik";
        header('Location: ./account');
        exit;
    }

    // Handle profile image upload
    $profileImage = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['profile_image']['type'], $allowedTypes)) {
            $_SESSION['error'] = "Alleen JPEG, PNG en GIF afbeeldingen zijn toegestaan";
            header('Location: ./account');
            exit;
        }

        if ($_FILES['profile_image']['size'] > $maxSize) {
            $_SESSION['error'] = "De afbeelding mag niet groter zijn dan 5MB";
            header('Location: ./account');
            exit;
        }

        $uploadDir = __DIR__ . '/../public/images/profiles/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('profile_') . '.' . $extension;
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
            $profileImage = $filename;
        }
    }

    // Update user profile
    $updateQuery = "UPDATE users SET name = :name, email = :email";
    if ($profileImage) {
        $updateQuery .= ", profile_image = :profile_image";
    }
    $updateQuery .= " WHERE id = :user_id";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    if ($profileImage) {
        $stmt->bindParam(':profile_image', $profileImage);
    }
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    $_SESSION['success'] = "Uw profiel is succesvol bijgewerkt";
    header('Location: ./account');
    exit;

} catch(PDOException $e) {
    error_log("Error updating profile: " . $e->getMessage());
    $_SESSION['error'] = "Er is een fout opgetreden bij het bijwerken van uw profiel";
    header('Location: ./account');
    exit;
} 