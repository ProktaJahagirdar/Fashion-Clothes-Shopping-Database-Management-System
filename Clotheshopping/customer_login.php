<?php // session_start();?>

<div class="box"><!-- box Begin -->
    
  <div class="box-header"><!-- box-header Begin -->
      
      <center><!-- center Begin -->
          
          <h1> Login </h1>
          
          <p class="lead"> Already have an account..? </p>
          
         
          
      </center><!-- center Finish -->
      
  </div><!-- box-header Finish -->
   
  <form method="post" action="customer_login.php"><!-- form Begin -->
      
      <div class="form-group"><!-- form-group Begin -->
          
          <label> Email </label>
          
          <input name="email_id" type="text" class="form-control" required>
          
      </div><!-- form-group Finish -->
      
       <div class="form-group"><!-- form-group Begin -->
          
          <label> Password </label>
          
          <input name="password" type="password" class="form-control" required>
          
      </div><!-- form-group Finish -->
      
      <div class="text-center"><!-- text-center Begin -->
          
          <button name="login" value="Login" class="btn btn-primary">
              
              <i class="fa fa-sign-in"></i> Login
              
          </button>
          
      </div><!-- text-center Finish -->     
      
  </form><!-- form Finish -->
   
  <center><!-- center Begin -->
      
     <a href="customer_register.php">
         
         <h3> Dont have account..? Register here </h3>
         
     </a> 
      
  </center><!-- center Finish -->
    
</div><!-- box Finish -->


<?php 

if(isset($_POST['login'])){
    
    $customer_email = mysqli_real_escape_string($con,$_POST['email_id']);
    
    $customer_pass = mysqli_real_escape_string($con,$_POST['password']);
    
    $select_customer = "select * from customer where email_id='$customer_email' AND password='$customer_pass'";

    //print_r($select_customer);
    
    $run_customer = mysqli_query ($con , $select_customer );
    
    $check_customer = mysqli_num_rows($run_customer);

    //$get_ip = getRealIpUser();
    
    //$select_cart = "select * from cart where ip_add='$get_ip'";
    
    //$run_cart = mysqli_query($con,$select_cart);
    
    //$check_cart = mysqli_num_rows($run_cart);
    
    if($check_customer==0){
        
        echo "<script>alert('Your email or password is wrong')</script>";
        
        exit();
        
    }
    
    if($check_customer==1 AND $check_cart==0){
        
        $_SESSION['email_id']=$customer_email;
        $_SESSION['cust_fname']=$customer_email;
        
       echo "<script>alert('You are Logged in')</script>"; 
        
       echo "<script>window.open('order.php','_self')</script>";
        
    }else{
        
        $_SESSION['email_id']=$customer_email;
        $_SESSION['cust_fname']=$customer_email;
        
       echo "<script>alert('You are Logged in')</script>"; 
        
       echo "<script>window.open('order.php','_self')</script>";
        
    }
    
}

?>