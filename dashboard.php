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

// Fetch all products
$product_sql = "SELECT * FROM products";
$product_result = mysqli_query($conn, $product_sql);
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Assuming you store the user's ID in the session

    // Check if the product is already in the cart
    $cart_check_sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $cart_check_result = mysqli_query($conn, $cart_check_sql);

    if (mysqli_num_rows($cart_check_result) > 0) {
        // Update the quantity if the product already exists in the cart
        $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        mysqli_query($conn, $update_sql);
    } else {
        // Insert the product into the cart
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
        mysqli_query($conn, $insert_sql);
    }
    echo "Product added to cart!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Link to Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class=" main-content  mt-4">
        <h1 class="mb-4">Welcome to the Dashboard</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-sm-6 col-lg-3 col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="card-text"><strong>Price:</strong> $<?php echo $product['price']; ?></p>
                        <p class="card-text"><strong>Stock:</strong> <?php echo $product['stock_quantity']; ?></p>
                        <form method="POST" action="dashboard.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
