<?php
header('Content-Type: application/json');
include('connection2data.php'); 

// Fetching and sanitize inputs posted here
$user_id = $_POST['user_id'] ?? null;
$role = $_POST['role'] ?? null;
$first_name = $_POST['first_name'] ?? null;
$last_name = $_POST['last_name'] ?? null;
$email = filter_var($_POST['email'] ?? null, FILTER_VALIDATE_EMAIL);
$branch_id = filter_var($_POST['branch_id'] ?? null, FILTER_VALIDATE_INT);

if ($user_id && $role && $first_name && $last_name && $email && $branch_id) {
    try {
        $stmt = $connection->prepare("UPDATE users SET role = ?, first_name = ?, last_name = ?, email = ?, branch_id = ? WHERE ID = ?");
$stmt->execute([$role, $first_name, $last_name, $email, $branch_id, $user_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes were made or user not found']);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error updating user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing or invalid fields']);
}
?>