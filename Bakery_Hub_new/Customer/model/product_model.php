<?php

require_once('db_connect.php');


function getAllProducts() {
    global $conn;
    
    $sql = "SELECT * FROM products WHERE quantity > 0 ORDER BY product_name";
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
