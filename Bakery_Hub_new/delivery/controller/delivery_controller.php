<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'delivery') {
    header("Location: ../../common/view/login.php");
    exit;
}

require_once('../model/order_model.php');


if (isset($_GET['action']) && $_GET['action'] == 'deliver' && isset($_GET['id'])) {
    
    $order_id = $_GET['id'];
    
    $success = markOrderDelivered($order_id);
    
    if ($success) {
        $_SESSION['success'] = "Order marked as delivered!";
    } else {
        $_SESSION['error'] = "Failed to update order.";
    }
    
    header("Location: ../view/delivery_dashboard.php");
    exit;
}

header("Location: ../view/delivery_dashboard.php");
exit;
