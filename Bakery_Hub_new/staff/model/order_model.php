<?php


require_once('db_connect.php');


function getAllPendingOrders() {
    global $conn;
    
    $sql = "SELECT o.*, u.name as customer_name, u.phone as customer_phone 
            FROM orders o 
            JOIN users u ON o.customer_id = u.id 
            WHERE o.status IN ('pending', 'confirmed') 
            ORDER BY o.created_at DESC";
    $result = $conn->query($sql);
    
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    
    return $orders;
}



function getOrderById($id) {
    global $conn;
    
    $id = intval($id);
    $sql = "SELECT o.*, u.name as customer_name, u.phone as customer_phone 
            FROM orders o 
            JOIN users u ON o.customer_id = u.id 
            WHERE o.id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }
    
    return null;
}



function getOrderItems($order_id) {
    global $conn;
    
    $order_id = intval($order_id);
    $sql = "SELECT oi.*, p.product_name 
            FROM order_items oi 
            JOIN products p ON oi.product_id = p.id 
            WHERE oi.order_id = $order_id";
    $result = $conn->query($sql);
    
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    
    return $items;
}



function updateOrderStatus($order_id, $status) {
    global $conn;
    
    $order_id = intval($order_id);
    $status = mysqli_real_escape_string($conn, $status);
    
    $sql = "UPDATE orders SET status = '$status' WHERE id = $order_id";
    
    return $conn->query($sql);
}


function confirmOrder($order_id) {
    return updateOrderStatus($order_id, 'confirmed');
}



function cancelOrder($order_id) {
    return updateOrderStatus($order_id, 'cancelled');
}
