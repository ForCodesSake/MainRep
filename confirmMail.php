<?php

include('config.php');

if(!isset($_GET['code']))$_GET['code']=0;
$code=mysqli_real_escape_string($db,$_GET['code']);

$sql = "SELECT * FROM waiting WHERE code = '$code'";
$result = mysqli_query($db, $sql);
$count = mysqli_num_rows($result);
if($count==1){
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	$Cname=mysqli_real_escape_string($db,$row['name']);
	$Cemail=mysqli_real_escape_string($db,$row['email']);
	$Cusername=mysqli_real_escape_string($db,$row['username']);
	$Cpassword=mysqli_real_escape_string($db,$row['password']);
	$Cadmin=mysqli_real_escape_string($db,$row['admin']);
	
	$db->query("INSERT INTO users (name,email,username,password,admin) VALUES ('$Cname','$Cemail','$Cusername','$Cpassword','$Cadmin')");
	$db->query("DELETE FROM waiting WHERE code='$code'");
	
	mysqli_close($db);
	echo "<h1 style='text-align:center;'>Confirmation Successful.Registration Complete!<br>Account Activated.<br>Head on to the login page -> <br> <a href='login.php'>LOGIN</a></h1>";
}
else{
	mysqli_close($db);
	echo "<h1 style='text-align:center;'>Cannot identify Confirmation Code...<br><br>You may have already been registered; <br> If not, Please register and STOP FOOLING AROUND !</h1>";
}
?>