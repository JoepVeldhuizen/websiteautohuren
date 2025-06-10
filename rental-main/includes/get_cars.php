<?php
require_once __DIR__ . '/../database/connection.php';

function getAvailableCars($categoryId = null) {
    global $conn;
    
    try {
        $sql = "SELECT c.*, cat.name as category_name 
                FROM cars c 
                JOIN categories cat ON c.category_id = cat.id 
                WHERE c.available = 1";
        
        if ($categoryId) {
            $sql .= " AND c.category_id = :category_id";
        }
        
        $sql .= " ORDER BY c.brand, c.model";
        
        $stmt = $conn->prepare($sql);
        
        if ($categoryId) {
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error fetching cars: " . $e->getMessage());
        return [];
    }
}

function getCarById($id) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT c.*, cat.name as category_name 
                               FROM cars c 
                               JOIN categories cat ON c.category_id = cat.id 
                               WHERE c.id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error fetching car: " . $e->getMessage());
        return null;
    }
}

function getAllCategories() {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error fetching categories: " . $e->getMessage());
        return [];
    }
}

function searchCarsByBrand($searchTerm) {
    global $conn;
    
    try {
        $searchTerm = "%" . $searchTerm . "%";
        $stmt = $conn->prepare("SELECT c.*, cat.name as category_name 
                               FROM cars c 
                               JOIN categories cat ON c.category_id = cat.id 
                               WHERE c.available = 1 
                               AND (c.brand LIKE :search OR c.model LIKE :search)
                               ORDER BY c.brand, c.model");
        $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error searching cars: " . $e->getMessage());
        return [];
    }
} 