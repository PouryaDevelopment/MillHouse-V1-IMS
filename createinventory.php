<?php 
session_start();

$table_name = $_SESSION['tables2'];


$valid_table_names = ['inventory']; 
if (!in_array($table_name, $valid_table_names)) {
    die('Invalid table name.');
}

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

include('dbs/connection2data.php');

try {
    
   $sql = "INSERT INTO $table_name (`product_id`, `quantity`) 
        VALUES (:product_id, :quantity)";

    $stmt = $connection->prepare($sql);
    
    
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':quantity', $quantity);
     
    
    $stmt->execute();

    echo "User added successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header('location: ./inventory.php');
?>