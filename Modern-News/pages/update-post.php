<?php include "header.php"; ?>
<?php include 'config.php'; ?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $post_id = $_GET['id'];
                $get_query = "SELECT post.post_id, post.title, post.description, post.post_img, post.category, category.category_name
                              FROM post 
                              LEFT JOIN category ON post.category = category.category_id 
                              LEFT JOIN user ON post.author = user.user_id 
                              WHERE post.post_id = {$post_id}";

                $result = mysqli_query($conn, $get_query) or die("Query Failed");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                ?>

                <!-- Form for show edit-->
                <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <!-- Hidden Post ID -->
                    <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
                    <!-- Also send old image name -->
                    <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">

                    <div class="form-group">
                        <label for="exampleInputTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleInputTitle"
                               value="<?php echo $row['title']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">
                            <option disabled>Select Category</option>
                            <?php
                            $cat_sql = "SELECT * FROM category";
                            $cat_result = mysqli_query($conn, $cat_sql) or die("Query Failed.");

                            if (mysqli_num_rows($cat_result) > 0) {
                                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                   
                                    $selected = ($row['category'] == $cat_row['category_id']) ? "selected" : "";
                                    echo "<option {$selected} value='{$cat_row['category_id']}'>{$cat_row['category_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Post image</label><br>
                        <input type="file" name="new-image">
                        <img src="upload/<?php echo $row['post_img']; ?>" height="150px" alt="Current Image">
                        <input type="hidden" name="old_image" value="<?php echo $row['post_img'];?>">
                    </div>

                    <input type="submit" name="update_btn" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->

                <?php
                } else {
                    echo "<div class='alert alert-danger'>Result Not Found</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
