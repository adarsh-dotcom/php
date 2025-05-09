<?php
include('includes/header.php');
include('config/connection.php');

if(isset($_POST['login_btn'])){
    $acc_email_address =  $_POST['acc_email_address'];
    $acc_password      =  $_POST['acc_password'];

    $acc_check_query = "SELECT * FROM users WHERE acc_email_address = '$acc_email_address' LIMIT 1";
    $acc_check_result = mysqli_query($conn, $acc_check_query);

    
    if (mysqli_num_rows($acc_check_result) > 0) {
        $error_message = "Email address already exists.";
    } else {
        $acc_login_query = "INSERT INTO users (acc_email_address, acc_password) VALUES ('$acc_email_address', '$acc_password')";
        $acc_login_queryrun = mysqli_query($conn, $acc_login_query);

        if ($acc_login_queryrun) {
            header('Location: data.php');
            exit();
        } else {
            echo "Something went wrong during registration.";
        }
    }
}

?>

<div class="d-flex justify-content-center mt-5">

    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h2 class=text-center>Login</h2>
            </div>
            <div class="card-body">
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name="acc_email_address" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="acc_password">
                        <?php if (!empty($error_message)): ?>
                            <div class="text-danger mt-2"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="login_btn" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>