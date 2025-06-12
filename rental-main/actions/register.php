<?php
session_start();
require "../database/connection.php";

$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];

if ($password === $confirm_password) {
    $check_user = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $check_user->bindParam(":email", $email);
    $check_user->execute();

    if ($check_user->rowCount() === 0) {
        //Extra hoge cost om nog beter te beveiligen kostte teveel tijd
        $options = ['cost' => 12];
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT, $options);
        
        // Use part before @ as initial name
        $name = explode('@', $email)[0];

        // Start transaction
        $conn->beginTransaction();

        try {
            // Insert into users table
            $create_user = $conn->prepare("INSERT INTO users (email, password, name) VALUES (:email, :password, :name)");
            $create_user->bindParam(":email", $email);
            $create_user->bindParam(":password", $encrypted_password);
            $create_user->bindParam(":name", $name);
            $create_user->execute();

            // Get the last inserted ID
            $user_id = $conn->lastInsertId();

            // Insert into account table
            $create_account = $conn->prepare("INSERT INTO account (id, email, password) VALUES (:id, :email, :password)");
            $create_account->bindParam(":id", $user_id);
            $create_account->bindParam(":email", $email);
            $create_account->bindParam(":password", $encrypted_password);
            $create_account->execute();

            // Commit transaction
            $conn->commit();

            $_SESSION["success"] = "Registratie is gelukt, log nu in:";
            header("Location: ./login-form");
            exit();
        } catch (PDOException $e) {
            // Rollback transaction on error
            $conn->rollBack();
            $_SESSION["message"] = "Er is een fout opgetreden bij het registreren.";
            $_SESSION["email"] = htmlspecialchars($email);
            header("Location: ./register-form");
            exit();
        }
    } else {
        $_SESSION["message"] = "Dit e-mailadres is al in gebruik.";
        $_SESSION["email"] = htmlspecialchars($email);
        header("Location: ./register-form");
        exit();
    }
} else {
    $_SESSION["message"] = "Wachtwoorden komen niet overeen.";
    $_SESSION["email"] = htmlspecialchars($email);
    header("Location: ./register-form.php");
    exit();
}
