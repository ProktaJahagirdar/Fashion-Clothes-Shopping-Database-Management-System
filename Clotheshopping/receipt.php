<?php
session_start();

//if (!isset($_SESSION['name'])) 
//{
 // $_SESSION['msg'] = "You must log in first";
 // header('location: login.php');
//}
//if (isset($_GET['logout'])) 
//{
 /// session_destroy();
  //unset($_SESSION['name']);
  //header("location: login.php");
//}



//index.php

$con=mysqli_connect('localhost','root','','shopping');
if (isset($_SESSION['email_id'])) {
	echo '<script>alert("Warning!! Please do not refresh the page. You will be redirected after 10 seconds. Kindly save the bill")</script>';
    $uname= $_SESSION['email_id'];
    $idquery="select * from `customer` where `email_id`='$uname'";
    $result = mysqli_query($con, $idquery);
    $val=mysqli_fetch_array($result);
    $uid= $val['cust_id'];
    //echo $val['address'];
    //echo $val['phno'];
    $order="select * from `orderplaced` where `cust_id`='$uid' and payment=0";
    $result2 = mysqli_query($con, $order);
    $orders=mysqli_fetch_array($result2);

}
?>
<html>
<script type="text/javascript">
    document.oncontextmenu = disableRightClick;

    function disableRightClick(event)
    {
        event = event || window.event;

        if (event.preventDefault)
        {
            event.preventDefault();
        }
        else
        {
            event.returnValue = false
        }
    }
</script>
<script>
$("receipt.php").submit(function(e) {
    e.preventDefault();
});
</script>
	<head>
		<meta charset="utf-8">
		<title>bill</title>
		<link rel="stylesheet" href="mystyle.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
	</head>
	<body>
		<header>
			<h1>bill</h1>
			<address>
				<p><?php echo $uname?></p>
				<p><?php echo $val['address']?></p>
				<p><?php echo $val['phone_no']?></p>
			</address>
			<span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address >
				<p>Euphoria | Fashion Quotient</p>
			</address>
			<table class="meta">
				<tr>
					<th><span >bill #</span></th>
					<td><span ><?php echo $orders['cust_id']?></span></td>
				</tr>
				<tr>
					<th><span >Date</span></th>
					<td><span ><?php echo $orders['order_date']?></span></td>
				</tr>
				<tr>
					<th><span>Amount Due</span></th>
					<td><span id="prefix" >Rs.</span><span><?php echo $orders['purchase_amount']?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span >Product Name</span></th>
						<th><span >Quantity</span></th>
						<th><span >Price</span></th>
					</tr>
				</thead>
				<tbody>
                <?php
				$sql = "select * FROM order_items i,orderplaced o 
						where o.id=i.order_id
						and i.cust_id='$uid'
						and o.payment=0";
                $re = $con->query($sql);
                while($rows=$re->fetch_assoc()) 
				{ 
					$a=$rows['order_id'];
					$b=$rows['product_name'];
					$pricequery="select * from order_items where order_id='$a' and product_name ='$b' and cust_id='$uid'";
	  				$res = mysqli_query($con, $pricequery);
	  				$val2=mysqli_fetch_array($res);
                ?>
					<tr>
						<th><?php echo $rows['product_name'];?></th>
						<th><?php echo $rows['qty'];?></th>
						<th>Rs. <?php echo $val2['price']?></th>
					</tr>
                    <?php
				}
				$update = mysqli_query($con,"UPDATE orderplaced set `payment`=1  WHERE `cust_id`=$uid;");
				header( "refresh:20;url=cart.php" );
                    ?>
				</tbody>
			</table>
	</body>
</html>