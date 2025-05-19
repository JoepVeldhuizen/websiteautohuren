<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
        <a href="/rydr/websiteautohuren/rental-main/public/">
            Rydr.
        </a>
    </div>
    <form action="">
        <input type="search" name="" id="" placeholder="Welke auto wilt u huren?">
        <img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/search-normal.svg" alt="" class="search-icon">
    </form>
    <nav>
        <ul>
            <li><a href="/rydr/websiteautohuren/rental-main/public/">Home</a></li>
            <li><a href="/rydr/websiteautohuren/rental-main/public/car-list">Ons aanbod</a></li>
            <li><a href="/rydr/websiteautohuren/rental-main/public/help">Hulp nodig?</a></li>
        </ul>
    </nav>
    <div class="menu">
        <?php if(isset($_SESSION['id'])){ ?>
        <div class="account">
            <img src="/rydr/websiteautohuren/rental-main/public/assets/images/profil.png" alt="">
            <div class="account-dropdown">
                <ul>
                    <li><img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/setting.svg" alt=""><a href="/rydr/websiteautohuren/rental-main/public/account">Naar account</a></li>
                    <li><img src="/rydr/websiteautohuren/rental-main/public/assets/images/icons/logout.svg" alt=""><a href="/rydr/websiteautohuren/rental-main/public/logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
        <?php }else{ ?>
            <a href="/rydr/websiteautohuren/rental-main/public/register" class="button-primary">Start met huren</a>
        <?php } ?>
    </div>
</div>
<div class="content">
