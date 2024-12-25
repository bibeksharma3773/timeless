<?php
include('dbconnection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_us (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($con, $sql)) {
        echo "Sent successful.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeless Memories - Contact</title>
    <link rel="stylesheet" href="contact.css">
    <link rel=stylesheet href="timeless.css">
</head>
<body>
    <header>
        <h1>Contact Us</h1>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="portfolio.php">Portfolio_Details</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="experience.html">Experience & Skills</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
                <li><a href="logout.php">Logout</a></li>
                

            </ul>
        </nav>
    </header>

    <main>
        <section>
            <form  method="post">
                <h2>Get in Touch</h2>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit" name="submit" >Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Timeless Memories. All rights reserved.</p>
    </footer>
   
</body>
</html>
