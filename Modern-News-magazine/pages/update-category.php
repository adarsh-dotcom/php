<?php 
include "header.php"; 
include "config.php";

//Only admin user_role == can access
if ($_SESSION['user_role'] == '0') {
    header('Location: post.php');
    exit;
}

// Handle Update
if (isset($_POST['submit'])) {
    $cat_id = intval($_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    if (!empty($cat_name)) {
        $update_sql = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$cat_id}";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: category.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to update category.</div>";
        }
    }
}

// Handle Delete
if (isset($_POST['delete'])) {
    $cat_id = intval($_POST['cat_id']);

    // Check for related posts before deletion
    $check_sql = "SELECT * FROM post WHERE category = {$cat_id}";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<div class='alert alert-warning'>Category contains posts. Please delete them first.</div>";
    } else {
        $delete_sql = "DELETE FROM category WHERE category_id = {$cat_id}";
        if (mysqli_query($conn, $delete_sql)) {
            header("Location: category.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to delete category.</div>";
        }
    }
}

// Fetch category for editing
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cat_id = intval($_GET['id']);
    $sql = "SELECT * FROM category WHERE category_id = {$cat_id}";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Category not found.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Invalid category ID.</div>";
    exit;
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="cat_id" value="<?php echo $row['category_id']; ?>">

                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo htmlspecialchars($row['category_name']); ?>" required>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                    <input type="submit" name="delete" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure you want to delete this category?');">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
