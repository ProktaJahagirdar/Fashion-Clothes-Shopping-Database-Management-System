<?php

include('includes/db.php');
//include('function.php');
//include('server.php');
$_SESSION['count']=0;
if (!isset($_SESSION['customername'])) 
{
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) 
{
  session_destroy();
  unset($_SESSION['customername']);
  header("location: login.php");
}
if (isset($_SESSION['customername'])) 
{
    $uname= $_SESSION['customername'];
     $idquery="select id from `customer` where `username`='$uname'";
     $result = mysqli_query($con, $idquery);
     $val=mysqli_fetch_array($result);
     $uid= $val['id'];
     
if(isset($_POST["proceedtopay"]))
{
  redirect("billpr.php");
  /*$date=date("Y-m-d");
  $insert2 = mysqli_query($con,"INSERT INTO order_placed(user_id,order_date,status) VALUES ('$uid','$date',0);");
  $odq="select max(id) as maxid from `order_placed` where `user_id`='$uid'";
  $r = mysqli_query($con, $odq);
  $vals=mysqli_fetch_array($r);
  $ordid= $vals["maxid"];
  $total = 0;
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
   
    foreach($cart_data as $keys => $values)
    {
     $dish=$values["item_name"];
     $qty= $values["item_quantity"]; 
     $price= number_format($values["item_quantity"] * $values["item_price"], 2);
     $insert = mysqli_query($con,"INSERT INTO order_items(orderid,qty,user_id,dish_name,price) VALUES ('$ordid','$qty','$uid','$dish',$price);");
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
  
    //header("location:billpr.php?success=1");
    //header("location:Delivery_form.php?cnno=".$cnno."&copies=".$nocopy);
  
    $date=date("Y-m-d");
    $update = mysqli_query($con,"UPDATE order_placed set purchase_amount=$total where id=$ordid;");
    setcookie("shopping_cart", "", time() - 3600);
    //header("location:bill.php?success=1");*/
}
 
}

$message = '';
$count=0;
if(isset($_POST["ok"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["hid_id"],  $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] === $_POST["hid_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["hid_qty"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hid_id"],
   'item_name'   => $_POST["hid_name"],
   'item_price'  => $_POST["hid_price"],
   'item_quantity'  => $_POST["hid_qty"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:dummyadd.php?success=1");
 
}
if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
   $count--;
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:dummyadd.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  $_SESSION['count']=0;
  setcookie("shopping_cart", "", time() - 3600);
  header("location:dummyadd.php?clearall=1");
  
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
  $_SESSION['count']=0;
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}
?>
<!doctype html>
<html lang="en">
<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" href="myweb.css">
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


  <title>Cart</title> 
  <style> 
       
      .img-container {
    display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
      }
    
  
        h1 { 
            text-align: center; 
            color: Red; 
            font-size: xx-large; 
            font-family: 'Gill Sans', 'Gill Sans MT',  
            ' Calibri', 'Trebuchet MS', 'sans-serif'; 
    } 
    .form-group{
      margin:0 auto;
      width:210px;
    }
    .form input{
      display: inline-block;
      text-align:left;
      float:right;
      height: 20px;
  flex: 0 0 200px;
  margin-left: 10px;
    }
    .form label {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
  text-align: right;
  width: 400px;
  line-height: 26px;
  margin-bottom: 10px;
}
.button {
  display: inline-block;
  padding: 15px 30px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  margin: 100;
  position:relative;
  
  
}
button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
}
    
    
  </style>
  </head>
  <body>
  <div class="img-container">
<img src=Capture.PNG alt="Paris">
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="#">
            <img src="https://cms-assets.tutsplus.com/uploads/users/2273/posts/32688/image/Restaurant%20Logo.jpg" width="30" height="30" alt="" loading="lazy">
          </a>
        <!--<a class="navbar-brand" href="#">WELCOME!</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="Home.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Help.php">Help</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['customername']?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="dummyadd.php">View Cart</a>
                <a class="dropdown-item" href="user_logout.php">Logout</a>
                
              </div>
            </li>
    
            <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Help</a>
                <a class="dropdown-item" href="#">Contact Us</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Team</a>
              </div>
            </li>-->
           
            
            <!--<li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>-->
          </ul>
        </div>
      </nav>
  <section> 
    <h1>ITEMS</h1> 
<table>
</div>
   <br />
   <div class="table-responsive">
   <?php echo $message; ?>
   <div align="right">
    <a href="dummyadd.php?action=clear"><b>Clear Cart</b></a>
   </div>
   <table class="table table-bordered" id="tableMain" style="table-layout: fixed; width: 50%; margin: auto;">

    <tr>
     <th width="40%">Item Name</th>
     <th width="10%">Quantity</th>
     <th width="20%">Price</th>
     <th width="15%">Total</th>
     <th width="15%">Action</th>
    </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
     
         ?>
    <tr>
    
     <td><?php echo $values["item_name"]; ?></td>
     <td><?php echo $values["item_quantity"]; ?></td>
     <td>Rs. <?php echo $values["item_price"]; ?></td>
     <td>Rs. <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="dummyadd.php?action=delete&id=<?php echo $values["item_id"]; ?>">Remove</a></td>
     
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
     $count++;
     //echo $count;
     $_SESSION['count']=$count;
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right">Rs. <?php echo number_format($total, 2); ?></td>
     <td></td>
    </tr>
   <?php
   }
   else
   {
 
    echo '
    <tr>
     <td colspan="5" align="center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
   </table>
   </div>
  </div>
  <br />
  <form method="post" action="">
  <?php //echo  $_SESSION['count']?>
<input type="submit" name="proceedtopay" style="margin-top:5px;" class="button" value="PROCEED TO PAY" <?php echo  ($_SESSION['count']<=0)? 'disabled' :''?>/>
</form>
  <body>

