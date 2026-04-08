<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>

<div class="form-container">
    <h2>Customer Registration Form</h2>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>".$_GET['error']."</p>";
    }
    if (isset($_GET['success'])) {
        echo "<p style='color:green;'>".$_GET['success']."</p>";
    }
    ?>

    <p id="error-message" style="color:red;"></p>

<form action="../controller/register-validation.php" method="POST" id="registerForm">
        <label>Name</label><br>
        <input type="text" name="name" id="name" placeholder="Name"><br>

        <label>Phone</label><br>
        <input type="text" name="phone" id="phone" placeholder="Phone"><br>

        <label>Email</label><br>
        <input type="email" name="email" id="email" placeholder="Email"><br>

        <label>Password</label><br>
        <input type="password" name="password" id="password" placeholder="Password"><br>

        <label>Role</label><br>
        <select name="role" id="role">
            <option value="">Select Role</option>
            <option value="customer">Customer</option>
            <option value="staff">Staff</option>
            <option value="delivery">Delivery</option>
        </select>

        <p>Already have an account? <a href="./login.php">Sign In</a></p>

        <div class="flexx">
            <button type="submit">Submit</button>
        </div>

    </form>
</div>

<script src="../js/register-validation.js"></script>

</body>
</html>
