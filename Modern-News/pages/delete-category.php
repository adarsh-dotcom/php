<?php
include "config.php";

session_start();
if ($_SESSION['user_role'] == '0') {
    header("Location: post.php");
    exit;
}

// Validate category ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cat_id = intval($_GET['id']);

    // Check if there are posts under this category
    $check_sql = "SELECT * FROM post WHERE category = {$cat_id}";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Category cannot be deleted because it contains posts.'); window.location.href='category.php';</script>";
        exit;
    }

    // Delete the category
    $delete_sql = "DELETE FROM category WHERE category_id = {$cat_id}";
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: category.php");
        exit;
    } else {
        echo "<script>alert('Failed to delete category.'); window.location.href='category.php';</script>";
    }

} else {
    
    header("Location: category.php");
    exit;
}
?>
