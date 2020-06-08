<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: lecturer_login.php");
exit(); }
?>