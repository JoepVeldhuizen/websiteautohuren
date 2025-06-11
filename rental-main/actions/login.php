<?php
session_start();
error_log("Login handler - Starting login process");
require_once "../database/connection.php";

$select_user = $conn->prepare("SELECT * FROM users WHERE email = :email");
$select_user->bindParam(":email", $_POST['email']);
$select_user->execute();
$user = $select_user->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($_POST['password'], $user['password'])) {
    error_log("Login successful for user: " . $user['email']);
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];
    error_log("Session after login: " . print_r($_SESSION, true));
    header('Location: /rydr/websiteautohuren/rental-main/public/');
} else {
    error_log("Login failed for email: " . $_POST['email']);
    $_SESSION['error'] = "Ongeldige e-mail of wachtwoord";
    $_SESSION['email'] = htmlspecialchars($_POST['email']);
    header('Location: /rydr/websiteautohuren/rental-main/public/login-form');
}

