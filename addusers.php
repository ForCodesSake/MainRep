<?php
	include 'config.php';
	session_start();
	
	if(!$_SESSION['admin']){
		header("location:dashboard.php");
		exit;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	$UserName = mysqli_real_escape_string($db,$_POST['addUserName']);
	$Password = mysqli_real_escape_string($db,$_POST['addPassword']);
	$Email = mysqli_real_escape_string($db,$_POST['addEmail']);
	$Name = mysqli_real_escape_string($db,$_POST['addName']);
	$Admin = mysqli_real_escape_string($db,$_POST['addAdmin']);
	
	$sql = "INSERT INTO users (name,email,username,password,admin)VALUES ('$Name','$Email','$UserName','$Password','$Admin')";
	$db->query($sql);
	}
	
	mysqli_close($db);
	
	header("location: manageusers.php");
?>