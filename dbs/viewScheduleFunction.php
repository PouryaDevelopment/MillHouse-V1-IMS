<?php 
include('connection2data.php'); 

try {
    $stmt = $connection->prepare("SELECT * FROM schedule");
    $stmt->execute();
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching schedule: " . $e->getMessage());
}
?>
