<?php 

    $active='Account';
    include("includes/header.php");

?>


<div class="box"><!-- box Begin -->
    
  <div class="box-header"><!-- box-header Begin -->
      
      <center><!-- center Begin -->
          
          <h1> Login </h1>
          
          
      </center><!-- center Finish -->
      
  </div><!-- box-header Finish -->
   
  <form method="post" action="checkout.php"><!-- form Begin -->
      
      <div class="form-group"><!-- form-group Begin -->
          
          <label> Email </label>
          
          <input name="admin_email" type="text" class="form-control" required>
          
      </div><!-- form-group Finish -->
      
       <div class="form-group"><!-- form-group Begin -->
          
          <label> Password </label>
          
          <input name="admin_password" type="password" class="form-control" required>
          
      </div><!-- form-group Finish -->
      
      <div class="text-center"><!-- text-center Begin -->
          
          <button name="login" value="Login" class="btn btn-primary">
              
              <i class="fa fa-sign-in"></i> Login
              
          </button>
          
      </div><!-- text-center Finish -->     
    </form>
      
  
    
</div><!-- box Finish -->


<?php 

if(isset($_POST['login'])){
    
    $admin_email = $_POST['admin_email'];
    
    $admin_pass = $_POST['admin_password'];
    
    $select_admin = "select * from admin where admin_email='$admin_email' AND admin_password='$admin_pass'";

    //print_r($select_customer);
    
    $run_admin = mysqli_query ($con , $select_admin );
    
    $check_admin = mysqli_num_rows($run_admin);

    //$get_ip = getRealIpUser();
    
    //$select_cart = "select * from cart where ip_add='$get_ip'";
    
    //$run_cart = mysqli_query($con,$select_cart);
    
    //$check_cart = mysqli_num_rows($run_cart);
    
    if($check_admin==0){
        
        echo "<script>alert('Your email or password is wrong')</script>";
        
        //exit();
        
    }
    
    if($check_admin>0){
        
        //$_SESSION['admin_email']=$admin_email;
        
       echo "<script>alert('You are Logged in')</script>"; 
        
       echo "<script>window.open('admin_home.php')</script>";
        
    }else{
        exit();
    }
    
}

?>