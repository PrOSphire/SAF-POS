<!-- navbar.php -->
<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- Link to updated sidebar.css -->
<link rel="stylesheet" href="CSS/sidebar.css" />

<div class="sidebar">
    <div class="logo-container">
        <a href="dashboard.php">
            <img src="asset/safpos.svg" alt="Logo" class="logo-img">
        </a>
    </div>
    <ul>
        <li>
            <a href="dashboard.php" class="<?php if ($current_page == 'dashboard.php') echo 'active'; ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="products.php" class="<?php if ($current_page == 'products.php') echo 'active'; ?>">
                <i class="bi bi-box-seam"></i> Products
            </a>
        </li>
        <li>
            <a href="categories.php" class="<?php if ($current_page == 'categories.php') echo 'active'; ?>">
                <i class="bi bi-tags"></i> Categories
            </a>
        </li>
        <li>
            <a href="cart.php" class="<?php if ($current_page == 'cart.php') echo 'active'; ?>">
                <i class="bi bi-cart4"></i> Cart
            </a>
        </li>
        <li>
            <a href="transactions.php" class="<?php if ($current_page == 'transactions.php') echo 'active'; ?>">
                <i class="bi bi-receipt"></i> Transactions
            </a>
        </li>
        <li>
            <form method="POST" action="logout.php" class="logout-form">
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
