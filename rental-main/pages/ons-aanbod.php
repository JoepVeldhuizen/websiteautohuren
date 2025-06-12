<?php
require_once __DIR__ . '/../includes/get_cars.php';

// Haal de geselecteerde categorie op uit de URL
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : null;

// Haal alle categorieën op
$categories = getAllCategories();

// Haal de zoekterm op uit de URL
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Haal de auto's op (gefilterd op categorie als er een is geselecteerd)
$cars = getAvailableCars($selectedCategory);

// Filter de auto's op zoekterm (merk, model, omschrijving)
if ($searchTerm !== '') {
    $searchTermLower = mb_strtolower($searchTerm);
    $cars = array_filter($cars, function($car) use ($searchTermLower) {
        return strpos(mb_strtolower($car['brand']), $searchTermLower) !== false
            || strpos(mb_strtolower($car['model']), $searchTermLower) !== false
            || strpos(mb_strtolower($car['description']), $searchTermLower) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Bekijk ons complete aanbod van huurauto's. Van economische modellen tot luxe voertuigen - wij hebben de perfecte auto voor elke gelegenheid. Vind uw ideale huurauto vandaag nog.">
    <title>Ons Aanbod - Auto Verhuur</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <h1>Ons Complete Aanbod</h1>
        
        <!-- Categorie filter -->
        <div class="category-filter">
            <h2>Filter op categorie</h2>
            <div class="category-buttons">
                <a href="/rydr/websiteautohuren/rental-main/public/ons-aanbod" 
                   class="btn <?php echo $selectedCategory === null ? 'btn-primary' : 'btn-secondary'; ?>">
                    Alle auto's
                </a>
                <?php foreach ($categories as $category): ?>
                    <a href="/rydr/websiteautohuren/rental-main/public/ons-aanbod?category=<?php echo $category['id']; ?>" 
                       class="btn <?php echo $selectedCategory == $category['id'] ? 'btn-primary' : 'btn-secondary'; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="cars-grid">
            <?php if (empty($cars)): ?>
                <p>Geen auto's gevonden die voldoen aan uw zoekopdracht.</p>
            <?php else: ?>
                <?php foreach ($cars as $car): ?>
                    <div class="car-card">
                        <img src="/rydr/websiteautohuren/rental-main/public/get-image.php?id=<?php echo $car['id']; ?>" 
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
            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>

