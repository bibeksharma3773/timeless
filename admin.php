<?php
include('dbconnection.php');



if(isset($_POST['submit'])) {


    $title = $_POST['title'];
    $description = $_POST['description'];

    // Check if file was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Get file details
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'img/'.$file_name;

        // Insert into the database (store the file name, not the full file path)
        $query = mysqli_query($con, "INSERT INTO images (title, description, file) VALUES ('$title', '$description', '$file_name')");

        // Move uploaded file to the desired folder
        if(move_uploaded_file($tempname, $folder)) {
            echo "<h2>File uploaded successfully!</h2>";
        } else {
            echo "<h2>Upload failed.</h2>";
        }
    } else {
        // Error message if no file is uploaded
        echo "<h2>No file uploaded or there was an error with the file upload.</h2>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeless Memories - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <link rel=stylesheet href="timeless.css">



    <style>
        .message-box {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin: 20px auto;
    max-width: 600px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    line-height: 1.6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.message-content {
    flex: 1;
    margin-right: 10px;
}

.message-box h4 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #0056b3;
    text-transform: capitalize;
}

.message-box p {
    font-size: 16px;
    color: #555;
    margin: 0;
}

.message-box:hover {
    border-color: #aaa;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    background-color: #ffffff;
}

.delete-form {
    display: flex;
    align-items: center;
}

.delete-button {
    background-color: #d9534f;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.delete-button:hover {
    background-color: #c9302c;
}

.delete-button:active {
    background-color: #ac2925;
}

    </style>



</head>
<body>
    <header>
        <h1>Admin Panel</h1>
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
            <h2>Add Portfolio Item</h2>
            <form method="POST" enctype="multipart/form-data" id="portfolioForm" >
                <div class="form-group">
                    <label for="itemTitle">Item Title</label>
                    <input type="text" id="itemTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="itemDescription">Item Description</label>
                    <textarea id="itemDescription" rows="4" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="itemImage">Image form device</label>
                    <input type="file" id="itemImage" name="image" required />
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" >Add Item</button>
                </div>
            </form>
       <div>
        <h2>Message from clients ... </h2>
        

        <?php
// Handle deletion if delete action is triggered
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM contact_us WHERE id = $delete_id";
    if (mysqli_query($con, $delete_query)) {
        echo "<p>Message deleted successfully!</p>";
    } else {
        echo "<p>Error deleting message: " . mysqli_error($con) . "</p>";
    }
}

$res = mysqli_query($con, "SELECT * FROM contact_us");
if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
?>
       <div class="message-box">
    <div class="message-content">
        <h4><?php echo htmlspecialchars($row['name']); ?></h4>
        <p><?php echo htmlspecialchars($row['message']); ?></p>
    </div>
    <form method="GET" action="" class="delete-form">
        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
        <button type="submit" onclick="return confirm('Are you sure you want to delete this message?')" class="delete-button">
            Delete
        </button>
    </form>
</div>


<?php 
    }
} else {
    echo "<p>No messages found.</p>";
}
?>



       </div>
    </main>

    <footer>
        <p>&copy; 2024 Timeless Memories. All rights reserved.</p>
    </footer>


  
</body>
</html>
