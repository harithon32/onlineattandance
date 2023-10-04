<?php 
require('connectdb.php');

$id = $_GET['id'];
$sql = "delete from read_admin where id='$id'";
$result = mysqli_query($conn,$sql);
if($result){
    header("location:index.php");
} else {
    die("Query failed: " . mysqli_error($conn));
}

?>