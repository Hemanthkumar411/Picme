<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and collect POST values
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $aadhar = $_POST['aadhar'];
  $address = $_POST['address'];
  $company_name = $_POST['company_name'];
  $company_details = $_POST['company_details'];
  $company_address = $_POST['company_address'];
  $company_email = $_POST['company_email'];

  // Use prepared statement to prevent SQL injection
  $sql = "INSERT INTO admins (
    name, username, password, email, mobile, aadhar, address,
    company_name, company_details, company_address, company_email
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param(
    "sssssssssss",
    $name, $username, $password, $email, $mobile,
    $aadhar, $address, $company_name,
    $company_details, $company_address, $company_email
  );

  if ($stmt->execute()) {
    echo "success";
  } else {
    echo "error: " . $stmt->error;
  }
}
?>
