<?php 
	 include 'include/global.php';      
    
    if (isset($_POST['submit'])) {
        $user_name = $_POST['user_name'];
        $department = $_POST['department'];
        $level = $_POST['level'];

        if (!empty($user_name) && !empty($department) && !empty($level)){
            $sql	= "SELECT user_name FROM user WHERE user_name = '".$user_name."'";
            $result	= mysql_query($sql);
            $row	= mysql_num_rows($result);
            
            if ($row>0) {
?>
                <script type="text/javascript">
                        alert("Matric Number Exist Try again");
                </script>
<?php
            }else {
                if ($level==100 || $level==200 || $level==300 || $level==400 || $level==500 || $level==600){
                    $query = "INSERT INTO  user (user_name,department,level) VALUES('$user_name','$department','$level')";
                    mysql_query($query) or die("Error Inserting into db");
                }else{
                    ?>
                    <script type="text/javascript">
                        alert("Invalid Level. Try again");
                    </script>
<?php
                }
            }
            echo "Success";
        }
    }
?>

<?php include("auth.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <?php include 'include/head.php'; ?>

    
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
					<a class="navbar-brand" href="#">Biometric Attendance</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="#" onclick="load('<?php echo $base_path?>')">Add</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>user.php?action=index')">Student</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>login.php?action=index')">Mark</a></li>
						<li><a href="#" onclick="load('<?php echo $base_path?>log.php?action=index')">Log</a></li>
                        <li><a href="logout.php">Logout</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav> 
        <div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="content">
                    <div class="row">
                        <div class="container ">
                        <div class="col-md-4">
                            <form  method="post">
                                <div class="form-group">
                                    <label for="user_name">Matric Number</label>
                                    <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter Matric Number">
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" id="department" name="department"  id="department" class="form-control" placeholder="Enter Department">
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="number" id="level"  name="level"  id="level" class="form-control" placeholder="Level of Study">
                                </div>
                                <input type="submit" class="btn btn-success" value="Add" name="submit" />
                            </form>
                            </div>
                        </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
