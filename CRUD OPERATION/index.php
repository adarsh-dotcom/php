<?php include('includes/header.php');
include('connection.php');
?>
<?php
include('connection.php');
if(isset($_POST['register_delete_btn'])) {
    $delete_id = $_POST['delete_id'];

    $delete_query = "delete from REGISTER where id = '$delete_id'";
    $update_query_run = mysqli_query($conn, $delete_query);

    if( $update_query_run){
        echo "Delete Sucessfully";
    }
    else{
        echo "Not Deleted";
    }

}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>PHP CRUD
                        <a href="register.php" class="btn btn-primary float-end">Register / Add</a>
                    </h2>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">FIRST</th>
                                <th scope="col">LAST</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">PASSWORD</th>
                                <th scope="col">PHONE NUMBER</th>
                                <th scope="col">EDIT</th>
                                <th scope="col">DELETE</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $register = "SELECT * FROM register";
                            $register_run = mysqli_query($conn, $register);

                            if (mysqli_num_rows($register_run) > 0) {
                                while ($reg_row = mysqli_fetch_array($register_run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $reg_row['id']; ?></td>
                                        <td><?php echo $reg_row['firstname']; ?></td>
                                        <td><?php echo $reg_row['lastname']; ?></td>
                                        <td><?php echo $reg_row['email']; ?></td>
                                        <td><?php echo str_repeat('*', 8); ?></td>

                                        <td><?php echo $reg_row['phonenumber']; ?></td>
                                        <td>
                                            <a href="register-edit.php?id=<?php echo $reg_row['id'];?>"
                                                class="btn btn-info">Edit</a>
                                        </td>
                                        
                                        <td>
                                           <form action="index.php" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $reg_row['id']; ?>">
                                            <button type="submit" name="register_delete_btn" class="btn btn-danger">Delete</button>
                                           </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No Record Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>