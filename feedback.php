<!DOCTYPE html>
<html lang="en">
	<head>
<?php 
	include 'templates/commonHead.php'; 
	if(!$_SESSION['admin']){
		header("location:dashboard.php");
		exit;
	}
	
	include('config.php');
	
	/* Get all users*/
	$sql = "SELECT * FROM feedback ORDER BY time DESC";
    $result = mysqli_query($db, $sql);
	
	$distinctUsers=mysqli_query($db,"SELECT DISTINCT id FROM feedback");
	$nameArray=array();
	$emailArray=array();
	while($row = mysqli_fetch_array($distinctUsers,MYSQLI_ASSOC)){
		$currUserID=$row['id'];
		$data=mysqli_fetch_array(mysqli_query($db,"SELECT email,name FROM users where id='$currUserID'"),MYSQLI_ASSOC);
		$nameArray[$currUserID]=$data['name'];
		$emailArray[$currUserID]=$data['email'];
	}
	
	mysqli_close($db);
?>
		<title>F.W.R. | Feedback</title>
		
    <!-- Custom styles for this template -->

	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
	<h1 class="page-header" style="font-family: 'Amaranth'; text-align: center;">Feedback(s)</h1>
	
<?php 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $getName = $nameArray[$row['id']];
        $getEmail = $emailArray[$row['id']];
		$getFeedback = $row['message'];
		$getTime = $row['time'];
?>
	<div class="panel panel-default panel-info">
    <div class="panel-body" style="padding:5px;">
	<table style="width:100%;margin:0px;">
		<tr>
			<td style='text-align:left; font-size:16px;'><?php echo htmlspecialchars($getFeedback) ?></td>
			<td style='text-align:right;'>			
			<a href="deletefeedback.php?id=<?php echo $getTime ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs" role="button">
			Delete&nbsp;<i class="fa fa-times" aria-hidden="true"></i>
			</a>
			</td>
		</tr>
	</table>	</div>
    <div class="panel-footer" style="padding:2px;">
	<table style="width:100%;margin:0px;">
		<tr>
			<td style='text-align:left; width:40%;'><b>Name:</b>&nbsp;<?php echo htmlspecialchars($getName) ?></td>
			<td style='text-align:left; width:40%;'><b>Email:</b>&nbsp;<?php echo htmlspecialchars($getEmail) ?></td>
			<td style='text-align:right; width:20%;'><b>Time:</b>&nbsp;<?php echo date('H:i a d/m/Y',strtotime($getTime));?></td>
		</tr>
	</table>
	</div>
	</div>
<?php
	}
?>		
	
<?php include 'templates/base2.php'; ?>
	</body>
</html>