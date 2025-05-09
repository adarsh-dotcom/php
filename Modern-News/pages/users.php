<?php
include "header.php";
include "config.php";
if($_SESSION['user_role']== '0') {
    header('Location: post.php');
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 3;

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;


                        $get_query = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                        $get_query_run = mysqli_query($conn, $get_query);

                        if (mysqli_num_rows($get_query_run) > 0) {
                            $serial = 1;
                            while ($row = mysqli_fetch_assoc($get_query_run)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["user_id"] ?></td>
                                    <td><?php echo ($row['first_name'] . " " . $row['last_name']); ?></td>
                                    <td><?php echo ($row['username']); ?></td>
                                    <td><?php echo $row['role'] == 1 ? 'Admin' : 'Normal'; ?></td>
                                    <td class='edit'>
                                        <a href='update-user.php?id=<?php echo $row["user_id"] ?>'><i
                                                class='fa fa-edit'></i></a>
                                    </td>
                                    <td class='delete'>
                                        <a href='delete-user.php?id=<?php echo $row["user_id"] ?>'><i
                                                class='fa fa-trash-o'></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if (mysqli_num_rows($result1) > 0) {
                    $total_records = mysqli_num_rows($result1);
                    $total_page = ceil($total_records / $limit);

                    echo '<ul class="pagination admin-pagination">';
                    if ($page > 1) {
                        echo '<li><a href="users.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $style = "style='color: black; font-weight: bold;'";
                        } else {
                            $style = "";
                        }
                        echo "<li><a href='users.php?page=$i' $style>$i</a></li>";
                    }

                    if ($total_page > $page) {
                        echo '<li><a href="users.php?page=' . ($page + 1) . '">Next</a></li>';
                    }

                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>