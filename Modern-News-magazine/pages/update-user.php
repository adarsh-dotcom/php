<?php 
include "header.php";
include "config.php";

if($_SESSION['user_role']== '0') {
    header('Location: post.php');
}

if (isset($_POST['submit'])) {
    $user_id  = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname    = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname    = mysqli_real_escape_string($conn, $_POST['l_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    //Check username already exists
    $check_sql = "SELECT * FROM user WHERE username = '{$username}' AND user_id != {$user_id}";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<p style='color:red; text-align:center; margin: 10px 0;'>Username already exists</p>";
    } else {
        $update_sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$username}', role = '{$role}' WHERE user_id = {$user_id}";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: users.php");
            exit();
        } else {
            echo "<p style='color:red; text-align:center; margin: 10px 0;'>Update failed</p>";
        }
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $user_id = $_GET['id'];
                    $sql = "SELECT * FROM user WHERE user_id = {$user_id}";
                    $result = mysqli_query($conn, $sql) or die("Query failed");

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                        <!-- Form Start -->
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            </div>

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo htmlspecialchars($row['first_name']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo htmlspecialchars($row['last_name']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role">
                                    <option value="0" <?php echo ($row['role'] == 0) ? "selected" : ""; ?>>Normal User</option>
                                    <option value="1" <?php echo ($row['role'] == 1) ? "selected" : ""; ?>>Admin</option>
                                </select>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- /Form -->
                <?php
                    } else {
                        echo "<p>No user found.</p>";
                    }
                } else {
                    echo "<p>Invalid request.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
