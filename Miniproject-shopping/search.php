<!DOCTYPE html>
<html>
<head>
	<title>Search Bar using PHP</title>
</head>
<body>
<center>
<form method="post">
<label>Search</label>
<input type="text" name="search">
<input type="submit" name="submit">

</form>
<span >Search by product</span>
</center>
</html>

<?php

include("includes/db.php");
$con = new PDO("mysql:host=localhost;dbname=euphoria",'root','');


if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT * FROM `search` WHERE product_name = '$str'");

	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();

	if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		<table>
			<tr>
				<th>Product ID</th>
				
                <th>Product Title</th>
                <th>Product Description</th>
                <th>Product Price</th>
			</tr>
			<tr>
				<td><?php echo $row->product_id; ?></td>
				
                <td><?php echo $row->product_title;?></td>
                <td><?php echo $row->product_desc;?></td>
                <td><?php echo $row->product_price;?></td>
			</tr>

		</table>
<?php 
	}
		
		
		else{
			echo "Product name Does not exist.Try searching some other product.";
		}


}

?>