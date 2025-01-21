<?php
// Include the database connection
include('db.php');

// Handle Add Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO products (name, description, price, stock_quantity, category_id) 
            VALUES ('$name', '$description', '$price', '$stock_quantity', '$category_id')";
    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle Edit Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE products 
            SET name='$name', description='$description', price='$price', stock_quantity='$stock_quantity', category_id='$category_id' 
            WHERE product_id=$product_id";
    if (mysqli_query($conn, $sql)) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle Delete Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM products WHERE product_id=$product_id";
    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch Categories (for dropdown)
$category_sql = "SELECT * FROM categories";
$category_result = mysqli_query($conn, $category_sql);
$categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);

// Fetch Products
$product_sql = "SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.category_id";
$product_result = mysqli_query($conn, $product_sql);
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/products.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class=" main-content container">
        <h2>Manage Products</h2>

        <!-- Add Product Form -->
        <form method="POST" action="products.php">
            <h3>Add Product</h3>
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="number" name="price" placeholder="Price" step="0.01" required>
            <input type="number" name="stock_quantity" placeholder="Stock Quantity" required>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <!-- Products Table -->
        <h3>Existing Products</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['product_id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['stock_quantity']; ?></td>
                <td><?php echo $product['category_name']; ?></td>
                <td>
                    
                    <!-- Edit Button -->
                    <form method="GET" action="edit_product.php" style="display:inline-block;">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    
                    <!-- Delete Form -->
                    <form method="POST" action="products.php" style="display:inline-block;">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button type="submit" name="delete_product" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>


