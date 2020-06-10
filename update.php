<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <?php include('include/head.php')?>
</head>
<body>
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
      <h2 class="text-center">Update User</h2>
    </div>
    <div class="container">
    <div class="row">
    <div class="col-md-4"></div>
    
    <?php 
        include('include/global.php');
        $id =  isset($_GET['id']) ? $_GET['id'] : die("Error Record ID not found");


        $query = "SELECT * FROM users WHERE id ='$id' ";
        $result =  mysql_query($query) ;
        if(!$result){
            die("Query failed");
        }else{
            $row = mysql_fetch_array($result);

            $fullname = $row['fullname'];
            $username = $row['username'];
            $email = $row['email'];
            $department = $row['department'];
            $password = $row['password'];
        }

    ?>

        <?php 
        if($_POST){
            $fullname = $_POST['fullname'];
            $username =  $_POST['username'];
            $email =  $_POST['email'];
            $department =  $_POST['department'];
            $password =  $_POST['password'];

             $query = "UPDATE users SET fullname='".$fullname."', username='" .$username."', email='".$email."', department='".$department."', password='".$password."' WHERE id = '$id' ";
            $result =  mysql_query($query);
            if(!$result){
                die("Query failed");
            }
            header("Location: admin_index.php");
        }
    ?>
    <div class="col-md-4">
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo htmlspecialchars($fullname,ENT_QUOTES); ?>"  required >
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"  class="form-control" value="<?php echo htmlspecialchars($username,ENT_QUOTES); ?>" required />
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text"  name="email" id="email"  class="form-control" value="<?php echo htmlspecialchars($email,ENT_QUOTES); ?>"  required >
      </div>
      <div class="form-group">
        <label for="department"> Department</label>
        <input type="text" name="department" id="department"  class="form-control" value="<?php echo htmlspecialchars($department,ENT_QUOTES); ?>"  required >
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"  class="form-control" value="<?php echo htmlspecialchars($password,ENT_QUOTES); ?>"  required >
      </div>
      <input type="submit" name="submit" value="Update User" class="btn btn-primary">
    </form>
    </div>
    <div class="col-md-4">
    </div>
      </div>
    </div>
</body>
</html>