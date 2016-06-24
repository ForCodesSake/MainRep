<?php
include('session.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
 include('config.php');	
 $feedback = mysqli_real_escape_string($db,$_POST['tamsg']);
 if($feedback=='')die;
 $fbUserID = $_SESSION['id'];

	$sql = "INSERT INTO `feedback` (`id`, `message`) VALUES ('$fbUserID','$feedback');";
	$db->query($sql);
mysqli_close($db);	
}
else header('location:dashboard.php');
?>