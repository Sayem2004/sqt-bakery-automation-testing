<?php


session_start();


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header("Location: ../../common/view/login.php");
    exit;
}


require_once('../model/order_model.php');



if (isset($_GET['action']) && $_GET['action'] == 'confirm' && isset($_GET['id'])) {
    
    $order_id = $_GET['id'];
    
    $success = confirmOrder($order_id);
    
    if ($success) {
        $_SESSION['success'] = "Order confirmed!";
    } else {
        $_SESSION['error'] = "Failed to confirm order.";
    }
    
    header("Location: ../view/staff_orders.php");
    exit;
}



if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id'])) {
    
    $order_id = $_GET['id'];
    
    $success = cancelOrder($order_id);
    
    if ($success) {
        $_SESSION['success'] = "Order cancelled!";
    } else {
        $_SESSION['error'] = "Failed to cancel order.";
    }
    
    header("Location: ../view/staff_orders.php");
    exit;
}


header("Location: ../view/staff_orders.php");
exit;
