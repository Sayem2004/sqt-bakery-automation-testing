<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bakery Hub</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="form-container">
    <h2>Login</h2>

    
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>".$_GET['error']."</p>";
    }
    ?>

    <p id="error-message" style="color:red;"></p>

    <form action="../controller/login-validation.php" method="POST" id="loginForm">
    <label>Email:</label>
    <input type="email" name="email" id="email" placeholder="Email"><br>

    <label>Password:</label>
    <input type="password" name="password" id="password" placeholder="Password"><br>

    <button type="submit">Login</button>
</form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

<script src="../js/login-validation.js"></script>

</body>
</html>

</body>
</html>
