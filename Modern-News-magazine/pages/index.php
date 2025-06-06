<?php
include 'config.php';
session_start();
if(isset($_SESSION["username"])) {
    header('Location: post.php');
}
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                       
                       <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-group">
                                 <img class="logo" src="images/modernnewsmagazines.png">
                                <h3 class="heading text-center">Admin Login</h3>
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                         <?php
                         
                         if(isset($_POST['login'])){
                            include "config.php";

                            $username   = mysqli_real_escape_string($conn, $_POST['username']);
                            $password   = md5($_POST['password']);

                            $sql = "SELECT user_id, username, role from user where username= '{$username}' AND password= '{$password}'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)>0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    session_start();
                                    $_SESSION["username"] = $row['username'];
                                    $_SESSION["user_id"] = $row['user_id'];
                                    $_SESSION["user_role"] = $row['role'];

                                    header('Location: users.php');
                                }
                            }
                            else
                            {
                                echo '<div class="alert alert-danger">Username Password are not Match.</div>';
                            }
                         }
                         ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
