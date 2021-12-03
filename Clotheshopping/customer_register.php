<?php 

    $active='Account';
    include("includes/header.php");

?>
   
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Register
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
   
   
        
           </div><!-- col-md-3 Finish -->
           
           <div class="col-md-9"><!-- col-md-9 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <div class="box-header"><!-- box-header Begin -->
                       
                       <center><!-- center Begin -->
                           
                           <h2> Register a new account </h2>
                           
                       </center><!-- center Finish -->
                       
                       <form action="customer_register.php" id='registration' method="post" enctype="multipart/form-data"><!-- form Begin -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>First Name</label>
                               
                               <input type="text" class="form-control" name="cust_fname" pattern="^[a-zA-Z]*$" title="The name should consist of alphabets only and no spaces in between" required>
                               
                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Last Name</label>
                               
                               <input type="text" class="form-control" name="cust_lname" pattern="^[a-zA-Z]*$" title="The name should consist of alphabets only and no spaces in between" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Email Id</label>
                               
                               <input type="email" class="form-control" name="email_id" required>
                               
                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Mobile Number</label>
                               
                               <input type="text" class="form-control" name="phone_no" pattern="^\d{10}$" title="Mobile number should consist only 10 digits." required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Password</label>
                               
                               <input type="password" class="form-control" name="password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title ="Password should be atleast 8 characters long and should contain atleast one uppercase letter,one lowercase letter and a digit" required>
                               <span id='messages'></span>
                               
                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Address</label>
                               
                               <input type="text" class="form-control" name="address" pattern="^[a-zA-Z0-9\s,'-]*$" required>
                        
                           
                           </div><!-- form-group Finish -->
                           
                           <div class="text-center"><!-- text-center Begin -->
                               
                               <button type="submit" name="register" class="btn btn-primary">
                               
                               <i class="fa fa-user-md"></i> Register
                               
                               </button>
                               
                           </div><!-- text-center Finish -->
                           
                       </form><!-- form Finish -->
                       
                   </div><!-- box-header Finish -->
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-9 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    
    
</body>
</html>

<?php 

include('includes/db.php');

if(isset($_POST['register'])){
    
    $cust_fname =mysqli_real_escape_string($con,$_POST['cust_fname']);

    $cust_lname = mysqli_real_escape_string($con,$_POST['cust_lname']);
    
    $email_id = mysqli_real_escape_string($con,$_POST['email_id']);
    
    $phone_no = mysqli_real_escape_string($con,$_POST['phone_no']);
    
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $address = mysqli_real_escape_string($con,$_POST['address']);

   // $c_ip = getRealIpUser();

    #$check_customer= "select * from customers where cust_fname='$cust_fname' LIMIT 1";

    //$resultset_1 = mysqli_query($con,$check_customer);
    
    //$count=mysqli_num_rows($resultset_1);
    //if($count==false){
    //    echo "Change it";
    //}else{
    $insert_customer = "insert into customer (cust_fname,cust_lname,email_id,phone_no,password,address) values('$cust_fname','$cust_lname','$email_id','$phone_no','$password','$address')" ;
    //}
    #$count = mysql_num_rows($resultset_1);

    #if($count == 0)
    #{
        #$insert_customer = "insert into customer (cust_fname,cust_lname,email_id,phone_no,password,address) values('$cust_fname','$cust_lname','$email_id','$phone_no','$password','$address')" ;
      

    #}else{

      # echo "The user is already present in the customer table." ;

    #}
   
    
    $run_customer = mysqli_query($con,$insert_customer);
    echo "<script>alert('You have been Registered Sucessfully')</script>";
        
    echo "<script>window.open('checkout.php','_self')</script>";
        

    //$sel_cart = "select * from cart where ip_add='$c_ip'";
    
    //$run_cart = mysqli_query($con,$sel_cart);
    
    //$check_cart = mysqli_num_rows($run_cart);
    
    //if($check_cart>0){
        
        /// If the person registered has items in the cart ///
        
        //$_SESSION['customer_email']=$c_email;
        
        //echo "<script>alert('You have been Registered Sucessfully')</script>";
        
        //echo "<script>window.open('checkout.php','_self')</script>";
        
    //}else{
        
        /// If the person registered does not have items in the cart ///
        
        //$_SESSION['customer_email']=$c_email;
        
        //echo "<script>alert('You have been Registered Sucessfully')</script>";
        
        //echo "<script>window.open('index.php','_self')</script>";
        
    //}
    
}

?>