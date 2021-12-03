<html>
<head>
     <title>User Login</title>
     <link rel="stylesheet" type="text/css" href="style2loginregister.css">
     <link  rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
      <div class=login-box>
        
           <div class=" login-center">
             <h2>Login</h2>
             <form action="validation.php" method="post">
                <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_id" class="form-control" required>
                </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"  required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
             </form>
             <center><!-- center Begin -->
                <a href="register.php">
                   <h7> Dont have account..? Register here </h7>
                </a>
             </center><!-- center Finish -->
           </div>
      </div>
    </div>
</body>
</html>