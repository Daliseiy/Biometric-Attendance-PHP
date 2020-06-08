<?php

	function getDevice() {

		$sql 	= 'SELECT * FROM device ORDER BY device_name ASC';
		$result	= mysql_query($sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysql_fetch_array($result)) {

			$arr[$i] = array(
				'device_name'	=> $row['device_name'],
				'sn'		=> $row['sn'],
				'vc'		=> $row['vc'],
				'ac'		=> $row['ac'],
				'vkey'		=> $row['vkey']
			);

			$i++;

		}

		return $arr;

	}
	
	function getDeviceAcSn($vc) {

		$sql 	= "SELECT * FROM device WHERE vc ='".$vc."'";
		$result	= mysql_query($sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysql_fetch_array($result)) {

			$arr[$i] = array(
				'device_name'	=> $row['device_name'],
				'sn'		=> $row['sn'],
				'vc'		=> $row['vc'],
				'ac'		=> $row['ac'],
				'vkey'		=> $row['vkey']
			);

			$i++;

		}

		return $arr;

	}
	
	function getDeviceBySn($sn) {

		$sql 	= "SELECT * FROM device WHERE sn ='".$sn."'";
		$result	= mysql_query($sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysql_fetch_array($result)) {

			$arr[$i] = array(
				'device_name'	=> $row['device_name'],
				'sn'		=> $row['sn'],
				'vc'		=> $row['vc'],
				'ac'		=> $row['ac'],
				'vkey'		=> $row['vkey']
			);

			$i++;

		}

		return $arr;

	}

	function getUser() {

		$sql 	= 'SELECT * FROM user ORDER BY user_name ASC';
		$result	= mysql_query($sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysql_fetch_array($result)) {

			$arr[$i] = array(
				'user_id'	=> $row['user_id'],
				'user_name'	=> $row['user_name'],
				'department' => $row['department'],
				'level' => $row['level']
			);

			$i++;

		}

		return $arr;

	}

	function deviceCheckSn($sn) {

		$sql 	= "SELECT count(sn) as ct FROM device WHERE sn = '".$sn."'";
		$result	= mysql_query($sql);
		$data 	= mysql_fetch_array($result);

		if ($data['ct'] != '0' && $data['ct'] != '') {
			return "sn already exist!";
		} else {
			return 1;
		}

	}

	function checkUserName($user_name) {

		$sql	= "SELECT user_name FROM user WHERE user_name = '".$user_name."'";
		$result	= mysql_query($sql);
		$row	= mysql_num_rows($result);

		if ($row>0) {
			return "Matric Number exist!";
		} else {
			return "1";
		}

	}

	function getUserFinger($user_id) {

		$sql 	= "SELECT * FROM finger WHERE user_id= '".$user_id."' ";
		$result = mysql_query($sql);
		$arr 	= array();
		$i	= 0;

		while($row = mysql_fetch_array($result)) {

			$arr[$i] = array(
				'user_id'	=>$row['user_id'],
				"finger_id"	=>$row['finger_id'],
				"finger_data"	=>$row['finger_data']
				);
			$i++;

		}

		return $arr;

	}
	
	function getLog() {

		$sql 	= 'SELECT * FROM log ORDER BY log_time DESC';
		$result	= mysql_query($sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysql_fetch_array($result)) {

			$arr[$i] = array(
				'log_time'		=> $row['log_time'],
				'user_name'		=> $row['user_name'],
				'data'			=> $row['data']
			);

			$i++;

		}

		return $arr;

	}
	
	function createLog($user_name, $time, $sn) {
		
		$sq1 		= "INSERT INTO log SET user_name='".$user_name."', data='".date('Y-m-d H:i:s', strtotime($time))." (PC Time) | ".$sn." (SN)"."' ";
		$result1	= mysql_query($sq1);
		if ($result1) {
			return 1;				
		} else {
			return "Error insert log data!";
		}
		
	}

?>