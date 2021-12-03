<?php
  include('function.php');
  $con=mysqli_connect('localhost','root','','shopping');
  
 // Using database connection file here
 if(isset($_POST["increase"]))  
 {  
   
   $var=$_POST["hidden_name"];
   $qty = $_POST['increasetb'];
    //echo is_int($qty);
   if($qty > 0)
   {
    echo '<script>alert("Quantity updated successfully")</script>'; 
   $query=mysqli_query($con,"UPDATE `products`set `qty`='$qty' WHERE `product_id`=$var;");
   $query=mysqli_query($con,"UPDATE `products`set `aval_status`='0' WHERE `product_id`=$var;");
   echo "<script>window.open('adminproductslist.php','_self')</script>";
  //redirect('adminproductslist.php');
   }
   else{
    echo '<script>alert("Quantity must be greater than 0")</script>'; 
    echo "<script>window.open('adminproductslist.php','_self')</script>";
    //redirect('adminproductslist.php');
   }
 }
 if(isset($_POST["remove"]))  
 {  
   $var=$_POST["hidden_name"];
   $query=mysqli_query($con,"DELETE FROM `products` WHERE `product_id`=$var;");
   echo '<script>alert("Product deleted successfully")</script>'; 
   echo "<script>window.open('adminproductslist.php','_self')</script>";
   //redirect('adminproductslist.php');
 }
 if(isset($_POST["update"]))  
 {  
   $var=$_POST["hidden_name"];
   $price = $_POST['updatetb'];
   if($price > 0)
   {
    echo '<script>alert("Price updated successfully")</script>'; 
   $query=mysqli_query($con,"UPDATE `products`set `price`='$price' WHERE `product_id`=$var;");
   echo "<script>window.open('adminproductslist.php','_self')</script>";
   //redirect('adminproductslist.php');
   }
   else{
    echo '<script>alert("Price must be greater than 0")</script>'; 
    echo "<script>window.open('adminproductslist.php','_self')</script>";
    //redirect('adminproductslist.php');
   }
 }
 if(isset($_POST["orderbtn"]))  
 {  
   $oid=$_POST["oid"];
   $uid = $_POST['uid'];
   $trackorderq = "SELECT * FROM order_items WHERE cust_id='$uid' and  order_id='$oid'";
     $r = $con->query($trackorderq);
     ?>
     <table class="table table-bordered table-dark" id="tableMain" style="table-layout: fixed; width: 100%">
     <thead>
       <tr>
       
                   
           <th>product</th> 
           <th>Quantity</th> 
           <th>Total</th>
            
           
       </tr>
     </thead>
     <tbody>
     </tr> 
     <?php
      while($rows=$r->fetch_assoc()) 
				{ 
			?> 
			<tr> 
				<!--FETCHING DATA FROM EACH 
					ROW OF EVERY COLUMN--> 
		
				<form method="post" action="">
				<td><div style="word-wrap: break-word;"><?php echo $rows['product_name'];?></div></td> 
				<td><div style="word-wrap: break-word;"><?php echo $rows['quantity'];?></div></td>
        <td><div style="word-wrap: break-word;"><?php echo $rows['price'];?></div></td> 
				 
        </form>
			</tr> 



			<?php 
				
                }
                ?>
</table> 
	</section> <?php
 }
 if(isset($_POST['submit']))
 {		
     $product_name = $_POST['product_name'];
     $product_category=$_POST['p_cat_id'];
     $category=$_POST['cat_id'];
     $quantity=$_POST['qty'];
     $price = $_POST['price'];
     $product_desc = $_POST['product_desc'];
     $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
     $menu_check_query = "SELECT * FROM products WHERE product_name='$product_name'  LIMIT 1";
     $result = mysqli_query($con, $menu_check_query);
     $product = mysqli_fetch_assoc($result);
   
   if ($product) { // if dish exists
     if(strcasecmp($product['product_name'],$product_name)==0){
         echo '<script>alert("product already exists")</script>'; 
         echo "<script>window.open('adminproductslist.php','_self')</script>";
        // redirect('adminproductslist.php');
     }
   }
   else{
     $insert = mysqli_query($con,"insert into products(p_cat_id,cat_id,product_name,image,price,qty,product_desc,aval_status) values ('$product_category','$category','$product_name','$file','$price','$quantity','$product_desc',0)");
     echo '<script>alert("product added successfully")</script>'; 
     if(mysqli_query($con, $insert))  
       {  
            echo '<script>alert("Image Inserted into Database")</script>';  
       } 
       echo "<script>window.open('adminproductslist.php','_self')</script>";
       //redirect('adminproductslist.php');
 }
 }
  // Close connection
  mysqli_close($con);
 ?>