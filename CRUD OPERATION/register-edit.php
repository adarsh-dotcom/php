<?php include('includes/header.php');
include('connection.php'); ?>


<?php
$id = $_GET['id'];
$updatequery = "SELECT * FROM REGISTER WHERE id = $id";

$updatequery_run = mysqli_query($conn, $updatequery);

if (mysqli_num_rows($updatequery_run) > 0) {
    while ($row = mysqli_fetch_array($updatequery_run)) {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3>Regsiter Edit Page</h3>
                        </div>
                        <div class="card-body">
                            <form action="update.php" method="post">

                                <input type="hidden" name="edit_id" class="form-control" value="<?php echo $row['id']; ?>">


                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" name="firstname" class="form-control"
                                        value="<?php echo $row['firstname']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" name="lastname" class="form-control"
                                        value="<?php echo $row['lastname']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                                </div>


                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"
                                        value="<?php echo $row['password']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phonenumber" class="form-control"
                                        value="<?php echo $row['phonenumber']; ?>">
                                </div>

                                <a href="index.php" class="btn btn-danger">Cancel</a>
                                <button type="submit" name="register-update-btn" class="btn btn-info">Update Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "No data found";
}
?>

<?php include('includes/footer.php') ?>