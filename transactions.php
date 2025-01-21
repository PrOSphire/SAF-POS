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

// Fetch the transactions for the logged-in user
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session
$transactions_sql = "SELECT * FROM transactions WHERE user_id = $user_id ORDER BY transaction_date DESC";
$transactions_result = mysqli_query($conn, $transactions_sql);
$transactions = mysqli_fetch_all($transactions_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class=" main-content  mt-4">
        <h1>My Transactions</h1>
        <?php if (count($transactions) > 0): ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Transaction Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['transaction_id']; ?></td>
                        <td>$<?php echo $transaction['total_amount']; ?></td>
                        <td><?php echo $transaction['payment_method']; ?></td>
                        <td><?php echo ucfirst($transaction['status']); ?></td>
                        <td><?php echo $transaction['transaction_date']; ?></td>
                        <td>
                            <a href="transaction_details.php?transaction_id=<?php echo $transaction['transaction_id']; ?>" class="btn btn-primary">View Details</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
