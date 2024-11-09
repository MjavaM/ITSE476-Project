<?php 
include("include/db_conn.php");
include("header/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
<div class="search">
            <form method="POST" action="search.php">
                <input type="text" name="search" placeholder="Search by item name or category">
                <button type="submit">Search</button> <br><br>
                <?php
                $select_product=mysqli_query($conn,'SELECT * FROM cart') or die ('query failed');
                $row_count=mysqli_num_rows($select_product);
                ?>

            </form>
            </div>
   <?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the search term from the form
    $search = htmlspecialchars(stripslashes(trim($_POST['search'])));

    // Validate the search input to ensure it's a single letter
    if (strlen($search) === 1 && ctype_alpha($search)) {
        // Construct the SQL query to search for products starting with the given letter
        $search = strtolower($search); // Ensure the letter is lowercase for uniformity
        $sql = "SELECT * FROM product WHERE LOWER(product_name) LIKE '$search%'";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
            // Display the results
            echo "<h3>Search Results:</h3>";

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <div class="image">
                        <img src="<?php echo $row["product_image"]; ?>" alt="">
                    </div>
                    <div class="caption">
                        <p class="product_name"><?php echo $row["product_name"]; ?></p>
                        <p class="price"><?php echo $row["product_price"]; ?></p>
                    </div>
                <?php
            }
            echo "</div>";
        } else {
            echo "No results found.";
        }
    } else {
        echo "Please enter a valid single letter.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


</body>
</html>
