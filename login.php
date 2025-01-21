<?php
// login.php - Login form

include('db.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to get the user details from the database
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Login successful! Welcome " . $user['username'];
            // Start the session or redirect to a logged-in page
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id']; 

            header("Location: dashboard.php"); // Redirect to a dashboard or home page
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link to Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/login.css" />
    
</head>
<body>

    <div class="login-container">
        <h2>Welcome Back!</h2>
        <form method="POST" action="login.php">
            <!-- <label for="username">Username:</label> -->
            <input type="text" placeholder="Email or Username" id="username" name="username" required><br>

            <!-- <label for="password">Password:</label> -->
            <input type="password" placeholder="Password" id="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
        
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>

</body>
</html>
