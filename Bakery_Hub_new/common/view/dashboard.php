<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Your Role: <?php echo $_SESSION['user_role']; ?></p> <br>
    <a href="../controller/logout.php">Logout</a>
</body>
</html>