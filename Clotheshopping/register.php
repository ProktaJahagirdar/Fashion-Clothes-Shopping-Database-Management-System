<html>
<head>
     <title>User Registration</title>
     <link rel="stylesheet" type="text/css" href="style2loginregister.css">
     <link  rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
      <div class="register-box">
       
           <div class="register-center">
             <h2>Register Here</h2>
             <form action="registeration.php" method="post">
                <div class="form-group">
                <label>First name</label>
                <input type="text" name="cust_fname" class="form-control" pattern="^[a-zA-Z]*$" title="The name should consist of alphabets only and no spaces in between" required>
                </div>
                <div class="form-group">
                <label>Last name</label>
                <input type="text" name="cust_lname" class="form-control" pattern="^[a-zA-Z]*$" title="The name should consist of alphabets only and no spaces in between" required>
                </div>
                <div class="form-group">
                <label>Email ID</label>
                <input type="email" name="email_id" class="form-control"  required>
                </div>
                <div class="form-group">
                <label>Mobile number</label>
                <input type="text" name="phone_no" class="form-control" pattern="^\d{10}$" title="Mobile number should consist only 10 digits." required>
                </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title ="Password should be atleast 8 characters long and should contain atleast one uppercase letter,one lowercase letter and a digit" required>
                </div>
                <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" pattern="^[a-zA-Z0-9\s,'-]*$" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
             </form>
           </div>
        
      </div>
    </div>
</body>
</html>