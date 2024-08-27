<?php 
include('connection2data.php'); 

try {
    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching users: " . $e->getMessage());
}
?>
