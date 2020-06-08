<?php include("auth.php"); ?>
<?php
    	include 'include/global.php';
    	include 'include/function.php';

	if (isset($_GET['action']) && $_GET['action'] == 'index') {
?>

		<script type="text/javascript">

			$('title').html('Login');
			
			function login_selectuser(device_name, sn) {
			
				$("#button_login").attr("href","finspot:FingerspotVer;"+$('#select_scan').val())
				
			}

		</script>
		
		<div class="row">
			<div class="col-md-4">

			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="user_name">Matric Number</label>	
					<select class="form-control" onchange="login_selectuser()" id='select_scan'>
						<option selected disabled="disabled"> -- Select Matric Number -- </option>
							<?php				
								$strSQL = "SELECT a.* FROM user AS a JOIN finger AS b ON a.user_id=b.user_id";
								$result = mysql_query($strSQL);
								
								while($row = mysql_fetch_array($result)){
									
									$value = base64_encode($base_path."verification.php?user_id=".$row['user_id']);
								
									echo "<option value=$value id='option' user_id='".$row['user_id']."' user_name='".$row['user_name']."'>$row[user_name]</option>";
								}				
							?>
					</select>
				</div>
				<a href="" id="button_login" type="submit" class="btn btn-success">Mark</a>
			</div>
			<div class="col-md-4">

			</div>
		</div>

<?php	
	}
?>