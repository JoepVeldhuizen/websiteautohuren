<?php
session_start();
require_once __DIR__ . '/../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Vul alle velden in";
        header('Location: ./login-form');
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            
            // Redirect to home page
            header('Location: /rydr/websiteautohuren/rental-main/public/');
            exit;
        } else {
            $_SESSION['error'] = "Ongeldige e-mail of wachtwoord";
            header('Location: ./login-form');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
        header('Location: ./login-form');
        exit;
    }
} else {
    header('Location: ./login-form');
    exit;
} 