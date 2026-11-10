<?php

require_once "../config/database.php";
$name = "System Admin";
$email = "admin@example.com";
$phone = "03457576785";
$password = password_hash("0123456", PASSWORD_DEFAULT);
$role = "admin";

$query = "INSERT INTO users (name, email, phone, password, role)
VALUES ( ?, ?, ?, ?, ? )";

$stmt = mysqli_prepare($conn, $query);
 
mysqli_stmt_bind_param($stmt,"sssss", $name, $email, $phone, $password, $role);

if(mysqli_stmt_execute($stmt)){
      echo "Admin acount created successfully!";
}else{
    echo "Error:" . mysqli_error($conn);
}

mysqli_stmt_close($stmt);

?>
