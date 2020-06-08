<?php 
    include('include/head.php');
    include('include/global.php');
    if(isset($_POST['submit'])){
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
        <?php
        $keyword = $_POST['search'];
        
        if(!empty($keyword)){
            $sql = "SELECT * FROM users WHERE username='".$keyword."'";
            $result =  mysql_query($sql);
            if(mysql_num_rows($result)> 0){
                while($row = mysql_fetch_array($result)){
                    echo	"<div class='container'"
                    ."<div class='row'>"
                    ."<div class='col-md-12'>"
                        ."<h2 class='text-center'>Match Found</h2>"
						."<table class='table table-bordered table-hover'>"
								."<thead>"
                                    ."<tr>"
										."<th class='col-md'>Full Name</th>"
                                        ."<th class='col-md'>Username</th>"
                                        ."<th class='col-md'>Email</th>"
                                        ."<th class='col-md'>Department</th>"
										
									."</tr>"
								."</thead>"
                                ."<tbody>";
                    echo					"<tr>"
				 					."<td>".$row['fullname']."</td>"
                                     ."<td>".$row['username']."</td>"
                                     ."<td>".$row['email']."</td>"
                                     ."<td>".$row['department']."</td>"
                                     ."</tr>";
        echo
								"</tbody>"
						."</table>"
					."</div>"
                ."</div>"
                ."</div>";
                echo " <br/>Click here to <a href='admin_index.php'>go back.</a>";
            }
            }else {
                echo "<div class='form'>
                <h3>User does not exist.</h3>
                <br/>Click here to <a href='admin_index.php'>go back.</a></div>";
            }
        }
    }
    else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin|Users</title>
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
					<a class="navbar-brand" href="#">Biometric Attendance - Administrator</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav> 
        <div class="container">
        <h2 class="text-center display-3 text-muted text-bold">Users</h2>

        </div>
<div class="row">
<div class="container">
<div class="col-md-4"></div>
<div class="col-md-4"></div>
<div class="col-md-4">
<form  method="post" class="">
    <div class="container">
    <div class="form-group">
    <input type="text" name="search" class="pr-3" placeholder="Search" aria-label="Search">
    <input type="submit" name="submit" value="Search" class="btn btn-success">
    </div>
    </div>
</form>
</div>
</div>
</div>

<div class="container">
<div class="container my-2">
<a class="btn btn-info " href="<?php $base_path ?>registration.php">Create New User +</a>
</div>
<?php
    $sql = "SELECT * FROM `users`";
    $result	= mysql_query($sql) or die("Query failed");
    $arr 	= array();
	$i 	= 0;

	while ($row = mysql_fetch_array($result)) {

		$arr[$i] = array(
            'id'	=> $row['id'],
            'fullname'	=> $row['fullname'],
            'username'		=> $row['username'],
            'email'		=> $row['email'],
            'password'		=> $row['password'],
            'department'		=> $row['department']
		);
		$i++;
    }
    
    
		if (count($arr) > 0) {

			echo	"<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover '>"
								."<thead>"
                                    ."<tr>"
                                        ."<th class='col-md'>id</th>"
										."<th class='col-md'>Full Name</th>"
                                        ."<th class='col-md'>Username</th>"
                                        ."<th class='col-md'>Email</th>"
                                        ."<th class='col-md'>Department</th>"
                                        ."<th class='col-md'>Modify</th>"
										
									."</tr>"
								."</thead>"
								."<tbody>";

			foreach ($arr as $row) {

                echo					"<tr>"
                                    ."<td>".$row['id']."</td>"
				 					."<td>".$row['fullname']."</td>"
                                     ."<td>".$row['username']."</td>"
                                     ."<td>".$row['email']."</td>"
                                     ."<td>".$row['department']."</td>"

                                     ."<td><a  href='".$base_path."read.php?id={$row['id']}'  class='btn btn-warning'>View</a> | "
                                     ."<a  href='".$base_path."update.php?id={$row['id']}'  class='btn btn-primary'>Edit</a> | "
                                     ."<a  href='#' onclick='delete_user({$row['id']})'  class='btn btn-danger'>Delete</a> </td>"
                                    
				 					."</tr>";

			}

			echo
								"</tbody>"
						."</table>"
					."</div>"
				."</div>";

		} else {

			echo 'Log Empty';

		}
    }
?>
</div>
<?php 
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if($action=='deleted'){
        echo "<div class='alert alert-success>Record was deleted</div>'";
    }
?>

<script type="text/javascript">
    function delete_user(id){
        var answer = confirm("Are you sure ? ");
        if(answer){
            window.location = 'delete.php?id=' + id;
        }
    }
</script>
</body>
</html>
