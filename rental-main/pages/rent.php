<?php
session_start();
require_once __DIR__ . '/../includes/get_cars.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "U moet ingelogd zijn om een auto te huren";
    header('Location: ./login-form');
    exit;
}

// Get car ID from URL
$carId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get car details
$car = getCarById($carId);

// If car not found, show 404
if (!$car) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

// If car is not available, redirect to car list
if (!$car['available']) {
    $_SESSION['error'] = "Deze auto is momenteel niet beschikbaar";
    header('Location: ./ons-aanbod');
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Huur een auto bij Rydr. Selecteer uw gewenste huurperiode en maak direct een reservering.">
    <title>Auto Huren - <?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/style.css">
</head>
<body>
    <main class="container">
        <h1>Auto Huren</h1>
        
        <div class="rental-form-container">
            <div class="car-summary">
                <h2><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h2>
                <img src="/rydr/websiteautohuren/rental-main/public/images/cars/<?php echo htmlspecialchars($car['image']); ?>" 
                     alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                <p class="price">€<?php echo number_format($car['price_per_day'], 2); ?> per dag</p>
            </div>

            <form action="./rental-handler" method="post" class="rental-form">
                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                
                <div class="form-group">
                    <label for="start_date">Startdatum</label>
                    <input type="date" id="start_date" name="start_date" required 
                           min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                    <label for="end_date">Einddatum</label>
                    <input type="date" id="end_date" name="end_date" required 
                           min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>

                <div class="form-group">
                    <label for="pickup_location">Ophaallocatie</label>
                    <select id="pickup_location" name="pickup_location" required>
                        <option value="">Selecteer een locatie</option>
                        <option value="rotterdam_centraal">Rotterdam Centraal</option>
                        <option value="rotterdam_airport">Rotterdam Airport</option>
                        <option value="rotterdam_zuid">Rotterdam Zuid</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dropoff_location">Retourlocatie</label>
                    <select id="dropoff_location" name="dropoff_location" required>
                        <option value="">Selecteer een locatie</option>
                        <option value="rotterdam_centraal">Rotterdam Centraal</option>
                        <option value="rotterdam_airport">Rotterdam Airport</option>
                        <option value="rotterdam_zuid">Rotterdam Zuid</option>
                    </select>
                </div>

                <div class="price-summary">
                    <h3>Prijsopgave</h3>
                    <div class="price-details">
                        <p>Prijs per dag: €<?php echo number_format($car['price_per_day'], 2); ?></p>
                        <p>Aantal dagen: <span id="days">0</span></p>
                        <p class="total">Totaalprijs: €<span id="total_price">0.00</span></p>
                    </div>
                </div>

                <button type="submit" class="button-primary">Bevestig reservering</button>
            </form>
        </div>
    </main>

    <script>
        // Calculate total price based on selected dates
        function calculatePrice() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);
            const pricePerDay = <?php echo $car['price_per_day']; ?>;
            
            if (startDate && endDate && startDate < endDate) {
                const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                const totalPrice = days * pricePerDay;
                
                document.getElementById('days').textContent = days;
                document.getElementById('total_price').textContent = totalPrice.toFixed(2);
            }
        }

        // Add event listeners to date inputs
        document.getElementById('start_date').addEventListener('change', calculatePrice);
        document.getElementById('end_date').addEventListener('change', calculatePrice);
    </script>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html> 