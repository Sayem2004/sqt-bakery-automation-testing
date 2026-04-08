<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header("Location: ../../common/controller/login.php");
    exit;
}

require_once('../model/product_model.php');
require_once('../model/order_model.php');

$products = getAllProducts();
$my_orders = getOrdersByCustomer($_SESSION['user']['id']);
$all_orders = getAllOrdersByCustomer($_SESSION['user']['id']);

$page = isset($_GET['page']) ? $_GET['page'] : 'order';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="dashboard">
    
    <div class="sidebar">
        <h2>Customer Panel</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
        
        <a href="?page=order" class="<?php if($page == 'order') echo 'active'; ?>">Place Order</a>
        <a href="?page=orders" class="<?php if($page == 'orders') echo 'active'; ?>">My Orders</a>
        <a href="?page=invoices" class="<?php if($page == 'invoices') echo 'active'; ?>">Invoices</a>
        <a href="../../common/controller/logout.php">Logout</a>
    </div>
    
    <div class="content">
        
        <?php if (isset($_SESSION['success'])): ?>
            <p class="msg-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="msg-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        
        
        <?php if ($page == 'order'): ?>
        
            <h2>Place Order</h2>
            
            <div class="card">
                <form action="../controller/order_controller.php" method="POST">
                    
                    <label>Select Product</label>
                    <select name="product_id" required>
                        <option value="">-- Choose a product --</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['id']; ?>">
                                <?php echo $product['product_name']; ?> 
                                - <?php echo number_format($product['price'], 2); ?> 
                                (Stock: <?php echo $product['quantity']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1" placeholder="Enter quantity" required>
                    
                    <button type="submit" name="place_order">Place Order</button>
                </form>
            </div>
        
        
        <?php elseif ($page == 'orders'): ?>
        
            <h2>My Orders</h2>
            
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
                
                <?php if (count($my_orders) > 0): ?>
                    <?php foreach ($my_orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['items']; ?></td>
                        <td><?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td>
                            <span class="status-<?php echo $order['status']; ?>">
                                <?php echo ucfirst($order['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($order['payment_status'] == 'paid'): ?>
                                <span class="status-paid">Paid</span>
                            <?php else: ?>
                                <a href="../controller/order_controller.php?action=pay&id=<?php echo $order['id']; ?>" 
                                   class="btn-pay" 
                                   onclick="return confirm('Pay for this order?')">Pay Now</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($order['status'] == 'pending'): ?>
                                <a href="../controller/order_controller.php?action=cancel&id=<?php echo $order['id']; ?>" 
                                   class="btn-cancel"
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
        
        
        <?php elseif ($page == 'invoices'): ?>
        
            <h2>My Invoices</h2>
            <p class="subtitle">Complete history of all your orders</p>
            
            <table>
                <tr>
                    <th>Invoice #</th>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment</th>
                </tr>
                
                <?php if (count($all_orders) > 0): ?>
                    <?php $invoice_num = 1; ?>
                    <?php foreach ($all_orders as $order): ?>
                    <tr>
                        <td>INV-<?php echo str_pad($invoice_num, 4, '0', STR_PAD_LEFT); $invoice_num++; ?></td>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['items']; ?></td>
                        <td><?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td>
                            <span class="status-<?php echo $order['status']; ?>">
                                <?php echo ucfirst($order['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($order['payment_status'] == 'paid'): ?>
                                <span class="status-paid">Paid</span>
                            <?php elseif ($order['status'] == 'cancelled'): ?>
                                <span class="status-cancelled">Cancelled</span>
                            <?php else: ?>
                                <a href="../controller/order_controller.php?action=pay&id=<?php echo $order['id']; ?>" 
                                   class="btn-pay"
                                   onclick="return confirm('Pay for this order?')">Pay Now</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No invoices found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        
        <?php endif; ?>
        
    </div>
</div>

</body>
</html>
