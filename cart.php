<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include('db.php');

// Fetch the cart items for the logged-in user
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session
$cart_sql = "SELECT c.*, p.name, p.price 
             FROM cart c 
             JOIN products p ON c.product_id = p.product_id 
             WHERE c.user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_sql);
$cart_items = mysqli_fetch_all($cart_result, MYSQLI_ASSOC);

// Handle Quantity Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $action = $_POST['update_quantity']; // "increment" or "decrement"

    // Fetch the current quantity from the database
    $quantity_sql = "SELECT quantity FROM cart WHERE cart_id = $cart_id";
    $result = mysqli_query($conn, $quantity_sql);
    $cart_item = mysqli_fetch_assoc($result);
    $current_quantity = $cart_item['quantity'];

    if ($action == 'increment') {
        $new_quantity = $current_quantity + 1;
    } elseif ($action == 'decrement') {
        $new_quantity = $current_quantity - 1;
    }

    // Ensure quantity is not less than 1
    if ($new_quantity > 0) {
        $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE cart_id = $cart_id";
        mysqli_query($conn, $update_sql);
    } else {
        // Remove item if quantity becomes zero
        $delete_sql = "DELETE FROM cart WHERE cart_id = $cart_id";
        mysqli_query($conn, $delete_sql);
    }

    header("Location: cart.php");
    exit();
}


// Handle Pay Now
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay_now'])) {
    $total_amount = 0;

    // Calculate the total amount for the transaction
    foreach ($cart_items as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    // Insert transaction record
    $transaction_sql = "INSERT INTO transactions (user_id, total_amount, payment_method, status) 
                        VALUES ($user_id, $total_amount, 'Card', 'completed')";
    mysqli_query($conn, $transaction_sql);
    $transaction_id = mysqli_insert_id($conn); // Get the last inserted transaction ID

    // Insert transaction details and update stock
    foreach ($cart_items as $item) {
        // Insert into transaction_details table
        $transaction_detail_sql = "INSERT INTO transaction_details (transaction_id, product_id, quantity, unit_price) 
                                   VALUES ($transaction_id, {$item['product_id']}, {$item['quantity']}, {$item['price']})";
        mysqli_query($conn, $transaction_detail_sql);

        // Update stock quantity in products table
        $update_stock_sql = "UPDATE products 
                             SET stock_quantity = stock_quantity - {$item['quantity']} 
                             WHERE product_id = {$item['product_id']} AND stock_quantity >= {$item['quantity']}";
        mysqli_query($conn, $update_stock_sql);

        // Check if stock is insufficient
        if (mysqli_affected_rows($conn) === 0) {
            // Rollback the transaction or handle insufficient stock
            echo "<script>alert('Stock insufficient for product: {$item['name']}');</script>";
            header("Location: cart.php");
            exit();
        }

        // Log the stock movement
        $stock_movement_sql = "INSERT INTO stock_movements (product_id, quantity_changed, movement_type) 
                               VALUES ({$item['product_id']}, -{$item['quantity']}, 'sale')";
        mysqli_query($conn, $stock_movement_sql);
    }

    // Clear the cart
    $clear_cart_sql = "DELETE FROM cart WHERE user_id = $user_id";
    mysqli_query($conn, $clear_cart_sql);

    // Redirect to a success page or confirmation
    header("Location: success.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class=" main-content  mt-4">
        <h1>Your Cart</h1>
        <?php if (count($cart_items) > 0): ?>
            <div class="row">
                <?php $total_bill = 0; ?>
                <?php foreach ($cart_items as $item): ?>
                <?php $subtotal = $item['quantity'] * $item['price']; ?>
                <?php $total_bill += $subtotal; ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($item['name']); ?></h5>
                            <p class="card-text"><strong>Price:</strong> $<?php echo $item['price']; ?></p>
                            <p class="card-text"><strong>Subtotal:</strong> $<?php echo $subtotal; ?></p>
                            <form method="POST" action="cart.php" class="d-flex">
                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                <button type="submit" name="update_quantity" value="decrement" class="btn btn-danger me-2">-</button>
                                <input type="number"  name="quantity" value="<?php echo $item['quantity']; ?>" min="1" readonly class="form-control w-50">
                                <button type="submit" name="update_quantity" value="increment" class="btn btn-primary ms-2">+</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-end">
                <h4>Total Bill: $<?php echo $total_bill; ?></h4>
                <form method="POST" action="cart.php">
                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
