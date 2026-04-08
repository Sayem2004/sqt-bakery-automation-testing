<?php

session_start();


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'delivery') {
    header("Location: ../../common/view/login.php");
    exit;
}

require_once('../model/order_model.php');

$orders = getAllOrders();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Dashboard</title>
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="dashboard">
    
    <div class="sidebar">
        <h2>Delivery Panel</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
        
        <a href="delivery_dashboard.php" class="active">Orders to Deliver</a>
        <a href="../../common/controller/logout.php">Logout</a>
    </div>
    
   
    <div class="content">
        
        <?php if (isset($_SESSION['success'])): ?>
            <p class="msg-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="msg-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        
        
        <h2>Orders to Deliver</h2>
        
        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
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
                        <a href="../controller/delivery_controller.php?action=deliver&id=<?php echo $order['id']; ?>" 
                           class="btn-deliver"
                           onclick="return confirm('Mark this order as delivered?')">Mark Delivered</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No orders to deliver.</td>
                </tr>
            <?php endif; ?>
        </table>
        
    </div>
</div>

</body>
</html>
