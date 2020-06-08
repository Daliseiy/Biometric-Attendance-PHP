<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<?php include 'include/head.php'; ?>
</head>
<body>
<?php
require('db.php');
if (isset($_REQUEST['username'])){
  $full_name = stripslashes($_REQUEST['fullname']);
  $full_name = mysqli_real_escape_string($con,$full_name); 
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con,$password);
  $department = stripslashes($_REQUEST['department']);
  $department = mysqli_real_escape_string($con,$department); 
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (fullname,username, password, email, department, trn_date)
VALUES ('$full_name','$username', '".md5($password)."', '$email','$department' , '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>User has been registered successfully.</h3>
<br/>Click here to <a href='list_users.php'>view all users.</a></div>";
        }else{
          echo 'User creation failed';
        }
    }else{
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Biometric Attendance - Administrator</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav> 
    <div class="container">
    <h1 class="text-center ">Register Users</h1>

    </div>
    <div class="container">
    <div class="row">
  <div class="col-md-4">
      </div>
      <div class="col-md-4">
      <form class="login" action="" method="post">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" placeholder= "Full Name"  required >
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"  class="form-control" placeholder="Username" required />
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text"  name="email" id="email"  class="form-control" placeholder="Email Adress"  required >
      </div>
      <div class="form-group">
        <label for="department"> Department</label>
        <input type="text" name="department" id="department"  class="form-control" placeholder="Department"  required >
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"  class="form-control" placeholder="Password"  required >
      </div>
      <input type="submit" name="submit" value="Create User" class="btn btn-success">
    </form>
      </div>
   
  <div class="col-md-4">
  </div>
</div>
	
    </div>
 
 
<?php } ?>
</body>
</html>