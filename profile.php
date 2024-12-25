<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>logged in successfully...</h2>";
echo "<a href='logout.php'>Logout</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <a href="home.html">get me to Home..!</a>
    
        <br>
        <a href="logout.php">logout</a>
    

    </div>
    
</body>
</html>
