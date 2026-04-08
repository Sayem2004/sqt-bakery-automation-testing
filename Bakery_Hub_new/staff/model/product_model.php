<?php

require_once('db_connect.php');


function getAllProducts() {
    global $conn;
    
    $sql = "SELECT p.*, u.name as updated_by_name 
            FROM products p 
            LEFT JOIN users u ON p.updated_by = u.id 
            ORDER BY p.product_name";
    $result = $conn->query($sql);
    
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    return $products;
}



function getProductById($id) {
    global $conn;
    
    $id = intval($id);
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }
    
    return null;
}


function addProduct($product_name, $price, $quantity, $mfg, $exp, $staff_id) {
    global $conn;
    
    
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $price = floatval($price);
    $quantity = intval($quantity);
    $mfg = mysqli_real_escape_string($conn, $mfg);
    $exp = mysqli_real_escape_string($conn, $exp);
    $staff_id = intval($staff_id);
    
    
    $sql = "INSERT INTO products (product_name, price, quantity, mfg, exp, updated_by) 
            VALUES ('$product_name', $price, $quantity, '$mfg', '$exp', $staff_id)";
    
    return $conn->query($sql);
}



function updateProduct($id, $product_name, $price, $quantity, $mfg, $exp, $staff_id) {
    global $conn;
    
    
    $id = intval($id);
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $price = floatval($price);
    $quantity = intval($quantity);
    $mfg = mysqli_real_escape_string($conn, $mfg);
    $exp = mysqli_real_escape_string($conn, $exp);
    $staff_id = intval($staff_id);
    
   
    $sql = "UPDATE products SET 
            product_name = '$product_name', 
            price = $price, 
            quantity = $quantity, 
            mfg = '$mfg', 
            exp = '$exp', 
            updated_by = $staff_id 
            WHERE id = $id";
    
    return $conn->query($sql);
}



function deleteProduct($id) {
    global $conn;
    
    $id = intval($id);
    $sql = "DELETE FROM products WHERE id = $id";
    
    return $conn->query($sql);
}
