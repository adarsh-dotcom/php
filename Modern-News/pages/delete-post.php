<?php
include 'config.php';

// Get the post ID and category ID
$post_id = intval($_GET['id']);
$cat_id  = intval($_GET['catid']);

//Get the image file name from the database
$image_sql = "SELECT post_img FROM post WHERE post_id = {$post_id}";
$image_result = mysqli_query($conn, $image_sql);

if ($image_result && mysqli_num_rows($image_result) > 0) {
    $row = mysqli_fetch_assoc($image_result);
    $image_path = "upload/" . $row['post_img'];

    //Delete the image
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

// Delete the post and update the category
$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id};";

// Execute the queries
if (mysqli_multi_query($conn, $sql)) {
    header('Location: post.php');
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
