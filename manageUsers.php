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
	$sql = "SELECT * FROM users";
    $result = mysqli_query($db, $sql);
	mysqli_close($db);
?>
		<title>F.W.R. | Manage Users</title>
		
    <!-- Custom styles for this template -->

	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
	<h1 class="page-header" style="font-family: 'Amaranth'; text-align: center;">Manage Users</h1>
	
	<table class="table table-hover table-condensed">
    <thead>
        <tr>
            <th>Id</th>
            <th>UserName</th>
            <th>Password</th>
            <th>Email</th>
			<th>Name</th>
			<th style="text-align:center;">Admin</th>
			<th style="text-align:center;">DELETE</th>
        </tr>
    </thead>
    <tbody>
<?php 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$getId = $row['id'];
        $getUserName = $row['username'];
        $getPassword = $row['password'];
        $getEmail = $row['email'];
		$getName = $row['name'];
		$getAdmin = $row['admin'];
?>
        <tr>
            <td><?php echo $getId ?></td>
            <td><?php echo $getUserName ?></td>
            <td><?php echo $getPassword ?></td>
            <td><?php echo $getEmail ?></td>
			<td><?php echo $getName ?></td>
			<td style="text-align:center;"><?php echo $getAdmin ?></td>
			<td style="text-align:center;">
			<a href="deleteusers.php?id=<?php echo $getId ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs" role="button"><i class="fa fa-user-times" aria-hidden="true"></i></a>
			</td>
        </tr>
<?php
	}
?>		
    </tbody>
	</table>
	
	<br><br>
	
	<form action='addusers.php' method='post'>
	<table class="table table-bordered">
		<thead>
        <tr>
            <th>UserName</th>
            <th>Password</th>
            <th>Email</th>
			<th>Name</th>
			<th style="text-align:center;">Admin</th>
			<th style="text-align:center;">ADD</th>
        </tr>
		</thead>
		<tbody>
		<tr>
			<td><input type="text" name="addUserName" required></td>
			<td><input type="text" name="addPassword" required></td>
			<td><input type="email" name="addEmail" required></td>
			<td><input type="text" name="addName" required></td>
			<td><input type="number" name="addAdmin" required></td>
			<td><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i></button></td>
		</tr>
		</tbody>
	</table>
	</form>

<?php include 'templates/base2.php'; ?>
	</body>
</html>