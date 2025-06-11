<?php
require_once "connection.php";

try {
    // Start transaction
    $conn->beginTransaction();

    // Get all users from account table
    $stmt = $conn->query("SELECT * FROM account");
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Insert each account into users table
    $insertStmt = $conn->prepare("INSERT INTO users (id, email, password, name, created_at) 
                                 VALUES (:id, :email, :password, :name, NOW())");

    foreach ($accounts as $account) {
        // Use email as name if no name is set
        $name = explode('@', $account['email'])[0]; // Use part before @ as name
        
        $insertStmt->execute([
            ':id' => $account['id'],
            ':email' => $account['email'],
            ':password' => $account['password'],
            ':name' => $name
        ]);
    }

    // Commit transaction
    $conn->commit();
    echo "Migration completed successfully!";
} catch (PDOException $e) {
    // Rollback transaction on error
    $conn->rollBack();
    echo "Migration failed: " . $e->getMessage();
} 