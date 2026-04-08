<?php


session_start();


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header("Location: ../../common/view/login.php");
    exit;
}


require_once('../model/order_model.php');


$orders = getAllPendingOrders();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard - Orders</title>
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="dashboard">
    
    
    <div class="sidebar">
        <h2>Staff Panel</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
        
        <a href="staff_dashboard.php">Manage Products</a>
        <a href="staff_orders.php" class="active">View Orders</a>
        <a href="../../common/controller/logout.php">Logout</a>
    </div>
    
    
    <div class="content">
        
       
        <?php if (isset($_SESSION['success'])): ?>
            <p class="msg-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        
       
        <?php if (isset($_SESSION['error'])): ?>
            <p class="msg-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        
        
        
        <h2>Customer Orders</h2>
        
        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['customer_phone']; ?></td>
                    <td><?php echo number_format($order['total_amount'], 2); ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                    <td>
                        <span class="status-<?php echo $order['status']; ?>">
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($order['status'] == 'pending'): ?>
                            <a href="../controller/order_controller.php?action=confirm&id=<?php echo $order['id']; ?>" 
                               class="btn-edit"
                               onclick="return confirm('Accept this order?')">Accept</a>
                            <a href="../controller/order_controller.php?action=cancel&id=<?php echo $order['id']; ?>" 
                               class="btn-delete"
                               onclick="return confirm('Cancel this order?')">Cancel</a>
                        <?php elseif ($order['status'] == 'confirmed'): ?>
                            <span class="status-confirmed">Confirmed</span>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No orders found.</td>
                </tr>
            <?php endif; ?>
        </table>
        
    </div>
</div>

</body>
</html>
