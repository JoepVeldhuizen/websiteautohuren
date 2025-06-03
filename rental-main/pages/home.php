<?php
require_once __DIR__ . '/../includes/get_cars.php';

$cars = getAvailableCars();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Verhuur - Home</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <h1>Beschikbare Auto's</h1>
        
       
        
        <div class="cars-grid">
            <?php foreach ($cars as $car): ?>
                <div class="car-card">
                    <img src="/rydr/websiteautohuren/rental-main/public/images/cars/<?php echo htmlspecialchars($car['image']); ?>" 
                         alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
                    <div class="car-info">
                        <h2><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h2>
                        <p class="category"><?php echo htmlspecialchars($car['category_name']); ?></p>
                        <p class="year">Bouwjaar: <?php echo htmlspecialchars($car['year']); ?></p>
                        <p class="price">€<?php echo number_format($car['price_per_day'], 2); ?> per dag</p>
                        <p class="description"><?php echo htmlspecialchars($car['description']); ?></p>
                        <a href="/rydr/websiteautohuren/rental-main/public/car-detail?id=<?php echo $car['id']; ?>" 
                           class="btn btn-primary">Bekijk details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="show-more">
            <a href="/rydr/websiteautohuren/rental-main/public/ons-aanbod" class="btn btn-primary">Bekijk ons complete aanbod</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>