	<!DOCTYPE html>
<html lang="en">
	<head>
	<?php 
	include 'templates/commonHead.php'; 
	include('config.php');
	
	/* Get all movies*/
	$currUser=$_SESSION['id'];
	$sql = "SELECT * FROM movies where id in (SELECT movieid from favourites where userid='$currUser')";    $result = mysqli_query($db, $sql);	
	mysqli_close($db);
?>
	<title>F.W.R. | Favourites</title>
		
    <!-- Custom styles for this template -->
	<link href="css/recentadditions.css" rel="stylesheet" />
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
    <h1 class="page-header">Favourites / WishList <3 Awww...</h1>
  		
	<div class="wrapper">
	<div class="col-sm-12">
	<div class="row">

<?php 
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$currMovId= $row['id'];
		$getmovie = $row['name'];
		$getTime = $row['time'];
		$getTrailer=$row['trailer'];
		$YTid=substr($getTrailer,-11);
		$YTthumbnail="http://img.youtube.com/vi/".$YTid."/mqdefault.jpg";
		$totalRatings=$row['totalrating'];
		$totalVotes=$row['totalvotes'];
		$overallRating=round($totalRatings/$totalVotes,0,PHP_ROUND_HALF_DOWN);
?>
	<div class="col-sm-6">
		<!-- Movie variant -->
			<div class="movieDabba">
			<div class="row" style="margin-bottom:10px;">
				<div class="trailer col-sm-6">
				<img src="<?php echo $YTthumbnail; ?>" class="img-thumbnail">
					<!--<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="<?=$getTrailer ?>" allowfullscreen></iframe>                        
					</div>-->
				</div>
				<div class="movieInfo col-sm-6">
					<a href='moviedetails.php?id=<?php echo $currMovId;?>'><h3 style="margin-top:0;"><b><u><?php echo htmlspecialchars($getmovie) ?> </u></b></h3></a>
					<div class="movieRate">
						<span class="movieRating"><?php echo htmlspecialchars($overallRating) ?></span>
					</div> 
				</div>
			</div>
			<div class="row">
				<div class="well" style="text-align:left; margin:0;padding:0;">
				*Click Name for Trailer & More*<span style="float:right; font-weight:bold;">Time Added : <?php echo date('H:i a , d/m/Y',strtotime($getTime));?></span>
				</div>
			</div>
			</div>
	</div>
<?php
	}
?>		
	</div>
	</div>
	</div>
	
<?php include 'templates/base2.php'; ?>		
	</body>
</html>