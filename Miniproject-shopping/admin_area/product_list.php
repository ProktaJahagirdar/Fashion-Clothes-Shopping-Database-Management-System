<?php
include('includes\db.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clothes shopping website</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
<center><!--  center Begin  -->
    
    <h1> View Products</h1>
    
    <p class="lead"> Your products on one place</p>
    
</center><!--  center Finish  -->


<hr>
<div class="col-md-9"><!-- col-md-9 Begin -->

<div class="table-responsive"><!--  table-responsive Begin  -->
    
    <table class="table table-bordered table"><!--  table table-bordered table-hover Begin  -->
        
        <thead><!--  thead Begin  -->
            
            <tr><!--  tr Begin  -->
                
                <th> Product Id </th>
                <th> Product Title</th>
                <th> Product Image</th>
                <th> Product Product Category</th>
                <th> Product Category</th>
                <th> Product Price </th>
                <th> Product Qty </th>
                <th> Added Date </th>
                <th> Delete</th>
                
            </tr><!--  tr Finish  -->
            
        </thead><!--  thead Finish  -->
        
        <tbody><!--  tbody Begin  -->
        <?php 
          
            $i=0;
                            
            $get_pro = "select * from products";
                                
            $run_pro = mysqli_query($con,$get_pro);
          
            while($row_pro=mysqli_fetch_array($run_pro)){
                                    
                $pro_id = $row_pro['product_id'];
                                    
                $pro_title = $row_pro['product_title'];
                                    
                $pro_img1 = $row_pro['product_img1'];

                $pro_p_cat_id = $row_pro['p_cat_id'];

                $pro_cat_id = $row_pro['cat_id'];
                                    
                $pro_price = $row_pro['product_price'];
                                    
                $pro_qty = $row_pro['p_qty'];
                                    
                $pro_date = $row_pro['date'];
                                    
                $i++;
                            
        ?>
        <tr><!-- tr begin -->
            <td> <?php echo $i; ?> </td>
            <td> <?php echo $pro_title; ?> </td>
           <td> <img src="product_images/<?php echo $pro_img1; ?>" width="60" height="60"> </td>
            <td> <?php echo $pro_p_cat_id; ?> </td>
            <td> <?php echo $pro_cat_id; ?> </td>
            <td> Rs. <?php echo $pro_price; ?> </td>
            <td> <?php echo $pro_qty; ?> </td>
            <td> <?php echo $pro_date; ?> </td>
            <td>
                                           
                <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                                           
            </td>
                
        </tr><!--  tr Finish  -->
            
        </tbody><!--  tbody Finish  -->
        
        
    </table><!--  table table-bordered table-hover Finish  -->
    
</div><!--  table-responsive Finish  -->
</div><!-- col-md-9 Finish -->
<div class="box-footer"><!-- box-footer Begin -->
        <div class="pull-right"><!-- pull-right Begin -->
                               
                               <button type="submit" name="update" value="Update Cart" class="btn btn-default"><!-- btn btn-default Begin -->
                                   
                                   <i class="fa fa-refresh"></i> Update Cart
                                   
                               </button><!-- btn btn-default Finish -->
        </div><!-- pull-right Finish -->
</div><!-- box-footer Finish -->


<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
</body>
</html>
<?php } ?>