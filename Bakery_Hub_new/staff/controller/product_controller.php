<?php


session_start();


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header("Location: ../../common/view/login.php");
    exit;
}


require_once('../model/product_model.php');


$staff_id = $_SESSION['user']['id'];


if (isset($_POST['add_product'])) {
    
   
    $product_name = trim($_POST['product_name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $mfg = $_POST['mfg'];
    $exp = $_POST['exp'];
    
   
    if (!empty($product_name) && $price >= 0 && $quantity >= 0 && !empty($mfg) && !empty($exp)) {
        
       
        $success = addProduct($product_name, $price, $quantity, $mfg, $exp, $staff_id);
        
        if ($success) {
            $_SESSION['success'] = "Product added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add product.";
        }
        
    } else {
        $_SESSION['error'] = "Please fill all fields.";
    }
    
    header("Location: ../view/staff_dashboard.php");
    exit;
}



if (isset($_POST['update_product'])) {
    
    
    $product_id = $_POST['product_id'];
    $product_name = trim($_POST['product_name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $mfg = $_POST['mfg'];
    $exp = $_POST['exp'];
    
    
    if (!empty($product_id) && !empty($product_name) && $price >= 0 && $quantity >= 0 && !empty($mfg) && !empty($exp)) {
        
        
        $success = updateProduct($product_id, $product_name, $price, $quantity, $mfg, $exp, $staff_id);
        
        if ($success) {
            $_SESSION['success'] = "Product updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update product.";
        }
        
    } else {
        $_SESSION['error'] = "Please fill all fields.";
    }
    
    header("Location: ../view/staff_dashboard.php");
    exit;
}



if (isset($_GET['delete'])) {
    
    $product_id = $_GET['delete'];
    
    if (!empty($product_id)) {
        
        $success = deleteProduct($product_id);
        
        if ($success) {
            $_SESSION['success'] = "Product deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete product.";
        }
        
    } else {
        $_SESSION['error'] = "Invalid product ID.";
    }
    
    header("Location: ../view/staff_dashboard.php");
    exit;
}


header("Location: ../view/staff_dashboard.php");
exit;
