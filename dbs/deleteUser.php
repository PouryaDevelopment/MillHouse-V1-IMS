<?php
header('Content-Type: application/json');
include('connection2data.php'); 

$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;

if ($user_id) {
    try {
        $stmt = $connection->prepare("DELETE FROM users WHERE ID = ?");
        $stmt->execute([$user_id]);
        
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