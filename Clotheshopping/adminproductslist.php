<?php
session_start();
$con=mysqli_connect('localhost','root','','shopping');

//include("includes/header.php");
//if (!isset($_SESSION['adminname'])) {
//  $_SESSION['msg'] = "You must log in first";
//  header('location: adminlogin.php');
//}
//if (isset($_GET['logout'])) {
//  session_destroy();
 // unset($_SESSION['adminname']);
 // header("location: adminlogin.php");
//}


// Checking for connections 
//if ($con->connect_error) { 
//	die('Connect Error (' . 
//	$con->connect_errno . ') '. 
//	$con->connect_error); 
//} 

// SQL query to select data from database 
$sql = "select * FROM products order by product_name"; 
$result = $con->query($sql); 
$con->close(); 
?> 
<!doctype html>
<html lang="en">
  <head>
  <?php 
  include("admin_header.php");
  ?>
  </head>
  <body>
  
     
	<section> 
    <center>
    <div class='box'>
    <h1>ALL PRODUCTS</h1> 
    </center>
    </div>
    <!-- TABLE CONSTRUCTION--> 
  
		<table class="table table-bordered table-light" id="tableMain" style="table-layout: fixed; width: 100%">
  <thead >
    <tr>
    
                
				<th width="100">PRODUCT IMAGE</th> 
				<th>PRODUCT NAME</th> 
				<th >QUANTITY PRESENT</th>
				<th>INCREASE QUANTITY</th>
				<th>REMOVE PRODUCT</th>
				<th>PRICE</th>
				<th>CHANGE PRICE</th>
        <th>STATUS</th>
    </tr>
  </thead>
  <tbody>
  </tr> 
			<!-- PHP CODE TO FETCH DATA FROM ROWS--> 
			<?php // LOOP TILL END OF DATA 
				while($rows=$result->fetch_assoc()) 
				{ 
			?> 
			<tr> 
				<!--FETCHING DATA FROM EACH 
					ROW OF EVERY COLUMN--> 
		
          <form name="form1" method="post" action="insert.php">
	
				<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($rows['image'] ).'" height="80" width="80" class="img-thumnail" />'; ?></td>
				<td><div style="word-wrap: break-word;"><?php echo $rows['product_name'];?></div></td> 
				
        <td><?php echo $rows['qty'];?></td>
      <td>
        <input type="textbox" id="textbox" name="increasetb" size="5" placeholder="Quantity">
        <input type="submit" id="increase" class='b_dtl' name="increase" value="SET">
      </td>
				<td><input type="submit" id="remove" name="remove" value="REMOVE"></td>
				<td><?php echo $rows['price'];?></td> 
				<td><input type="textbox" id="textbox" name="updatetb" size="5" placeholder="Price" name="set" ><input type="submit" id="update" name="update" value="SET"></td>
        <input type="hidden" id="hidden_name" name="hidden_name" value="<?php echo $rows['product_id']; ?>"/> 
        <td><?php echo ($rows['aval_status']==0)? 'Available':  'Not Available';?></td> 
        
				</form>
			</tr> 



			<?php 
				
        }
        
				?>
	
	</table> 
	</section> 

	<script>
	$(document).ready(function(){  
  $('#desc').click(function(){  
       var image_name = $('#image').val();  
       if(image_name == '')  
       {  
            alert("Please Select Image");  
            return false;  
       }  
       else  
       {  
            var extension = $('#image').val().split('.').pop().toLowerCase();  
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
            {  
                 alert('Invalid Image File');  
                 $('#image').val('');  
                 return false;  
            }  
       }  
  });  
}); 
</script>
<script src="all-numbers.js"></script>
<br></br>
<br></br>
<br></br>
<br></br>

  <?php
  include("admin_footer.php");
  ?>
  </body>
  <script>
            document.onkeydown = function (t) {
             if(t.which == 9){
              return false;
             }
            }
            </script>
</html> 
