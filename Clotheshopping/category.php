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
              <a href="order.php">Shop</a>
            </li>
            <li>
              Category
            </li>
          </ul><!-- breadcrumb Finish -->
               
      </div><!-- col-md-12 Finish -->
      <div class="col-md-3"><!-- col-md-3 Begin -->
         <?php 
           include("includes/sidebar.php");
         ?>   
      </div><!-- col-md-3 Finish -->
           
           
   
   
   <div class="col-md-9"><!-- col-md-9 Begin -->
   <?php
    
    if(isset($_GET['w_cat'])){
        $p_cat_id = $_GET['w_cat'];
        $get_p_cat ="select * from product_categories where p_cat_id='$p_cat_id'";
        $run_p_cat = mysqli_query($db,$get_p_cat);
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_title = $row_p_cat['p_cat_title'];
        $get_products ="select * from products where aval_status=0 && p_cat_id='$p_cat_id'";
        $run_products = mysqli_query($db,$get_products);
        $query = "SELECT * FROM products where aval_status=0 && p_cat_id='$p_cat_id' ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $count = mysqli_num_rows($run_products);
        if($count==0){
            echo "
                <div class='box'>
                    <h7> No Product Found In This Product Categories </h7>
                </div> ";
        }else{
            echo "
                <div class='box'>
                    <h1> $p_cat_title </h1>
                </div>
            ";
        }
        
   foreach($result as $row)
   {
   ?>
   <div class="col-md-4">
    <form method="post" action="cart.php">
     <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
	 <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['image'] );?>" height="200" width="150"  class="card-img-top" />
          

      <h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

      <h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>

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
   }
   ?>


   <?php
    
      if(isset($_GET['m_cat'])){
        $p_cat_id = $_GET['m_cat'];
        $get_p_cat ="select * from product_categories where p_cat_id='$p_cat_id'";
        $run_p_cat = mysqli_query($db,$get_p_cat);
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_title = $row_p_cat['p_cat_title'];
        $get_products ="select * from products where aval_status=0 && p_cat_id='$p_cat_id'";
        $run_products = mysqli_query($db,$get_products);
        $query = "SELECT * FROM products where aval_status=0 && p_cat_id='$p_cat_id' ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $count = mysqli_num_rows($run_products);
        if($count==0){
            echo "
                <div class='box'>
                    <h7> No Product Found In This Product Categories </h7>
                </div> ";
        }else{
            echo "
                <div class='box'>
                    <h1> $p_cat_title </h1>
                </div>
            ";
        }
        
   foreach($result as $row)
   {
   ?>
   <div class="col-md-4">
    <form method="post" action="cart.php">
     <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
	 <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['image'] );?>" height="200" width="150" class="card-img-top" />
          

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