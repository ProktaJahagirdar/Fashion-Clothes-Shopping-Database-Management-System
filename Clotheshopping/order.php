<?php 
  session_start();
$connect = new PDO("mysql:host=localhost;dbname=shopping", "root", "");

//if (!isset($_SESSION['cust_fname'])) 
//{
 // $_SESSION['msg'] = "You must log in first";
 //   header('location: customer_login.php');
//}
/*if (isset($_GET['logout'])) 
{
     session_destroy(); 
  unset($_SESSION['cust_fname']);
  header("location: checkout.php");
}*/




?>
<!DOCTYPE html>
<html>
 <head>
  <title>PRODUCTS</title>
  <?php
  include("includes/header1.php");
  ?>
 </head>
 <body>
  <br />
  <div class="container">
      <div class="col-md-12"><!-- col-md-12 Begin --> 
          <ul class="breadcrumb"><!-- breadcrumb Begin -->
            <li>
              <a href="home.php">Home</a>
            </li>
            <li>
              Shop
            </li>
          </ul><!-- breadcrumb Finish -->
               
      </div><!-- col-md-12 Finish -->
      <div class="col-md-3"><!-- col-md-3 Begin -->
         <?php 
           include("includes/sidebar.php");
         ?>   
      </div><!-- col-md-3 Finish -->
           
    <div class="col-md-9"><!-- col-md-9 Begin -->       
   <br />
   <h3 align="center">LATEST PRODUCTS!!<br /><br /> Best products available only at Euphoria The Fashion Quotient</h3><br />
   <br /><br />
   <?php
   $query = "SELECT * FROM products where aval_status=0";
   $statement = $connect->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   
   foreach($result as $row)
   {
    $p_id=$row["product_id"]
   ?>
   <div class="col-md-4">
   
    <form method="post" action="cart.php">
     <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
	 <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['image'] );?>" height="200" width="200" margin:auto class="card-img-top" />
          
       
      <h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

      <h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>
      <h5 class="text"> <?php echo $row["product_desc"]; ?></h5>
      <span>Quantity:-</span>
      <input type="text" name="quantity" value="1" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
      

     </div>
    </form>
    
   </div>
   <?php
   }
   ?>
   
   </div><!-- col-md-9 Finish -->
   
   </table>
   </div>
  </div>
  <br />
  <?php
  include("includes/footer.php");
  ?>
 </body>
</html>