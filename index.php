<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Existing Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAf Pos</title>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
  <!-- Header -->
<header class="custom-header">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="#">
            <img src="asset/safpos.svg" alt="Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center justify-content-center">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-4">Streamlining Your </br> Business for Success</h1>
        <h3 class="fw-normal mb-3">With Effective Online Point of Sale Software</h3>
        <p class="lead mb-4">Boost efficiency with smart automation, oversee sales or stock easily, and uncover new avenues to make money on the online point of sale platform trusted by thousands of retailers.</p>
        <a href="signup.php" class="btn btn-primary btn-lg">Register Now</a>
    </div>
</section>


<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Text Content -->
            <div class="col-md-6">
                <h2 class="mb-4">Why Choose Our POS System?</h2>
                <p class="mb-4">
                    Our Point of Sale (POS) software is designed to streamline your business operations, enhance customer experience, and drive sales growth. Discover the features that set us apart:
                </p>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2 fs-4"></i>
                        <div>
                            <h5 class="mb-1">User-Friendly Interface</h5>
                            <p class="mb-0">Intuitive design ensures easy navigation for your staff, reducing training time and errors.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3">
                        <i class="bi bi-check-circle-fill text-success me-2 fs-4"></i>
                        <div>
                            <h5 class="mb-1">Comprehensive Inventory Management</h5>
                            <p class="mb-0">Track stock levels in real-time, manage suppliers, and receive automated restock alerts.</p>
                        </div>
                    </li>
                   
                </ul>
                
            </div>
            <!-- Right Column: Image Content -->
            <div class="col-md-6 mt-4 mt-md-0">
                <img src="asset/img1.jpg" class="img-fluid rounded shadow" alt="POS Features">
            </div>
        </div>
    </div>
</section>



<!-- Redesigned Info Boxes Section -->
<!-- Redesigned Info Boxes Section -->
<section class="info-section py-5">
    <div class="container">
        <div class="row">
            <!-- Info Box 1: Left Box -->
            <div class="col-md-4 mb-4">
                <div class="info-box info-box-left text-center d-flex flex-column">
                    <div class="icon mb-3">
                        <i class="bi bi-gear-wide-connected fs-1 text-primary"></i>
                    </div>
                    <h5 class="info-title mb-3">Smart Automation</h5>
                    <p class="info-text mb-0">Automate your sales processes to save time and reduce errors.</p>
                </div>
            </div>
            <!-- Info Box 2: Center Box -->
            <div class="col-md-4 mb-4">
                <div class="info-box info-box-center text-center d-flex flex-column">
                    <div class="icon mb-3">
                        <i class="bi bi-bar-chart-line fs-1 text-white"></i>
                    </div>
                    <h5 class="info-title mb-3">Sales Oversight</h5>
                    <p class="info-text mb-0">Easily monitor and analyze your sales data in real-time.</p>
                </div>
            </div>
            <!-- Info Box 3: Right Box -->
            <div class="col-md-4 mb-4">
                <div class="info-box info-box-right text-center d-flex flex-column">
                    <div class="icon mb-3">
                        <i class="bi bi-cash-stack fs-1 text-primary"></i>
                    </div>
                    <h5 class="info-title mb-3">Revenue Growth</h5>
                    <p class="info-text mb-0">Discover new revenue streams and maximize your profits.</p>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- Contact Us Section -->
 <section class="contact-section py-5">
        <div class="container text-center">
            <h1 class="section-title mb-4">If you need it, please contact us</h1>
            <p class="section-subtitle mb-5">
                Safe and fast customer service through the channels you prefer
            </p>
            <div class="row">
                <!-- Contact Method 1 -->
                <div class="col-md-4 mb-4">
                    <div class="contact-box p-4 h-100 d-flex flex-column align-items-center justify-content-center">
                        <div class="icon mb-3">
                            <i class="bi bi-chat-dots-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="contact-title mb-3">Online Chat & Tutorials</h5>
                        <p class="contact-text mb-0">
                            Find complete tutorials about Nextar or contact us through the Online Chat from the
                            <a  class="contact-link">Help Center</a>.
                        </p>
                    </div>
                </div>
                <!-- Contact Method 2 -->
                <div class="col-md-4 mb-4">
                    <div class="contact-box p-4 h-100 d-flex flex-column align-items-center justify-content-center text-black">
                        <div class="icon mb-3">
                            <i class="bi bi-whatsapp fs-1 text-primary"></i>
                        </div>
                        <h5 class="contact-title mb-3">WhatsApp Support</h5>
                        <p class="contact-text mb-0">
                            Real-time support. Talk to customer service through the number:
                            <a class="contact-link text-primary">+92 302 5808353</a>.
                        </p>
                    </div>
                </div>
                <!-- Contact Method 3 -->
                <div class="col-md-4 mb-4">
                    <div class="contact-box p-4 h-100 d-flex flex-column align-items-center justify-content-center">
                        <div class="icon mb-3">
                            <i class="bi bi-envelope-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="contact-title mb-3">E-mail Support</h5>
                        <p class="contact-text mb-0">
                            Ask your questions at
                            <a  class="contact-link">info@safpos.com</a>
                            and get help quickly.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> SAF POS. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional: Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
