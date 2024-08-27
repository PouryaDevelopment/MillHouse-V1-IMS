<?php 
session_start();

$table_name = $_SESSION['tables2'];


$valid_table_names = ['schedule']; 
if (!in_array($table_name, $valid_table_names)) {
    die('Invalid table name.');
}

$user_id = $_POST['user_id'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];


include('dbs/connection2data.php');

try {
    // Use a prepared statement to insert the data
   $sql = "INSERT INTO $table_name (`user_id`, `start_time`, `end_time`) 
        VALUES (:user_id, :start_time, :end_time)";

    $stmt = $connection->prepare($sql);
    

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    

    $stmt->execute();

    echo "User added successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header('location: ./setting.php');
?>