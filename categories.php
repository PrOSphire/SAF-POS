<?php
// Include the database connection
include('db.php');

// Handle Add Category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    if (mysqli_query($conn, $sql)) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}



// Handle Delete Category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];

    $sql = "DELETE FROM categories WHERE category_id=$category_id";
    if (mysqli_query($conn, $sql)) {
        echo "Category deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch Categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/categories.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Manage Categories</h2>

        <!-- Add Category Form -->
        <form method="POST" action="categories.php">
            <input type="text" name="name" placeholder="Category Name" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit" name="add_category">Add Category</button>
        </form>

        <!-- Categories Table -->
        <h3>Existing Categories</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category['category_id']; ?></td>
                <td><?php echo $category['name']; ?></td>
                <td><?php echo $category['description']; ?></td>
                <td>
                    <!-- Edit Form -->
                    <form method="GET" action="categories_edit.php" style="display:inline-block;">
                        <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    
                    <!-- Delete Form -->
                    <form method="POST" action="categories.php" style="display:inline-block;">
                        <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                        <button  type="submit" name="delete_category" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
