<?php
header('Content-Type: application/json');
include('connection2data.php'); 



$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);


if ($product_id === null || $product_id === false) {
    echo json_encode(['success' => false, 'message' => 'Please scroll down and press the update button at the end of the table to continue re-editing already edited rows.']);
    exit;
}
if (!$name) {
    echo json_encode(['success' => false, 'message' => 'Product name is missing or invalid.']);
    exit;
}
if ($price === false) {
    echo json_encode(['success' => false, 'message' => 'Price is missing or invalid.']);
    exit;
}
if ($category_id === null || $category_id === false) {
    echo json_encode(['success' => false, 'message' => 'Category ID is missing or invalid.']);
    exit;
}

// Check if the product exists
$exists = $connection->prepare("SELECT 1 FROM product WHERE product_id = ?");
$exists->execute([$product_id]);

if ($exists->fetch()) {
    // Product exists, update it
    try {
        $stmt = $connection->prepare("UPDATE product SET name = ?, price = ?, category_id = ? WHERE product_id = ?");
        $stmt->execute([$name, $price, $category_id, $product_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes were made or product not found.']);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Product not found with the provided ID.']);
}
?>