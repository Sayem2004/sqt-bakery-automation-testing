<?php
require_once('db_connect.php');
require_once('product_model.php');

function getOrdersByCustomer($customer_id) {
    global $conn;
    
    $customer_id = intval($customer_id);
    
    $sql = "SELECT 
                o.id,
                o.total_amount,
                o.status,
                o.created_at,
                GROUP_CONCAT(CONCAT(p.product_name, ' x', oi.quantity) SEPARATOR ', ') as items,
                MAX(oi.payment_status) as payment_status
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.product_id = p.id
            WHERE o.customer_id = $customer_id 
            AND o.status IN ('pending', 'confirmed')
            GROUP BY o.id
            ORDER BY o.created_at DESC";
    
    $result = $conn->query($sql);
    
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    
    return $orders;
}

function getAllOrdersByCustomer($customer_id) {
    global $conn;
    
    $customer_id = intval($customer_id);
    
    $sql = "SELECT 
                o.id,
                o.total_amount,
                o.status,
                o.created_at,
                GROUP_CONCAT(CONCAT(p.product_name, ' x', oi.quantity) SEPARATOR ', ') as items,
                MAX(oi.payment_status) as payment_status
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.product_id = p.id
            WHERE o.customer_id = $customer_id
            GROUP BY o.id
            ORDER BY o.created_at DESC";
    
    $result = $conn->query($sql);
    
    $orders = array();
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    
    return $orders;
}



function placeOrder($customer_id, $product_id, $quantity) {
    global $conn;
    
    $customer_id = intval($customer_id);
    $product_id = intval($product_id);
    $quantity = intval($quantity);
    
    $product = getProductById($product_id);
    
    if (!$product) {
        return false;  
    }
    
    if ($product['quantity'] < $quantity) {
        return false;  
    }
    
    $price = $product['price'];
    $total_amount = $price * $quantity;
    
    $sql = "INSERT INTO orders (customer_id, total_amount, status) 
            VALUES ($customer_id, $total_amount, 'pending')";
    
    if ($conn->query($sql)) {
        $order_id = $conn->insert_id;
        
        $sql2 = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                 VALUES ($order_id, $product_id, $quantity, $price)";
        $conn->query($sql2);
        
        $sql3 = "UPDATE products SET quantity = quantity - $quantity WHERE id = $product_id";
        $conn->query($sql3);
        
        return true;  
    }
    
    return false;
}


function cancelOrder($order_id, $customer_id) {
    global $conn;
    
    $order_id = intval($order_id);
    $customer_id = intval($customer_id);
    
    
    $sql = "SELECT * FROM orders 
            WHERE id = $order_id 
            AND customer_id = $customer_id 
            AND status = 'pending'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) {
        return false;  
    }
    
    $sql2 = "SELECT * FROM order_items WHERE order_id = $order_id";
    $items = $conn->query($sql2);
    
    while ($item = $items->fetch_assoc()) {
        $restore_qty = $item['quantity'];
        $product_id = $item['product_id'];
        $conn->query("UPDATE products SET quantity = quantity + $restore_qty WHERE id = $product_id");
    }
    
    $sql3 = "UPDATE orders SET status = 'cancelled' WHERE id = $order_id";
    $conn->query($sql3);
    
    return true;
}


function payOrder($order_id, $customer_id) {
    global $conn;
    
    $order_id = intval($order_id);
    $customer_id = intval($customer_id);
    
    $sql = "SELECT * FROM orders 
            WHERE id = $order_id 
            AND customer_id = $customer_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) {
        return false; 
    }
    
    $sql2 = "UPDATE order_items 
             SET payment_status = 'paid', paid_at = NOW() 
             WHERE order_id = $order_id";
    $conn->query($sql2);
    
    return true;
}
