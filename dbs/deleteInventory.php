<?php
header('Content-Type: application/json');
include('connection2data.php'); 

$inventory_id = isset($_POST['inventory_id']) ? intval($_POST['inventory_id']) : null;

if ($inventory_id) {
    try {
        $stmt = $connection->prepare("DELETE FROM inventory WHERE inventory_id = ?");
        $stmt->execute([$inventory_id]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found or already deleted']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error deleting user: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
}
?>