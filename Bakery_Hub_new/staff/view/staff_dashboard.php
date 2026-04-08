<?php


session_start();


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header("Location: ../../common/view/login.php");
    exit;
}


require_once('../model/product_model.php');


$products = getAllProducts();


$editProduct = null;
if (isset($_GET['edit'])) {
    $editProduct = getProductById($_GET['edit']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard - Products</title>
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="dashboard">
    
    
    <div class="sidebar">
        <h2>Staff Panel</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
        
        <a href="staff_dashboard.php" class="active">Manage Products</a>
        <a href="staff_orders.php">View Orders</a>
        <a href="../../common/controller/logout.php">Logout</a>
    </div>
    
   
    <div class="content">
        
       
        <?php if (isset($_SESSION['success'])): ?>
            <p class="msg-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="msg-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        
        
        
        <div class="card">
            <h2><?php if ($editProduct) { echo 'Edit Product'; } else { echo 'Add New Product'; } ?></h2>
            
            <form action="../controller/product_controller.php" method="POST">
                
                <?php if ($editProduct): ?>
                    <input type="hidden" name="product_id" value="<?php echo $editProduct['id']; ?>">
                <?php endif; ?>
                
                <label>Product Name</label>
                <input type="text" name="product_name" placeholder="Enter product name" 
                       value="<?php if ($editProduct) echo $editProduct['product_name']; ?>" required>
                
                <label>Price</label>
                <input type="number" name="price" placeholder="0.00" step="0.01" min="0" 
                       value="<?php if ($editProduct) echo $editProduct['price']; ?>" required>
                
                <label>Quantity</label>
                <input type="number" name="quantity" placeholder="0" min="0" 
                       value="<?php if ($editProduct) echo $editProduct['quantity']; ?>" required>
                
                <label>Manufacturing Date</label>
                <input type="date" name="mfg" 
                       value="<?php if ($editProduct) echo $editProduct['mfg']; ?>" required>
                
                <label>Expiry Date</label>
                <input type="date" name="exp" 
                       value="<?php if ($editProduct) echo $editProduct['exp']; ?>" required>
                
                <?php if ($editProduct): ?>
                    <button type="submit" name="update_product">Update Product</button>
                    <a href="staff_dashboard.php" class="btn-cancel">Cancel</a>
                <?php else: ?>
                    <button type="submit" name="add_product">Add Product</button>
                <?php endif; ?>
            </form>
        </div>
        
        
        
        <h2>All Products</h2>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Mfg Date</th>
                <th>Exp Date</th>
                <th>Updated By</th>
                <th>Actions</th>
            </tr>
            
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['mfg']; ?></td>
                    <td><?php echo $product['exp']; ?></td>
                    <td><?php if ($product['updated_by_name']) { echo $product['updated_by_name']; } else { echo '-'; } ?></td>
                    <td>
                        <a href="staff_dashboard.php?edit=<?php echo $product['id']; ?>" class="btn-edit">Edit</a>
                        <a href="../controller/product_controller.php?delete=<?php echo $product['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No products found.</td>
                </tr>
            <?php endif; ?>
        </table>
        
    </div>
</div>

</body>
</html>
