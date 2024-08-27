<?php 
include('connection2data.php');

try {
    $stmt = $connection->prepare("SELECT * FROM product");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching product: " . $e->getMessage());
}
?>
