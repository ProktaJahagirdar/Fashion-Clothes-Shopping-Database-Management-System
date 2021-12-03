<?php
session_start();
include("includes/db.php");
//$con=mysqli_connect('localhost','root','','shopping');


$email=$_POST['email_id'];

$password=$_POST['password'];

$s= "select * from admin where admin_email='$email' && admin_password='$password'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);
if($num==1){
    $_SESSION['email_id']=$email;
    echo "<script>alert('You have logged in.')</script>";
    echo "<script>window.open('admin_home.php','_self')</script>";
}
else{
    
    echo "<script>alert('Email id or password is wrong.')</script>";
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>