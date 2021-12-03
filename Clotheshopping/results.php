<?php
session_start();
include("includes/header1.php");
$connect = new PDO("mysql:host=localhost;dbname=shopping", "root", "");
include("includes/db.php");
$product_searched=$_POST['user_query'];
$query = "SELECT * FROM products where product_name='$product_searched' && aval_status=0";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$result1=mysqli_query($con,$query);
$num=mysqli_num_rows($result1);
if($num==0){
echo "No such product available";
}
else{
   foreach($result as $row)
   {
   ?>
    <form method="post" action="cart.php">
     <div style="border:1px solid #333; background-color:#f1f1f1; max-width:300px; margin:auto;border-radius:5px; padding:16px;"align="center" >
	 <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['image'] );?>" height="200" width="200" class="card-img-top" />
          

      <h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

      <h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4>

      <input type="text" name="quantity" value="1" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["product_id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
     </div>
    </form>
   
   <?php
   }
}
   ?>