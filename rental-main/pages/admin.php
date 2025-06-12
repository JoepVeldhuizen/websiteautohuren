<?php
session_start();
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../database/connection.php';

// Check if user is logged in and has admin role
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "U moet ingelogd zijn om deze pagina te bekijken";
    header('Location: /rydr/websiteautohuren/rental-main/public/login-form');
    exit;
}

// Check if user has role 1
$check_role = $conn->prepare("SELECT role FROM account WHERE id = :id");
$check_role->bindParam(":id", $_SESSION['id']);
$check_role->execute();
$user_role = $check_role->fetch(PDO::FETCH_ASSOC);

if (!$user_role || $user_role['role'] != 1) {
    $_SESSION['error'] = "U heeft geen toegang tot deze pagina";
    header('Location: /rydr/websiteautohuren/rental-main/public/');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $conn->prepare("INSERT INTO cars (brand, model, year, price_per_day, description, image_url) VALUES (:brand, :model, :year, :price_per_day, :description, :image_url)");
        
        $stmt->bindParam(':brand', $_POST['brand']);
        $stmt->bindParam(':model', $_POST['model']);
        $stmt->bindParam(':year', $_POST['year']);
        $stmt->bindParam(':price_per_day', $_POST['price_per_day']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':image_url', $_POST['image_url']);
        
        $stmt->execute();
        
        $_SESSION['success'] = "Auto succesvol toegevoegd!";
        header('Location: /rydr/websiteautohuren/rental-main/pages/admin.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Er is een fout opgetreden bij het toevoegen van de auto.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Auto Toevoegen</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/account.css">
    <style>
        .admin-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .admin-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .admin-section h2 {
            color: #000;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #000;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .submit-button {
            background-color: #000;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .submit-button:hover {
            background-color: #333;
        }

        .success-message,
        .error-message {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <main class="admin-container">
        <h1>Auto Toevoegen</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="admin-section">
            <h2>Nieuwe Auto Toevoegen</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="brand">Merk</label>
                    <input type="text" id="brand" name="brand" required>
                </div>

                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" id="model" name="model" required>
                </div>

                <div class="form-group">
                    <label for="year">Bouwjaar</label>
                    <input type="number" id="year" name="year" min="1900" max="<?php echo date('Y'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="price_per_day">Prijs per dag (€)</label>
                    <input type="number" id="price_per_day" name="price_per_day" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image_url">Afbeelding URL</label>
                    <input type="url" id="image_url" name="image_url" required>
                </div>

                <button type="submit" class="submit-button">Auto Toevoegen</button>
            </form>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html> 