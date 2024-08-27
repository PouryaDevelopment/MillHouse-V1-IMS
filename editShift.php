<?php 
header('Content-Type: application/json');


include('dbs/connection2data.php'); 

// Fetch POST data
$shift_id = filter_input(INPUT_POST, 'shift_id', FILTER_VALIDATE_INT);
$start_time = filter_input(INPUT_POST, 'start_time', FILTER_SANITIZE_STRING);
$end_time = filter_input(INPUT_POST, 'end_time', FILTER_SANITIZE_STRING);

// Check for valid input
if (!$shift_id || !$start_time || !$end_time) {
    echo json_encode(['success' => false, 'message' => 'Missing or invalid fields']);
    exit;
}

// Attempt to update the schedule
try {
    $stmt = $connection->prepare("UPDATE schedule SET start_time = ?, end_time = ? WHERE shift_id = ?");
    $stmt->execute([$start_time, $end_time, $shift_id]);

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