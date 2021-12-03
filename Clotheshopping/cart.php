<?php 
session_start();

//index.php
$_SESSION['count']=0;
$count=0;
$connect=mysqli_connect('localhost','root','','shopping');
$message = '';
if(isset($_POST["proceedtopay"]))
{
  ?>
	<script>
	window.location.href='bill.php';
	</script>
	<?php
   die();
}

if(isset($_POST["add_to_cart"]))
{ 
  $dishid=$_POST['hidden_id'];
  echo $dishid;
$dishpric=$_POST['hidden_price'];
$dishqty=$_POST['quantity'];
$idquery="select * from `products` where `product_id`='$dishid'";
$result34 = mysqli_query($connect, $idquery);
$val=mysqli_fetch_array($result34);
$itemqty= $val['qty'];
 echo $dishid;

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

 if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hidden_id"],
   'item_name'   => $_POST["hidden_name"],
   'item_price'  => $_POST["hidden_price"],
   'item_quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:cart.php?success=1");
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
    header("location:cart.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  $_SESSION['count']=0;
  setcookie("shopping_cart", "", time() - 3600);
  header("location:cart.php?clearall=1");
  
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
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}


?>
<!DOCTYPE html>
<html>
 <head>
  <?php 
  include("includes/header1.php");
  ?>
 </head>
 <body>
 <div class="col-md-12"><!-- col-md-12 Begin --> 
          <ul class="breadcrumb"><!-- breadcrumb Begin -->
            <li>
              <a href="home.php">Home</a>
            </li>
            <li>
              Cart
            </li>
          </ul><!-- breadcrumb Finish -->
               
      </div><!-- col-md-12 Finish -->
   
   
   <div style="clear:both"></div>
   <br />
   <center>
   <h2><b>ORDER DETAILS</b></h2>
   </center>
   <br></br>
   <div class="table-responsive">
   <?php echo $message; ?>
   <div align="right">
    <a href="cart.php?action=clear"><b>Clear Cart</b></a>
   </div>
   <table class="table table-hover"style="table-layout: fixed; width: 60%; margin: auto; height:50px">
   <thead class="thead-dark">
    <tr>
     <th width="20%">Product Name</th>
     <th width="10%">Quantity</th>
     <th width="10%">Price</th>
     <th width="15%">Total</th>
     <th width="10%">Action</th>
    </tr>
   </thead>
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
     <td>Rs <?php echo $values["item_price"]; ?></td>
     <td>Rs <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);
     $count++;
     $_SESSION['count']= $count;
  
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right">Rs <?php echo number_format($total, 2); ?></td>
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
   <form method="post" action="">
  <?php //echo  $_SESSION['count']?>
<center><input type="submit"  name="proceedtopay" style="margin-top:5px;" class="button" value="Place Order" <?php echo  ($_SESSION['count']<=0)? 'disabled' :''?> /></center>
</form>
   </div>
  </div>
  <br />
  <br></br>
  <br></br>
  <br></br>
  <?php
  include("includes/footer.php");
  ?>
 </body>
</html>