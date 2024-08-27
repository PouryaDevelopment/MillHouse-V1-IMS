<?php 
session_start();

$table_name = $_SESSION['tables'];

$valid_table_names = ['product']; 
if (!in_array($table_name, $valid_table_names)) {
    die('Invalid table name.');
}

$name = $_POST['name'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];

include('dbs/connection2data.php');

try {

   $sql = "INSERT INTO $table_name (`name`, `price`, `category_id`) 
        VALUES (:name, :price, :category_id)";

    $stmt = $connection->prepare($sql);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category_id', $category_id);


    $stmt->execute();

    echo "Product added successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header('location: ./inventory.php');
?>