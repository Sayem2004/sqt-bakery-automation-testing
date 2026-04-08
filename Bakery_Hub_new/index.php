<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bakery Management System</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
<header>
    <h1>Bakery Management System</h1>
    <nav>
        <a href="index.php">About</a>
        <a href="./common/View/login.php">Login</a>
        <a href="./common/View/register.php">Register</a>
    </nav>
</header>

<div class="container">
    <h2>Welcome to Our Bakery!</h2>
    <p>This is the online bakery management system. Login to access your dashboard according to your role.</p>

    <h2>Our Bakery Items</h2>
    <div class="bakery-items">
        <div class="item">
            <img src="assets/images/birthday-cake.jpg" alt="Chocolate Cake">
            <h3>Chocolate Delight Cake</h3>
            <p>Rich chocolate cake with creamy ganache frosting.</p>
            <p class="price">$50.00</p>
        </div>
        <div class="item">
            <img src="./assets/images/sliced-bread-with-turkish-bagel-side-view-white-gray-surface.jpg" alt="Croissant">
            <h3>Butter Croissant</h3>
            <p>Flaky, buttery croissant baked fresh daily.</p>
            <p class="price">$20.50</p>
        </div>
        <div class="item">
            <img src="./assets/images/cupcakes.jpg" alt="Strawberry Cupcake">
            <h3>Strawberry Cupcake</h3>
            <p>Moist vanilla cupcake topped with strawberry buttercream.</p>
            <p class="price">$5.00</p>
        </div>
        <div class="item">
            <img src="./assets/images/set-various-bread-stone-surface.jpg" alt="Sourdough Bread">
            <h3>Artisan Sourdough Bread</h3>
            <p>Crusty sourdough loaf with a tangy flavor.</p>
            <p class="price">$40.00</p>
        </div>
    </div>
</div>
</body>
</html>