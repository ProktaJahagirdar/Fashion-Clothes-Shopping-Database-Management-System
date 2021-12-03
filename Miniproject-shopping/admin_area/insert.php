<?php
	include('includes/db.php');
	//include('function.php');
 // Using database connection file here
 if(isset($_POST["increase"]))  
 {  
   
   $var=$_POST["hidden_name"];
   $qty = $_POST['increasetb'];
    //echo is_int($qty);
   if($qty > 0)
   {
    echo '<script>alert("Quantity updated successfully")</script>'; 
   $query=mysqli_query($con,"UPDATE 'products' set `p_qty`='$qty' WHERE `product_id`=$var;");
   //redirect('adminproduct.php');
   }
   else{
    echo '<script>alert("Quantity must be greater than 0")</script>'; 
    //redirect('adminproduct.php');
   }
 }
 if(isset($_POST["remove"]))  
 {  
   $var=$_POST["hidden_name"];
   $query=mysqli_query($con,"DELETE FROM `products` WHERE `product_id`=$var;");
   echo '<script>alert("Dish deleted successfully")</script>'; 
   //redirect('admin_menu.php');
 }
 if(isset($_POST["update"]))  
 {  
   $var=$_POST["hidden_name"];
   $price = $_POST['updatetb'];
   if($price > 0)
   {
    echo '<script>alert("Price updated successfully")</script>'; 
   $query=mysqli_query($con,"UPDATE `products`set `product_price`='$price' WHERE `product_id`=$var;");
   //redirect('admin_menu.php');
   }
   else{
    echo '<script>alert("Price must be greater than 0")</script>'; 
    //redirect('admin_menu.php');
   }
 }
 if(isset($_POST["orderbtn"]))  
 {  
   $oid=$_POST["oid"];
   $uid = $_POST['uid'];
   $trackorderq = "SELECT * FROM orderitems WHERE user_id='$uid' and  orderid='$oid'";
     $r = $con->query($trackorderq);
     ?>
     <table class="table table-bordered table-dark" id="tableMain" style="table-layout: fixed; width: 100%">
     <thead>
       <tr>
       
                   
           <th>Dish</th> 
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
				<td><div style="word-wrap: break-word;"><?php echo $rows['dish_name'];?></div></td> 
				<td><div style="word-wrap: break-word;"><?php echo $rows['qty'];?></div></td>
        <td><div style="word-wrap: break-word;"><?php echo $rows['price'];?></div></td> 
				 
        </form>
			</tr> 



			<?php 
				
                }
                ?>
</table> 
	</section> <?php
 }
 if(isset($_POST['button']))
 {		
     $newdish = $_POST['newdish'];
     $price = $_POST['price'];
     $qty = $_POST['qty'];
     $desc= $_POST['desc'];
     $cat= $_POST['cat'];
     $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
     $menu_check_query = "SELECT * FROM menu_table WHERE dish_name='$newdish'  LIMIT 1";
     $result = mysqli_query($con, $menu_check_query);
     $dish = mysqli_fetch_assoc($result);
   
   if ($dish) { // if dish exists
     if(strcasecmp($dish['dish_name'],$newdish)==0){
         echo '<script>alert("Dish already exists")</script>'; 
         redirect('admin_menu.php');
     }
   }
   else{
     
     $insert = mysqli_query($con,"INSERT INTO `menu_table`(`dish_name`, `qty`,`dish_desc`,`price`,`image`,`category`,status) VALUES ('$newdish','$qty','$desc','$price','$file','$cat','1')");
     echo '<script>alert("Dish added successfully")</script>'; 
     if(mysqli_query($con, $insert))  
       {  
            echo '<script>alert("Image Inserted into Database")</script>';  
       } 
       redirect('admin_menu.php');
 }
     
 }
 
  // Close connection
  mysqli_close($con);
 ?>