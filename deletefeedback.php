<?php
	include 'config.php';
	session_start();
	
	if(!$_SESSION['admin']){
		header("location:dashboard.php");
		exit;
	}
	
	$deleteID = mysqli_real_escape_string($db,$_GET['id']);

	$sql = "DELETE FROM feedback WHERE time='$deleteID'";
	$db->query($sql);

	mysqli_close($db);
	
	header("location: feedback.php");
?>