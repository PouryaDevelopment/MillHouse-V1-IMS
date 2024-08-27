<?php 
header('Content-Type: application/json');


include('dbs/connection2data.php'); 

$inventory_id = filter_input(INPUT_POST, 'inventory_id', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_STRING);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

// Check for valid input
if ($inventory_id === null || $inventory_id === false || $product_id === null || $quantity === null || $quantity === false) {
    echo json_encode(['success' => false, 'message' => 'Missing or invalid fields']);
    exit;
}

// Attempt to update the schedule
try {
    $stmt = $connection->prepare("UPDATE inventory SET product_id = ?, quantity = ? WHERE inventory_id = ?");
    $stmt->execute([$product_id, $quantity, $inventory_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No changes were made']);
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Update failed', 'error' => $e->getMessage()]);
}
?>