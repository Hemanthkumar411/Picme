<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'] ?? '';
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $email = $_POST['email'] ?? '';
  $mobile = $_POST['mobile'] ?? '';

  if (!$name || !$username || !$password || !$email || !$mobile) {
    echo "Please fill in all fields.";
    exit();
  }

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (name, username, password, email, mobile) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $name, $username, $hashedPassword, $email, $mobile);

  if ($stmt->execute()) {
    header("Location: index.html?signup=success");
    exit();
  } else {
    echo "Signup failed: " . $stmt->error;
  }
}
?>
`
