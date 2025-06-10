<?php
session_start();
require_once "../database/connection.php";

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "U moet ingelogd zijn om een auto te huren";
    header('Location: ./login-form');
    exit;
}

// Validate input
if (!isset($_POST['car_id']) || !isset($_POST['start_date']) || !isset($_POST['end_date']) || 
    !isset($_POST['pickup_location']) || !isset($_POST['dropoff_location'])) {
    $_SESSION['error'] = "Alle velden moeten worden ingevuld";
    header('Location: ./rent');
    exit;
}

$carId = (int)$_POST['car_id'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];
$pickupLocation = $_POST['pickup_location'];
$dropoffLocation = $_POST['dropoff_location'];
$userId = $_SESSION['id'];

// Validate dates
$startDateTime = new DateTime($startDate);
$endDateTime = new DateTime($endDate);
$now = new DateTime();

if ($startDateTime < $now) {
    $_SESSION['error'] = "De startdatum moet in de toekomst liggen";
    header('Location: ./rent?id=' . $carId);
    exit;
}

if ($endDateTime <= $startDateTime) {
    $_SESSION['error'] = "De einddatum moet na de startdatum liggen";
    header('Location: ./rent?id=' . $carId);
    exit;
}

try {
    // Check if car is still available
    $checkCar = $conn->prepare("SELECT available FROM cars WHERE id = :car_id");
    $checkCar->bindParam(':car_id', $carId);
    $checkCar->execute();
    $car = $checkCar->fetch(PDO::FETCH_ASSOC);

    if (!$car || !$car['available']) {
        $_SESSION['error'] = "Deze auto is niet meer beschikbaar";
        header('Location: ./ons-aanbod');
        exit;
    }

    // Check for overlapping rentals
    $checkOverlap = $conn->prepare("SELECT COUNT(*) FROM rentals 
                                   WHERE car_id = :car_id 
                                   AND ((start_date <= :end_date AND end_date >= :start_date))");
    $checkOverlap->bindParam(':car_id', $carId);
    $checkOverlap->bindParam(':start_date', $startDate);
    $checkOverlap->bindParam(':end_date', $endDate);
    $checkOverlap->execute();
    
    if ($checkOverlap->fetchColumn() > 0) {
        $_SESSION['error'] = "Deze auto is niet beschikbaar in de geselecteerde periode";
        header('Location: ./rent?id=' . $carId);
        exit;
    }

    // Create rental record
    $createRental = $conn->prepare("INSERT INTO rentals (user_id, car_id, start_date, end_date, 
                                  pickup_location, dropoff_location, status) 
                                  VALUES (:user_id, :car_id, :start_date, :end_date, 
                                  :pickup_location, :dropoff_location, 'pending')");
    
    $createRental->bindParam(':user_id', $userId);
    $createRental->bindParam(':car_id', $carId);
    $createRental->bindParam(':start_date', $startDate);
    $createRental->bindParam(':end_date', $endDate);
    $createRental->bindParam(':pickup_location', $pickupLocation);
    $createRental->bindParam(':dropoff_location', $dropoffLocation);
    $createRental->execute();

    $_SESSION['success'] = "Uw reservering is succesvol aangemaakt!";
    header('Location: ./account');
    exit;

} catch(PDOException $e) {
    error_log("Error creating rental: " . $e->getMessage());
    $_SESSION['error'] = "Er is een fout opgetreden bij het maken van uw reservering";
    header('Location: ./rent?id=' . $carId);
    exit;
} 