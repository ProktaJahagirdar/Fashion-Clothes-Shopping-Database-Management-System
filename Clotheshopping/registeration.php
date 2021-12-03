<?php
session_start();
include("includes/db.php");
//$con=mysqli_connect('localhost','root','','clothes');

$fname=$_POST['cust_fname'];
$lname=$_POST['cust_lname'];
$email=$_POST['email_id'];
$phone=$_POST['phone_no'];
$password=$_POST['password'];
$address=$_POST['address'];
$s= "select * from customer where email_id='$email'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);
if($num==1){
    echo "<script>alert('Email id already taken by user. Use different email id.')</script>";
    echo "<script>window.open('register.php','_self')</script>";
}
else{
    $reg="insert into customer(cust_fname,cust_lname,email_id,phone_no,password,address) values('$fname','$lname','$email','$phone','$password','$address')";
    mysqli_query($con,$reg);
    echo "<script>alert('You have registered sucessfully')</script>";
    echo "<script>window.open('login.php','_self')</script>";
}

?>