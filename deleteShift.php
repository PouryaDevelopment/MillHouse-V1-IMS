<?php
header('Content-Type: application/json');
include('dbs/connection2data.php'); 

$shift_id = isset($_POST['shift_id']) ? intval($_POST['shift_id']) : null;

if ($shift_id) {
    try {
        $stmt = $connection->prepare("DELETE FROM schedule WHERE shift_id = ?");
        $stmt->execute([$shift_id]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Shift not found or already deleted']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error deleting shift: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid shift ID']);
}
?>