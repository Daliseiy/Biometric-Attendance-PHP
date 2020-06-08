<?php
include('include/global.php');

$id =  isset($_GET['id']) ? $_GET['id'] : die("Error Record ID not found");

$query = "DELETE FROM users WHERE id='$id'";
$result =  mysql_query($query) or die("Unable to execute query");
?>