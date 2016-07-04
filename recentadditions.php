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
	$sql = "SELECT * FROM movies ORDER BY time DESC";
    $result = mysqli_query($db, $sql);
	$distinctUsers=mysqli_query($db,"SELECT DISTINCT id FROM movies");
	$nameArray=array();
	$emailArray=array();
	$rateArray=array();
	while($row = mysqli_fetch_array($distinctUsers,MYSQLI_ASSOC)){
		$currUserID=$row['id'];
		$data=mysqli_fetch_array(mysqli_query($db,"SELECT email,name FROM users where id='$currUserID'"),MYSQLI_ASSOC);
		$nameArray[$currUserID]=$data['name'];
		$emailArray[$currUserID]=$data['email'];
	}
	
	mysqli_close($db);
?>
	<title>F.W.R.</title>
		
    <!-- Custom styles for this template -->
	<link href="css/recentadditions.css" rel="stylesheet" />
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
    <h1 class="page-header">Recent Additions</h1>
  		
	<div class="wrapper">
	<div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <!-- Movie variant with time -->
						<?php 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $getName = $nameArray[$row['id']];
        $getEmail = $emailArray[$row['id']];
		$getmovie = $row['name'];
		$getTime = $row['time'];
		$getTrailer=$row['trailer'];
		$getdesc = $row['description'];
		$rating=$row['rating'];
?>
                            <div class="movie movie--test movie--test--dark movie--test--left">
                                <div class="movie__images">
                                        <iframe class="movie-beta__link" src="<?=$getTrailer ?>" height="180" width="180" allowfullscreen></iframe>
                                    
                                </div>

                                <div class="movie__info">
                                    <a href='movie-page-left.html' class="movie__title"><?php echo htmlspecialchars($getmovie) ?>  </a>
                                    <p class="movie__option"><a href="#"><?php echo htmlspecialchars($getdesc) ?></a></p>
                                    <div class="movie__rate">
                                        <div class="score"></div>
                                        <span class="movie__rating"><?php echo htmlspecialchars($rating) ?>/100</span>
                                    </div>               
                                </div>
                            </div>
						<?php
	}
?>		
							
							
			</div>
			</div>
			</div></div>

<?php include 'templates/base2.php'; ?>		
	</body>
</html>