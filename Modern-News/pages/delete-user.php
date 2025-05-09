<?php 
if($_SESSION['user_role']== '0') {
    header('Location: post.php');
}
include "config.php";

$user_id = $_GET['id'];
$sql = "DELETE FROM USER WHERE user_id={$user_id}";

if(mysqli_query($conn, $sql)){
    header('Location: users.php');

}
else
{
    echo "<p style='color:red; margin: 10px 0;'>Cant Delete The Record.</p>";
}
 





?>