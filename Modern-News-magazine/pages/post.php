<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">Add Post</a>
            </div>
            <div class="col-md-12">
                <?php
                include "config.php";

                $limit = 3;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                // Role check
                $user_id = $_SESSION['user_id'];
                $user_role = $_SESSION['user_role'];

                if ($user_role == '1') {
                    // Admin: fetch all posts
                    $get_query = "SELECT post.post_id, post.title, category.category_name, post.post_date, user.username, post.category 
                                  FROM post 
                                  LEFT JOIN category ON post.category = category.category_id 
                                  LEFT JOIN user ON post.author = user.user_id 
                                  ORDER BY post.post_id DESC 
                                  LIMIT {$offset}, {$limit}";

                    // Total count for admin
                    $count_query = "SELECT COUNT(*) AS total FROM post";
                } else {
                    // Normal user: fetch posts
                    $get_query = "SELECT post.post_id, post.title, category.category_name, post.post_date, user.username, post.category 
                                  FROM post 
                                  LEFT JOIN category ON post.category = category.category_id 
                                  LEFT JOIN user ON post.author = user.user_id 
                                  WHERE post.author = {$user_id} 
                                  ORDER BY post.post_id DESC 
                                  LIMIT {$offset}, {$limit}";

                    // Total count
                    $count_query = "SELECT COUNT(*) AS total FROM post WHERE author = {$user_id}";
                }

                $get_query_run = mysqli_query($conn, $get_query);
                if (mysqli_num_rows($get_query_run) > 0) {
                    ?>
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Author</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Posts</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $serial = $offset + 1;
                            while ($row = mysqli_fetch_assoc($get_query_run)) {
                                ?>
                                <tr>
                                    <td class='id'><?php echo $row['post_id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                    <td><?php echo $row['post_date']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row["post_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id'];?>&catid=<?php echo $row['category'];?>'><i class="fa fa-trash-o"></i></a></td>
                                    <td><a href='view-post.php?id=<?php echo $row["post_id"]; ?>'><i class='btn btn-success'>View <?php echo htmlspecialchars($row['category_name']); ?> Post</i></a></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<h3>No Posts Found.</h3>";
                }

                // Pagination
                $result1 = mysqli_query($conn, $count_query);
                $row = mysqli_fetch_assoc($result1);
                $total_records = $row['total'];

                $total_page = ceil($total_records / $limit);

                if ($total_page > 1) {
                    echo '<ul class="pagination admin-pagination">';
                    if ($page > 1) {
                        echo '<li><a href="post.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $total_page; $i++) {
                        $active = ($i == $page) ? "class='active'" : "";
                        echo "<li $active><a href='post.php?page=$i'>$i</a></li>";
                    }

                    if ($page < $total_page) {
                        echo '<li><a href="post.php?page=' . ($page + 1) . '">Next</a></li>';
                    }

                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>