<?php 
session_start();

$table_name = $_SESSION['tables'];


$valid_table_names = ['users']; 
if (!in_array($table_name, $valid_table_names)) {
    die('Invalid table name.');
}

$role = $_POST['role'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$passwordU = $_POST['password']; // added a U to my php variable because it was getting overided from my connection2data.php "$password"
$created_at = $_POST['created_at'];
$branch_id = $_POST['branch_id'];

include('dbs/connection2data.php');

try {
    // Using a prepared statement to insert the data
   $sql = "INSERT INTO $table_name (`role`, `first_name`, `last_name`, `email`, `password`, `created_at`, `branch_id`) 
        VALUES (:role, :first_name, :last_name, :email, :password, :created_at, :branch_id)";

    $stmt = $connection->prepare($sql);
    
    // Bind the parameters
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $passwordU);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':branch_id', $branch_id);
    

    $stmt->execute();

    echo "User added successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header('location: ./setting.php');
?>