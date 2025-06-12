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

try {
    // Start transaction
    $conn->beginTransaction();

    // Check if email is already in use by another user
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
    $check_email->bindParam(":email", $new_email);
    $check_email->bindParam(":id", $user_id);
    $check_email->execute();

    if ($check_email->rowCount() > 0) {
        throw new Exception("Dit e-mailadres is al in gebruik door een ander account.");
    }

    // Update users table
    $update_user = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $update_user->bindParam(":name", $new_name);
    $update_user->bindParam(":email", $new_email);
    $update_user->bindParam(":id", $user_id);
    $update_user->execute();

    // Update account table (only email, since it doesn't have a name column)
    $update_account = $conn->prepare("UPDATE account SET email = :email WHERE id = :id");
    $update_account->bindParam(":email", $new_email);
    $update_account->bindParam(":id", $user_id);
    $update_account->execute();

    // Commit transaction
    $conn->commit();

    // Update session variables
    $_SESSION['name'] = $new_name;
    $_SESSION['email'] = $new_email;
    $_SESSION['success'] = "Profiel succesvol bijgewerkt";

} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollBack();
    error_log("Profile update error: " . $e->getMessage());
    $_SESSION['error'] = $e->getMessage();
}

header('Location: /rydr/websiteautohuren/rental-main/public/account');
exit(); 