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

// Fetch the transaction ID from the URL
$transaction_id = $_GET['transaction_id'] ?? 0;
$user_id = $_SESSION['user_id']; // Ensure the logged-in user can only see their transactions

// Fetch transaction details
$transaction_sql = "SELECT * FROM transactions WHERE transaction_id = $transaction_id AND user_id = $user_id";
$transaction_result = mysqli_query($conn, $transaction_sql);
$transaction = mysqli_fetch_assoc($transaction_result);

// Fetch the transaction items
$details_sql = "SELECT td.*, p.name 
                FROM transaction_details td 
                JOIN products p ON td.product_id = p.product_id 
                WHERE td.transaction_id = $transaction_id";
$details_result = mysqli_query($conn, $details_sql);
$details = mysqli_fetch_all($details_result, MYSQLI_ASSOC);

if (!$transaction) {
    // Redirect if the transaction doesn't exist or doesn't belong to the user
    header("Location: transactions.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class=" main-content container mt-4">
        <h1>Transaction Details</h1>
        <h4>Transaction ID: <?php echo $transaction['transaction_id']; ?></h4>
        <p><strong>Total Amount:</strong> $<?php echo $transaction['total_amount']; ?></p>
        <p><strong>Payment Method:</strong> <?php echo $transaction['payment_method']; ?></p>
        <p><strong>Status:</strong> <?php echo ucfirst($transaction['status']); ?></p>
        <p><strong>Transaction Date:</strong> <?php echo $transaction['transaction_date']; ?></p>

        <h3>Products</h3>
        <?php if (count($details) > 0): ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo $item['unit_price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo $item['subtotal']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No details found for this transaction.</p>
        <?php endif; ?>

        <a href="transactions.php" class="btn btn-secondary mt-3">Back to Transactions</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
