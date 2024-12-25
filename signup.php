<?php
include('dbconnection.php');

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($con, $sql)) {
        // Show success message and include a redirect timer
        echo "
        <div style='text-align: center; margin-top: 20px;'>
            <h3>Signup successful!</h3>
            <p>You will be redirected to the login page in 3 seconds...</p>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000); // 3000 ms = 3 seconds
        </script>
        ";
    } else {
        echo "<div style='text-align: center; margin-top: 20px;'>
                <h3>Error:</h3> <p>" . mysqli_error($con) . "</p>
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="signup">Signup</button>
            </div>
        </form>
        <p>Already a member? <a href="login.php">login here</a></p>
    </div>
</body>
</html>
