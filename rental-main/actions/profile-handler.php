<?php
session_start();
error_log("Profile handler - Starting profile update");
error_log("Session data: " . print_r($_SESSION, true));
error_log("POST data: " . print_r($_POST, true));

require_once "../database/connection.php";

if (!isset($_SESSION['id'])) {
    error_log("Profile handler - No session ID found");
    $_SESSION['error'] = "Je moet ingelogd zijn om je profiel te bewerken";
    header('Location: /rydr/websiteautohuren/rental-main/public/login-form');
    exit();
}

if (!isset($_POST['name']) || !isset($_POST['email'])) {
    error_log("Profile handler - Missing required fields");
    $_SESSION['error'] = "Vul alle verplichte velden in";
    header('Location: /rydr/websiteautohuren/rental-main/public/account');
    exit();
}

$user_id = $_SESSION['id'];
$new_name = $_POST['name'];
$new_email = $_POST['email'];

error_log("Processing update for user ID: " . $user_id);
error_log("New name: " . $new_name);
error_log("New email: " . $new_email);

// Eerst proberen in de users tabel
$update_user = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
$update_user->bindParam(":name", $new_name);
$update_user->bindParam(":email", $new_email);
$update_user->bindParam(":id", $user_id);
$update_user->execute();

// Als er geen rijen zijn bijgewerkt in users, probeer dan de account tabel
if ($update_user->rowCount() === 0) {
    error_log("No update in users table, trying account table");
    $update_account = $conn->prepare("UPDATE account SET name = :name, email = :email WHERE id = :id");
    $update_account->bindParam(":name", $new_name);
    $update_account->bindParam(":email", $new_email);
    $update_account->bindParam(":id", $user_id);
    $update_account->execute();
    
    if ($update_account->rowCount() === 0) {
        error_log("No update in account table either");
        $_SESSION['error'] = "Gebruiker niet gevonden";
    } else {
        error_log("Successfully updated account table");
        $_SESSION['success'] = "Profiel succesvol bijgewerkt";
    }
} else {
    error_log("Successfully updated users table");
    $_SESSION['success'] = "Profiel succesvol bijgewerkt";
}

// Update de sessie variabelen
$_SESSION['name'] = $new_name;
$_SESSION['email'] = $new_email;

header('Location: /rydr/websiteautohuren/rental-main/public/account');
exit(); 