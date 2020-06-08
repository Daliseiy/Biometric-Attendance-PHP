<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('include/head.php'); ?>
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
					<a class="navbar-brand" href="admin_index.php">Biometric Attendance - Administrator</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav> 
    <div class="container">
        <?php
        
        include('include/global.php');
        $id =  isset($_GET['id']) ? $_GET['id'] : die("Error Record ID not found");

        $sql = "SELECT fullname, username, email, department, password FROM users WHERE id='".$id."'";
        $result =  mysql_query($sql) or die("Query failed");
        $row = mysql_fetch_array($result);

        $fullname = $row['fullname'];
        $username = $row['username'];
        $email = $row['email'];
        $department = $row['department'];
        $password = $row['password'];


        ?>
        <div class="container">
        <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-6">
        <div class="card">
            <div class="list-group list-group-flush">
            <h2 class="list-group-item">Fullname: <?php echo htmlspecialchars($fullname,ENT_QUOTES); ?> </h2>
            <h2 class="list-group-item">Username:   <?php echo htmlspecialchars($username,ENT_QUOTES); ?> </h2>
            <h2 class="list-group-item">Email:  <?php echo htmlspecialchars($email,ENT_QUOTES); ?> </h2>
            <h2 class="list-group-item" >Department:  <?php echo htmlspecialchars($department,ENT_QUOTES); ?> </h2>
            </div>
        </div>
        </div>
        <div class="col-md-3"> </div>
        </div>   
        </div>
        

    </div>
</body>
</html>