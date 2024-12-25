<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeless Memories - Portfolio</title>
    <link rel="stylesheet" href="portfolio.css">
    <link rel="stylesheet" href="gallery.css">
    <link rel=stylesheet href="timeless.css">

    <style>
        .delete-button {
            background-color: #d9534f; /* Professional red color */
            color: #ffffff; /* White text */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px 15px; /* Comfortable padding */
            font-size: 14px; /* Readable font size */
            font-weight: bold; /* Bold text */
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
        }

        .delete-button:hover {
            background-color: #c9302c; /* Darker red on hover */
            transform: scale(1.05); /* Slight zoom effect */
        }

        .delete-button:active {
            background-color: #ac2925; /* Even darker red when active */
            transform: scale(1); /* Reset zoom effect */
        }

        .search-bar-container {
            text-align: center;
            margin: 20px 0;
        }

        .search-bar {
            padding: 10px;
            width: 70%;
            max-width: 600px;
            border: 2px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
            margin-right: 10px;
        }

        .search-bar:focus {
            border-color: #007bff; /* Highlight color on focus */
        }

        .search-button {
            padding: 10px 15px;
            background-color: #007bff; /* Blue button */
            color: #ffffff;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        .portfolio-item {
            margin: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .portfolio-item img {
            max-width: 100%;
            border-radius: 5px;
        }


        .portfolio-item:hover h3 {
    
    background: linear-gradient(90deg, hsl(111, 87%, 47%), #aa2de0);
}
 



    </style>

</head>
<body>
    <header>
        <h1>Portfolio</h1>
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

    <!-- Search Bar -->
    <div class="search-bar-container">
        <form method="GET" action="" style="display: flex; justify-content: center; align-items: center;">
            <input type="text" name="search" class="search-bar" placeholder="Search portfolio items..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="search-button">Go</button>
        </form>
    </div>

    <main>
        <div class="portfolio-gallery">
        <?php
        include('dbconnection.php');

        // Handle deletion if delete action is triggered
        if (isset($_GET['delete_id'])) {
            $delete_id = intval($_GET['delete_id']);
            $delete_query = "DELETE FROM images WHERE id = $delete_id";
            if (mysqli_query($con, $delete_query)) {
                echo "<p>Item deleted successfully!</p>";
            } else {
                echo "<p>Error deleting item: " . mysqli_error($con) . "</p>";
            }
        }

        // Search functionality
        $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

        // Fetch and display items based on search query
        $query = "SELECT * FROM images";
        if ($search) {
            $query .= " WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        }

        $res = mysqli_query($con, $query);
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
               <div class="portfolio-item">
                    <img src="img/<?php echo htmlspecialchars($row['file']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <form method="GET" action="" class="delete-form">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this item?')">
                            Delete
                        </button>
                    </form>
                </div>
        <?php 
            }
        } else {
            echo "<p>No portfolio items found.</p>";
        }
        ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Timeless Memories. All rights reserved.</p>
    </footer>
</body>
<script src="/portfolio.js"></script>
</html>
