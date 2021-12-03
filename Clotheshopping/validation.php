<?php
session_start();
include("includes/db.php");
//$con=mysqli_connect('localhost','root','','clothes');


$email=$_POST['email_id'];

$password=$_POST['password'];

$s= "select * from customer where email_id='$email'&& password='$password'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);
if($num==1){
    $_SESSION['email_id']=$email;
    echo "<script>alert('You have logged in.')</script>";
    echo "<script>window.open('home.php','_self')</script>";
}
else{
    
    echo "<script>alert('Email id or password is wrong.')</script>";
    echo "<script>window.open('login.php','_self')</script>";
}

?>