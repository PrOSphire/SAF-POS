<?php
// Include the database connection
include('db.php');

// Fetch product details for the given product_id
$product_id = $_GET['product_id'];

if (!$product_id) {
    echo "Product ID is required!";
    exit;
}

$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found!";
    exit;
}

// Handle update functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];

    $update_sql = "UPDATE products 
                   SET name='$name', description='$description', price='$price', stock_quantity='$stock_quantity', category_id='$category_id' 
                   WHERE product_id=$product_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Product updated successfully!'); window.location.href = 'products.php';</script>";
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}

// Fetch categories for the dropdown
$category_sql = "SELECT * FROM categories";
$category_result = mysqli_query($conn, $category_sql);
$categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .main-content {
            align-items: center;
            flex-direction: column;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, textarea, select, button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #007bff;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .navbar {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="main-content  container">
    <h2>Edit Product</h2>
    <form method="POST" action="edit_product.php?product_id=<?php echo $product_id; ?>">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <textarea name="description"><?php echo $product['description']; ?></textarea>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>
        <input type="number" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['category_id']; ?>" <?php echo $product['category_id'] == $category['category_id'] ? 'selected' : ''; ?>>
                <?php echo $category['name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="update_product">Update Product</button>
    </form>
</div>
</body>
</html>
