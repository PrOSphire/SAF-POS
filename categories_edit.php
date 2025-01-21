<?php
// Include the database connection
include('db.php');

// Fetch the category details
$category_id = $_GET['category_id'];
$sql = "SELECT * FROM categories WHERE category_id = $category_id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);

// Handle Update Category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE categories SET name='$name', description='$description' WHERE category_id=$category_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: categories.php"); // Redirect back to categories page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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
        <h2>Edit Category</h2>

        <!-- Edit Category Form -->
        <form method="POST" action="categories_edit.php">
            <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $category['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required><?php echo $category['description']; ?></textarea>
            </div>
            <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
            <a href="categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
