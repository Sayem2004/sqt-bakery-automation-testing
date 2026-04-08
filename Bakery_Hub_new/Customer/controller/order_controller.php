<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header("Location: ../../common/view/login.php");
    exit;
}
require_once('../model/order_model.php');

$customer_id = $_SESSION['user']['id'];


if (isset($_POST['place_order'])) {
    
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    if (!empty($product_id) && $quantity > 0) {
        
        $success = placeOrder($customer_id, $product_id, $quantity);
        
        if ($success) {
            $_SESSION['success'] = "Order placed successfully!";
            header("Location: ../view/customer_dashboard.php?page=orders");
            exit;
        } else {
            $_SESSION['error'] = "Failed to place order. Product may be out of stock.";
            header("Location: ../view/customer_dashboard.php");
            exit;
        }
        
    } else {
        $_SESSION['error'] = "Please fill all fields.";
        header("Location: ../view/customer_dashboard.php");
        exit;
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['id'])) {
    
    $order_id = $_GET['id'];
    
    $success = cancelOrder($order_id, $customer_id);
    
    if ($success) {
        $_SESSION['success'] = "Order cancelled successfully!";
    } else {
        $_SESSION['error'] = "Failed to cancel order.";
    }
    
    header("Location: ../view/customer_dashboard.php?page=orders");
    exit;
}



if (isset($_GET['action']) && $_GET['action'] === 'pay' && isset($_GET['id'])) {
    
    $order_id = $_GET['id'];
    
    $success = payOrder($order_id, $customer_id);
    
    if ($success) {
        $_SESSION['success'] = "Payment successful!";
    } else {
        $_SESSION['error'] = "Payment failed. Please try again.";
    }
    
    header("Location: ../view/customer_dashboard.php?page=orders");
    exit;
}
