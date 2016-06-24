<?php 
if(!($_SERVER["REQUEST_METHOD"] == "POST")){
	echo 0;
	header('location:dashboard.php');
	die;
}

include('session.php');
include('config.php');  

	$newUsername=mysqli_real_escape_string($db,$_POST['newUsername']);
	$currId=mysqli_real_escape_string($db,$_SESSION['id']);
	/* Check UserName Availability */
		$count = mysqli_num_rows(mysqli_query($db,"SELECT id FROM users WHERE username = '$newUsername' and id!='$currId'"));
		if($count==0){
			echo 1;
		}
		else{
			echo 0;
		}

mysqli_close($db);
?>