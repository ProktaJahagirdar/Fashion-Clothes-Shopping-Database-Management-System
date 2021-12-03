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
$r="   ";
$sql = "select c.cust_id,c.cust_fname,c.cust_lname,o.id,o.purchase_amount,o.order_date FROM orderplaced o,customer c
        where c.cust_id = o.cust_id";        
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
  <div class='box'>
    <center>
    <h1>All Orders' Details</h1> 
    </center>
    </div>
    <!-- TABLE CONSTRUCTION--> 
  
		<table class="table " id="tableMain" style="table-layout: fixed; width: 100%">
  <thead>
    <tr>
    
                
				<th width="100">Customer ID</th> 
				<th>Customer Name</th> 
                <th >Order ID</th>
                <th >Order Amount</th>
				<th>Date</th>
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
          <form name="form1" method="post" >
                <td><?php echo $rows['cust_id'];?></td>
				<td><div style="word-wrap: break-word;"><?php echo $rows['cust_fname'],$r,$rows['cust_lname'];?></div></td> 
                <td><?php echo $rows['id'];?></td>
				<td><?php echo $rows['purchase_amount'];?></td> 
                <td><?php echo $rows['order_date'];?></td> 
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
