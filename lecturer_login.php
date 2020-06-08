<html>
<head>
<meta charset="utf-8">
<title>Login </title>
<?php include 'include/head.php'; ?>
</head>
<body>
<?php
require('db.php');
session_start();
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: index.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='lecturer_login.php'>Login</a></div>";
	}
    }else{
?>
    <h1 class="text-center">Login </h1>
<div class="row">
<div class="col-md-4">
</div>
<div class="container col-md-4">
<form class="login" action="" method="post" name="login">
	<div class="form-group">
	<label for="username">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
	</div>
	<div class="form-group">
	<label for="password">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
	</div>
    <input type="submit" value="Login" name="submit" class="btn btn-primary">
  </form>
</div>
<div class="col-md-4">
</div>
</div>

 
<?php } ?>
</body>
</html>