<?php
// signup.php - Sign-up form

include('db.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "Username or Email already exists.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        
        if (mysqli_query($conn, $sql)) {
            // echo "Sign-up successful!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Link to Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/signup.css"
</head>
<body>

    <div class="signup-container">
        <h2>Create Account</h2>
        <form method="POST" action="signup.php">
            <!-- <label for="username">Username:</label> -->
            <input type="text" placeholder="Username" id="username" name="username" required><br>

            <!-- <label for="password">Password:</label> -->
            <input type="password" placeholder="Password" id="password" name="password" required><br>

            <!-- <label for="email">Email:</label> -->
            <input type="email" placeholder="Email" id="email" name="email" required><br>

            <input type="submit" value="Sign Up">
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
