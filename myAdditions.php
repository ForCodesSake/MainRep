<!DOCTYPE html>
<html lang="en">
	<head>
	<?php 
	include 'templates/commonHead.php'; 
	include('config.php');
	
	/* Get all movies*/
	if(!isset($_GET['page'])){
		$pagesize=0;	
	}
	else{
		$pagesize=$_GET['page']-1;
		$pagesize*=10;
	}
	
	$currMyAddID=$_SESSION['id'];
	$sql = "SELECT * FROM movies where author='$currMyAddID' ORDER BY time DESC LIMIT 10 OFFSET $pagesize";
    $result = mysqli_query($db, $sql);	
	
	$result2 = mysqli_query($db,"select count(1) FROM movies where author='$currMyAddID'");
	$numrows = mysqli_fetch_array($result2);
	$var=$numrows[0];
	$bgVar=0;
	
	mysqli_close($db);
?>
	<title>F.W.R. | My Additions</title>
		
    <!-- Custom styles for this template -->
	<link href="css/recentadditions.css" rel="stylesheet" />
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
    <h1 class="page-header">My Additions</h1>
  		
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
		$YTthumbnail="http://img.youtube.com/vi/".$YTid."/mqdefault.jpg";$totalRatings=$row['totalrating'];
		$totalVotes=$row['totalvotes'];
		$overallRating=round($totalRatings/$totalVotes,0,PHP_ROUND_HALF_DOWN);
		
		if($bgVar%4==0||$bgVar%4==2) echo '<div class="col-sm-12"></div>';
?>
	<div class="col-sm-6">
	<div style="padding:10px; 
	<?php 
		if($bgVar%4==0||$bgVar%4==3) echo "background:#f3f3f3; border-top:1px solid silver; border-bottom:1px solid silver;"
	?>">
		<!-- Movie variant -->
			<div class="movieDabba">
			<div class="row" style="margin-bottom:10px;">
				<div class="trailer col-sm-6">
					<img src="<?php echo $YTthumbnail; ?>" class="img-thumbnail">
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
	</div>
<?php
	$bgVar++;
	}
?>		
</div>
</div>
</div>

<?php if($var>10) { ?>
<div class="page-footer" style=" clear:both;"> 
<hr>
<h5 align="center"><b><i>Page Navigation</i></b></h5> 
<table align='center'>
<tr>
<?php
	$a=1;
	while($var>0){
?> 
<td align="center" style="font-size:20px; padding:5px;">
<?php if($pagesize/10==$a-1) echo "<b><u>"; ?>
<a href="myAdditions.php?page=<?php echo $a;?>"><?php echo htmlspecialchars($a)?></a>
<?php if($pagesize/10==$a-1)echo "</b></u>";?>
</td>
<?php 
	$var=$var-10;
	$a++;
	}
?> 
<tr>
</table>
</div>
<?php } ?>

<?php include 'templates/base2.php'; ?>		
	</body>
</html>