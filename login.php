<?php
header('Content-Type: application/json');
include 'db.php';

if (!isset($_POST['username'], $_POST['password'], $_POST['role'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing fields']);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$table = $role === "admin" ? "admins" : "users";
$sql = "SELECT * FROM $table WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo json_encode([
            'status' => 'success',
            'name' => $row['name'],
            'role' => $role
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}
?>
