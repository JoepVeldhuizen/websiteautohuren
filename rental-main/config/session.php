<?php
// Sessie configuratie
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.gc_maxlifetime', 3600); // 1 uur
ini_set('session.cookie_lifetime', 3600); // 1 uur

// Start de sessie als deze nog niet is gestart
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Debug logging
error_log("Session started/continued - Session ID: " . session_id());
error_log("Session data: " . print_r($_SESSION, true)); 