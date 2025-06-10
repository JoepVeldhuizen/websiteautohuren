<?php
/**
 * Dit bestand is een héél belangrijk bestand van je applicatie.
 * Alle websitebezoeken komen eerst binnen via deze index.php.
 * Dit bestand gaat vervolgens kijken welke pagina de bezoeker opvraagt.
 *
 * Eenvoudige front-controller die URLs zonder .php ondersteunt,
 * acties (login/logout/register) afhandelt en bij ontbrekende pagina een 404 toont.
 */

// --- stap 1: Haal het pad op zonder eventuele query-string
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// --- stap 2: Bepaal het "base path" (map t.o.v. webroot)
// Set the base path explicitly for your XAMPP setup
$baseScript = '/rydr/websiteautohuren/rental-main/public';

// --- stap 3: Trim het base path van de URI en verwijder leidende/trailende slashes
$path = trim(substr($uri, strlen($baseScript)), '/');

// --- acties vóór pagina-routing
if ($path === 'logout') {
    require_once __DIR__ . '/../actions/logout.php';
    exit;
}

if ($path === 'login-handler') {
    require_once __DIR__ . '/../actions/login.php';
    exit;
}

if ($path === 'register-handler') {
    require_once __DIR__ . '/../actions/register.php';
    exit;
}

if ($path === 'rental-handler') {
    require_once __DIR__ . '/../actions/rental-handler.php';
    exit;
}

if ($path === 'profile-handler') {
    require_once __DIR__ . '/../actions/profile-handler.php';
    exit;
}

if ($path === 'password-handler') {
    require_once __DIR__ . '/../actions/password-handler.php';
    exit;
}

// --- stap 4: Bepaal welke pagina we willen tonen
$page = $path ?: 'home';
$file = __DIR__ . '/../pages/' . $page . '.php';

// --- stap 5: Include de pagina of toon een 404
if (file_exists($file)) {
    include $file;
} else {
    http_response_code(404);
    include __DIR__ . '/../pages/404.php';
}
