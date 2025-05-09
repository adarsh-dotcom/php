<?php 
include 'header.php';
include "config.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = (int) $_GET['id'];

    $sql = "SELECT post.title, post.description, post.post_date, post.post_img, 
                   category.category_name, user.username, category.category_id, user.user_id 
            FROM post 
            LEFT JOIN category ON post.category = category.category_id 
            LEFT JOIN user ON post.author = user.user_id 
            WHERE post.post_id = {$post_id}";

    $result = mysqli_query($conn, $sql) or die("Query Failed.");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<h2>No Post Found.</h2>";
        include 'footer.php';
        exit;
    }
} else {
    echo "<h2>Invalid Post ID.</h2>";
    include 'footer.php';
    exit;
}
?>
<div id="main-content">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-6 offset-md-3">
                <!-- post-container -->
                <div class="post-container">
                    <div class="post-content single-post">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>

                        <div class="post-information mb-3">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($row['category_name']); ?>
                            </span>
                            <span class="ms-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($row['username']); ?>
                            </span>
                            <span class="ms-3">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($row['post_date']); ?>
                            </span>
                        </div>

                        <img class="single-feature-image mb-3"
                             src="upload/<?php echo !empty($row['post_img']) ? htmlspecialchars($row['post_img']) : 'default.jpg'; ?>" 
                             alt="" 
                             style="width: 100%; height: auto;" />

                        <p class="description">
                            <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                        </p>
                    </div>
                </div>
                <!-- /post-container -->
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
