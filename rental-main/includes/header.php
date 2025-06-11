<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/rydr/websiteautohuren/rental-main/public/" class="logo-link">
            Rydr.
        </a>
    </div>
    <form action="" role="search">
        <input type="search" name="search" id="search" placeholder="Welke auto wilt u huren?" aria-label="Zoek een auto">
        <img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/search-normal.svg" alt="Zoeken" class="search-icon">
    </form>
    <nav aria-label="Hoofdnavigatie">
        <ul>
            <li><a href="/rydr/websiteautohuren/rental-main/public/" class="nav-link">Home</a></li>
            <li><a href="/rydr/websiteautohuren/rental-main/public/ons-aanbod" class="nav-link">Ons aanbod</a></li>
            <li><a href="/rydr/websiteautohuren/rental-main/public/help" class="nav-link">Hulp nodig?</a></li>
            <li><a href="/rydr/websiteautohuren/rental-main/public/over-ons" class="nav-link">Over ons</a></li>
        </ul>
    </nav>
    <div class="menu">
        <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])): ?>
            <div class="account">
                <img src="/rydr/websiteautohuren/rental-main/public/assets/images/profil.png" alt="Profiel" aria-label="Account menu">
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
                <a href="/rydr/websiteautohuren/rental-main/public/register" class="button-primary">Start met huren</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="content">
