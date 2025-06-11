<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../database/connection.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "U moet ingelogd zijn om uw profiel te bekijken";
    header('Location: ./login-form');
    exit;
}

// Get user data
$userId = $_SESSION['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user exists
if (!$user) {
    // Try to get user from account table as fallback
    $stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $accountUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($accountUser) {
        // If found in account table, migrate this user
        $name = explode('@', $accountUser['email'])[0];
        $insertStmt = $conn->prepare("INSERT INTO users (id, email, password, name, created_at) 
                                     VALUES (:id, :email, :password, :name, NOW())");
        $insertStmt->execute([
            ':id' => $accountUser['id'],
            ':email' => $accountUser['email'],
            ':password' => $accountUser['password'],
            ':name' => $name
        ]);
        
        // Refresh user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $_SESSION['error'] = "Gebruiker niet gevonden";
        header('Location: ./login-form');
        exit;
    }
}

// Get user's rentals
$rentalStmt = $conn->prepare("
    SELECT r.*, c.brand, c.model, c.image 
    FROM rentals r 
    JOIN cars c ON r.car_id = c.id 
    WHERE r.user_id = :user_id 
    ORDER BY r.start_date DESC
");
$rentalStmt->bindParam(':user_id', $userId);
$rentalStmt->execute();
$rentals = $rentalStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Account - Rydr</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/style.css">
    <style>
        /* Fallback styles in case the external CSS fails to load */
        .account-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            padding: 2rem 0;
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-section,
        .password-section,
        .rentals-section {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out;
        }

        .profile-section:hover,
        .password-section:hover {
            transform: translateY(-5px);
        }

        .profile-image {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .profile-image img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #000000;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #000000;
            border-radius: 8px;
        }

        .button-primary {
            background-color: #000000;
            color: #ffffff;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
        }

        .rentals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .rental-card {
            border: 2px solid #000000;
            border-radius: 12px;
            overflow: hidden;
        }

        .rental-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .rental-info {
            padding: 1.5rem;
        }

        .status {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            margin-top: 1rem;
        }

        .status.pending { background-color: #fff3cd; color: #856404; }
        .status.confirmed { background-color: #d4edda; color: #155724; }
        .status.completed { background-color: #cce5ff; color: #004085; }
        .status.cancelled { background-color: #f8d7da; color: #721c24; }

        @media (min-width: 768px) {
            .account-container {
                grid-template-columns: repeat(2, 1fr);
            }
            .rentals-section {
                grid-column: 1 / -1;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <h1>Mijn Account</h1>

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

        <div class="account-container">
            <div class="profile-section">
                <h2>Profiel Informatie</h2>
                <form action="./profile-handler" method="post" enctype="multipart/form-data" class="profile-form">
                    <div class="profile-image">
                        <img src="<?php echo $user['profile_image'] ? '/rydr/websiteautohuren/rental-main/public/images/profiles/' . htmlspecialchars($user['profile_image']) : '/rydr/websiteautohuren/rental-main/public/images/default-profile.png'; ?>" 
                             alt="Profiel foto">
                        <div class="form-group">
                            <label for="profile_image">Wijzig profielfoto</label>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <button type="submit" class="button-primary">Update Profiel</button>
                </form>
            </div>

            <div class="password-section">
                <h2>Wachtwoord Wijzigen</h2>
                <form action="./password-handler" method="post" class="password-form">
                    <div class="form-group">
                        <label for="current_password">Huidig Wachtwoord</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nieuw Wachtwoord</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Bevestig Nieuw Wachtwoord</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" class="button-primary">Wijzig Wachtwoord</button>
                </form>
            </div>

            <div class="rentals-section">
                <h2>Mijn Reserveringen</h2>
                <?php if (empty($rentals)): ?>
                    <p>U heeft nog geen reserveringen.</p>
                <?php else: ?>
                    <div class="rentals-grid">
                        <?php foreach ($rentals as $rental): ?>
                            <div class="rental-card">
                                <img src="/rydr/websiteautohuren/rental-main/public/images/cars/<?php echo htmlspecialchars($rental['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($rental['brand'] . ' ' . $rental['model']); ?>">
                                <div class="rental-info">
                                    <h3><?php echo htmlspecialchars($rental['brand'] . ' ' . $rental['model']); ?></h3>
                                    <p>Startdatum: <?php echo date('d-m-Y', strtotime($rental['start_date'])); ?></p>
                                    <p>Einddatum: <?php echo date('d-m-Y', strtotime($rental['end_date'])); ?></p>
                                    <p class="status <?php echo htmlspecialchars($rental['status']); ?>">
                                        <?php 
                                        $statusLabels = [
                                            'pending' => 'In afwachting',
                                            'confirmed' => 'Bevestigd',
                                            'completed' => 'Voltooid',
                                            'cancelled' => 'Geannuleerd'
                                        ];
                                        echo $statusLabels[$rental['status']] ?? $rental['status'];
                                        ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html> 
<input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?>">
<input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?>">
