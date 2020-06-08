<?php include("auth.php"); ?>
<?php
    	include 'include/global.php';
    	include 'include/function.php';

	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>

		<script type="text/javascript">

			$('title').html('User');

			function user_delete(user_id, user_name) {

				var r = confirm("Delete user "+user_name+" ?");

				if (r == true) {

					push('user.php?action=delete&user_id='+user_id);

				}
			}
			
			function user_register(user_id, user_name) {
				
				$('body').ajaxMask();
			
				regStats = 0;
				regCt = -1;
				try
				{
					timer_register.stop();
				}
				catch(err)	
				{
					console.log('Registration timer has been init');
				}
				
				
				var limit = 4;
				var ct = 1;
				var timeout = 5000;
				
				timer_register = $.timer(timeout, function() {					
					console.log("'"+user_name+"' registration checking...");
					user_checkregister(user_id,$("#user_finger_"+user_id).html());
					if (ct>=limit || regStats==1) 
					{
						timer_register.stop();
						console.log("'"+user_name+"' registration checking end");
						if (ct>=limit && regStats==0)
						{
							alert("'"+user_name+"' registration fail!");
							$('body').ajaxMask({ stop: true });
						}						
						if (regStats==1)
						{
							$("#user_finger_"+user_id).html(regCt);
							alert("'"+user_name+"' registration success!");
							$('body').ajaxMask({ stop: true });
							load('user.php?action=index');
						}
					}
					ct++;
				});
			}
			
			function user_checkregister(user_id, current) {
				$.ajax({
					url			:	"user.php?action=checkreg&user_id="+user_id+"&current="+current,
					type		:	"GET",
					success		:	function(data)
									{
										try
										{
											var res = jQuery.parseJSON(data);	
											if (res.result)
											{
												regStats = 1;
												$.each(res, function(key, value){
													if (key=='current')
													{														
														regCt = value;
													}
												});
											}
										}
										catch(err)
										{
											alert(err.message);
										}
									}
				});
			}

		</script>

		<br>

<?php

		$user = getUser();

		if (count($user) > 0) {

			echo	"<div class='row'>"
					."<div class='col-md-12'>"
						."<table class='table table-bordered table-hover'>"
								."<thead>"
									."<tr>"
										."<th class='col-md-1'>User ID</th>"
										."<th class='col-md-2'>Matric Number</th>"
										."<th class='col-md-4'>Department</th>"
										."<th class='col-md-2'>Level</th>"
										."<th class='col'>Template</th>"
										."<th class='col'>Action</th>"
									."</tr>"
								."</thead>"
								."<tbody>";

			foreach ($user as $row) {

				$finger 			= getUserFinger($row['user_id']);
				$register			= '';
				$verification		= '';
				$url_register		= base64_encode($base_path."register.php?user_id=".$row['user_id']);
				$url_verification	= base64_encode($base_path."verification.php?user_id=".$row['user_id']);

				if (count($finger) == 0) {

					$register = "<a href='finspot:FingerspotReg;$url_register' class='btn btn-xs btn-primary' onclick=\"user_register('".$row['user_id']."','".$row['user_name']."')\">Register</a>";

				} else {
					
					$verification = "<a href='finspot:FingerspotVer;$url_verification' class='btn btn-xs btn-success'>Mark</a>";
					
				}

				echo					"<tr>"
				 					."<td>".$row['user_id']."</td>"
									."<td>".$row['user_name']."</td>"
									."<td>".$row['department']."</td>"
									."<td>".$row['level']."</td>"
				 					."<td><code id='user_finger_".$row['user_id']."'>".count($finger)."</code></td>"
				 					."<td>"
										."<button type='button' class='btn btn-xs btn-danger' onclick=\"user_delete('".$row['user_id']."','".$row['user_name']."')\">Delete</button>"
										."&nbsp"
										."$register"
										."$verification"
									."</td>"
									
				 					."</tr>";

			}

			echo
								"</tbody>"
						."</table>"
					."</div>"
				."</div>";

		} else {

			echo 'No student added';

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'create') {
?>

		<script type="text/javascript">

			$('title').html('Add user');

			function user_store() {

				user_name	= $('#user_name').val();
				push('user.php?action=store&user_name='+user_name);

			}

		</script>

		<div class="row">
			<div class="col-md-4">

			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="user_name">Matric Number</label>
					<input type="text"  id="user_name" class="form-control" placeholder="Enter Matric Number">
				</div>
				<div class="form-group">
					<label for="department">Department</label>
					<input type="text"  name="department"  id="department" class="form-control" placeholder="Enter Department">
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<input type="number"  name="level"  id="level" class="form-control" placeholder="Level of Study">
				</div>
				<a class="btn btn-default" onclick="load('<?php echo $base_path?>user.php?action=index')">Back</a>
				<button type="submit" class="btn btn-success" onclick="user_store()">Save</button>
			</div>
			<div class="col-md-4">

			</div>
		</div>

<?php
	} elseif (isset($_GET['action']) && $_GET['action'] == 'store') {

		$res 		= array();
        		$res['result'] 	= false;

		if ($_GET['user_name'] == '' || !isset($_GET['user_name']) || empty($_GET['user_name'])) {

			$res['user_name'] = "matric number can't empty";

		} elseif (isset($_GET['user_name']) && !empty($_GET['user_name'])) {

			$user_name = checkUserName($_GET['user_name']);

			if ($user_name != 1) {

				$res['user_name'] = $user_name;

			}

		}

		if (count($res) > 1) {

			echo json_encode($res);

		} else {

			$sql 	= "INSERT INTO user (user_name,department,level_study) VALUES (".$_GET['user_name'].",".$_GET['department'].",".$_GET['level'].")";

			$result = mysql_query($sql) or die('Data not inserted');

			if ($result) {

				$res['result']	= true;
				$res['reload'] 	= "user.php?action=index";

			} else {

				$res['server'] = "Error insert data!";

			}

			echo json_encode($res);

		}

	} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {

		$sql1		= "DELETE FROM user WHERE user_id = '".$_GET['user_id']."' ";
		$result1	= mysql_query($sql1);
		
		$sql2 		= "DELETE FROM finger WHERE user_id = '".$_GET['user_id']."' ";
		$result2 	= mysql_query($sql2);

		if ($result1 && $result2) {

			$res['result'] 	= true;
			$res['reload'] 	= "user.php?action=index";

		} else {

			$res['server'] 	= "Error delete data!#".$sql1;

		}

		echo json_encode($res);

	} elseif (isset ($_GET['action']) && $_GET['action'] == 'checkreg') {
		
		$sql1		= "SELECT count(finger_id) as ct FROM finger WHERE user_id=".$_GET['user_id'];
		$result1	= mysql_query($sql1);
		$data1 		= mysql_fetch_array($result1);
		
		if (intval($data1['ct']) > intval($_GET['current'])) {
			$res['result'] = true;			
			$res['current'] = intval($data1['ct']);			
		}
		else
		{
			$res['result'] = false;
		}
		echo json_encode($res);
		
	} else {

		echo "Parameter invalid..";

	}
?>