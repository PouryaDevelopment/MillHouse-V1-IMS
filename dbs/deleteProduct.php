<?php
header('Content-Type: application/json');
include('connection2data.php'); 

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;

if ($product_id) {
    try {
        $stmt = $connection->prepare("DELETE FROM product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found or already deleted']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error deleting Product: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid Product ID']);
}
?>