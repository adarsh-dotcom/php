<?php
include('connection.php');

if (isset($_POST['register-update-btn'])) {
    $update_id = $_POST['edit_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];

    $query_update = "UPDATE REGISTER SET firstname='$firstname', lastname='$lastname', email='$email', password='$password', phonenumber='$phonenumber' where id='$update_id'";

    $query_update_run = mysqli_query($conn, $query_update);

    if($query_update_run)
    {
        header("Location: index.php");
    }
    else
    {
        echo "Data Not Updated";
    }

}


?>