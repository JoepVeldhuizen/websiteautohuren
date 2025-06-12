<?php 
require_once __DIR__ . '/../includes/get_cars.php';

// Haal het auto ID op uit de URL
$carId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Haal de auto details op uit de database
$car = getCarById($carId);

// Als de auto niet gevonden is, toon een 404 pagina
if (!$car) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

require_once __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Bekijk gedetailleerde informatie over onze huurauto's. Specificaties, prijzen, beschikbaarheid en meer. Maak direct een reservering voor uw gewenste auto.">
    <title>Auto Details</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/style.css">
</head>

<main class="car-detail">
    <div class="grid">
        <div class="row">
            <div class="advertorial">
                <h2><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h2>
                <p><?php echo htmlspecialchars($car['description']); ?></p>
                <img src="/rydr/websiteautohuren/rental-main/public/get-image.php?id=<?php echo $car['id']; ?>" 
                     alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                <img src="/rydr/websiteautohuren/rental-main/public/assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
        </div>
        <div class="row white-background">
            <h2><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h2>
            <div class="rating">
                <span class="stars stars-4"></span>
                <span>440+ reviewers</span>
            </div>
            <p><?php echo htmlspecialchars($car['description']); ?></p>
            <div class="car-type">
                <div class="grid">
                    <div class="row"><span class="accent-color">Type Car</span><span>Sport</span></div>
                    <div class="row"><span class="accent-color">Bouwjaar</span><span><?php echo htmlspecialchars($car['year']); ?></span></div>
                </div>
                <div class="grid">
                    <div class="row"><span class="accent-color">Beschikbaar</span><span><?php echo $car['available'] ? 'Ja' : 'Nee'; ?></span></div>
                    <div class="row"><span class="accent-color">Prijs per dag</span><span>€<?php echo number_format($car['price_per_day'], 2); ?></span></div>
                </div>
                <div class="call-to-action">
                    <div class="row"><span class="font-weight-bold">€<?php echo number_format($car['price_per_day'], 2); ?></span> / dag</div>
                    <div class="row">
                        <a href="/rydr/websiteautohuren/rental-main/public/rent/<?php echo $car['id']; ?>" class="button-primary">Huur nu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
