<?php
include('connection.php');

// $conn = mysqli_connect("localhost","root","","adarsh",3307);


if (isset($_POST['register-btn'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];
}

$query = "INSERT INTO REGISTER (firstname,lastname,email,password,phonenumber)values('$firstname','$lastname','$email','$$password','$phonenumber')";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
    header("Location: index.php");
   

} else {
    echo "Unsucessful";
}
?>