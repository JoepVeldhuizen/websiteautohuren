<?php
require_once __DIR__ . '/../database/connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Zoekterm ophalen uit de URL (GET)
$searchValue = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rydr</title>
    <link rel="stylesheet" href="/rydr/websiteautohuren/rental-main/public/assets/css/main.css">
    <link rel="icon" type="image/png" href="/rydr/websiteautohuren/rental-main/public/assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <script src="/rydr/websiteautohuren/rental-main/public/js/main.js" defer></script>
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/rydr/websiteautohuren/rental-main/public/" class="logo-link">
            Rydr.
        </a>
    </div>
    <div class="nav-container">
        <form action="/rydr/websiteautohuren/rental-main/public/ons-aanbod" method="get" role="search" class="search-form">
            <input type="search" name="search" id="search" placeholder="Welke auto wilt u huren?" aria-label="Zoek een auto" value="<?php echo $searchValue; ?>">
            <img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/search-normal.svg" alt="Zoeken" class="search-icon">
        </form>
        <nav aria-label="Hoofdnavigatie" class="main-nav">
            <ul>
                <li><a href="/rydr/websiteautohuren/rental-main/public/" class="nav-link">Home</a></li>
                <li><a href="/rydr/websiteautohuren/rental-main/public/ons-aanbod" class="nav-link">Ons aanbod</a></li>
                <li><a href="/rydr/websiteautohuren/rental-main/public/help" class="nav-link">Hulp nodig?</a></li>
                <li><a href="/rydr/websiteautohuren/rental-main/public/over-ons" class="nav-link">Over ons</a></li>
            </ul>
        </nav>
        <!-- Mobile Category Filter -->
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);
        $isOnsAanbod = $currentPage === 'ons-aanbod.php' || strpos($_SERVER['REQUEST_URI'], 'ons-aanbod') !== false;
        if ($isOnsAanbod) {
            require_once __DIR__ . '/../includes/get_cars.php';
            $categories = getAllCategories();
            $selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : null;
        ?>
        <div class="category-filter mobile-only">
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
        <?php } ?>
        <div class="menu">
            <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])): ?>
                <?php
                $check_role = $conn->prepare("SELECT role FROM account WHERE id = :id");
                $check_role->bindParam(":id", $_SESSION['id']);
                $check_role->execute();
                $user_role = $check_role->fetch(PDO::FETCH_ASSOC);
                ?>
                <?php if($user_role && $user_role['role'] == 1): ?>
                    <a href="/rydr/websiteautohuren/rental-main/public/admin" class="button-secondary">Admin Panel</a>
                <?php endif; ?>
                <div class="account">
                    <img src="/rydr/websiteautohuren/rental-main/public/assets/images/Profil.webp" alt="Profiel" aria-label="Account menu">
                    <div class="account-dropdown">
                        <ul>
                            <li><img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/setting.svg" alt=""><a href="/rydr/websiteautohuren/rental-main/public/account" class="dropdown-link">Naar account</a></li>
                            <li><img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/logout.svg" alt=""><a href="/rydr/websiteautohuren/rental-main/public/logout" class="dropdown-link">Uitloggen</a></li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                    <a href="/rydr/websiteautohuren/rental-main/public/login-form" class="button-secondary">Inloggen</a>
                    <a href="/rydr/websiteautohuren/rental-main/public/register" class="button-primary">Registeren</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <button class="hamburger-menu" aria-label="Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>
</div>
<div class="content">
