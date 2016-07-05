<?php 
if(!($_SERVER["REQUEST_METHOD"] == "POST")){
	header('location:dashboard.php');
	die;
}

include('session.php');
include('config.php');  
$userID = $_SESSION['id'];

if($_POST['set']==1){
	$favMovId=$_POST['favMovId'];
	$resFav=mysqli_query($db,"SELECT * from favourites where userid='$userID' and movieid='$favMovId'");
	if(mysqli_num_rows($resFav)==0)$mainSQL="INSERT into favourites (userid,movieid) values ('$userID','$favMovId')";
	else $mainSQL="DELETE from favourites where userid='$userID' and movieid='$favMovId'";
	$db->query($mainSQL);
	echo "OK";
}  

else if($_POST['set']==2){
	$newCOM=mysqli_real_escape_string($db,$_POST['newCom']);
	$baseMovId=$_POST['baseMovId'];
	$mainSQL="INSERT INTO comments (comment,author,base) values ('$newCOM','$userID','$baseMovId')";
	$db->query($mainSQL);
}

mysqli_close($db);
?>