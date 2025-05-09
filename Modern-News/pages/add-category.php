<?php
include "header.php";
include "config.php";

if (isset($_POST['save'])) {
    $category = mysqli_real_escape_string($conn, $_POST['cat']);

    // Check if category already exists
    $check_sql = "SELECT * FROM category WHERE category_name = '{$category}'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<div class='alert alert-danger text-center'>Category already exists.</div>";
    } else {
        // Insert query
        $sql = "INSERT INTO category (category_name, post) VALUES ('{$category}', 0)";
        if (mysqli_query($conn, $sql)) {
            header("Location: category.php"); // Redirect to category list
            exit;
        } else {
            echo "<div class='alert alert-danger text-center'>Failed to add category.</div>";
        }
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
