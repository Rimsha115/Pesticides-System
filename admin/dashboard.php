<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../customers/login.php");
    exit;
}

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../dashboard/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Welcome to Pesticides Dashboard</h1>

    <h3>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h3>

    <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    <p>Role: <?php echo htmlspecialchars($_SESSION['user_role']); ?></p>

    <a href="../customers/logout.php">Logout</a>

</body>
</html>