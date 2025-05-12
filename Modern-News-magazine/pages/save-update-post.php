<?php
include 'config.php';

if (isset($_POST['update_btn'])) {
    // inputs
    $post_id = (int) $_POST['post_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $new_category = (int) $_POST['category'];
    $old_category = 0;

    // Get old category for comparison
    $old_cat_query = "SELECT category FROM post WHERE post_id = {$post_id}";
    $old_cat_result = mysqli_query($conn, $old_cat_query);
    if ($old_cat_result && mysqli_num_rows($old_cat_result) > 0) {
        $old_row = mysqli_fetch_assoc($old_cat_result);
        $old_category = (int) $old_row['category'];
    }

    // Image handling
    if (!empty($_FILES['new-image']['name'])) {
        $errors = array();

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");

        if (!in_array($file_ext, $allowed_extensions)) {
            $errors[] = "This extension file is not allowed. Please upload JPG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = "File size must be 2MB or lower.";
        }

        $new_image_name = time() . "-" . basename($file_name);

        if (empty($errors)) {
            move_uploaded_file($file_tmp, "upload/" . $new_image_name);

            // Delete old image
            if (!empty($_POST['old_image'])) {
                unlink("upload/" . $_POST['old_image']);
            }
        } else {
            print_r($errors);
            die();
        }
    } else {
       
        $new_image_name = $_POST['old_image'];
    }

    // Update query
    $sql = "UPDATE post SET 
                title = '{$title}', 
                description = '{$description}', 
                category = {$new_category}, 
                post_img = '{$new_image_name}'
            WHERE post_id = {$post_id};";

    // Update category post counts if changed
    if ($old_category != $new_category) {
        $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$old_category};";
        $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$new_category};";
    }

    if (mysqli_multi_query($conn, $sql)) {
        header("Location: post.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Query Failed: " . mysqli_error($conn) . "</div>";
    }
}
?>
