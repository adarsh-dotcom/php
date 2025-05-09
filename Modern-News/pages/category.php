<?php
include "header.php";
include "config.php";

// Pagination settings
$limit = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset}, {$limit}";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $serial = $offset + 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='id'>{$serial}</td>";
                                echo "<td>{$row['category_name']}</td>";
                                echo "<td>{$row['post']}</td>";
                                echo "<td class='edit'><a href='update-category.php?id={$row['category_id']}'><i class='fa fa-edit'></i></a></td>";
                                echo "<td class='delete'><a href='delete-category.php?id={$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>";
                                echo "</tr>";
                                $serial++;
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No categories found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php
                $count_sql = "SELECT COUNT(*) AS total FROM category";
                $count_result = mysqli_query($conn, $count_sql);
                $row = mysqli_fetch_assoc($count_result);
                $total_records = $row['total'];
                $total_pages = ceil($total_records / $limit);

                if ($total_pages > 1) {
                    echo "<ul class='pagination admin-pagination'>";

                    if ($page > 1) {
                        echo "<li><a href='category.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active = ($i == $page) ? "class='active'" : "";
                        echo "<li {$active}><a href='category.php?page={$i}'>{$i}</a></li>";
                    }

                    if ($page < $total_pages) {
                        echo "<li><a href='category.php?page=" . ($page + 1) . "'>Next</a></li>";
                    }

                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
