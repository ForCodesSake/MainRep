 <!DOCTYPE html>
<html lang="en">
	<head>
<?php 
	if(!isset($_GET['query'])){
		header("location:search.php?query=");
		exit;
	}
	include 'templates/commonHead.php';
	include('config.php');
	
	$searchQuery=$_GET['query'];
	
	$searchTerms = explode(' ',$searchQuery);
	$searchTermName = array();
	$searchTermDesc = array();
	foreach ($searchTerms as $term) {
    $term = trim($term);
	$term = mysqli_real_escape_string($db,$term);
    if (!empty($term)) {
		array_push($searchTermName,"lower(name) LIKE lower('%".$term."%')");
		array_push($searchTermDesc,"lower(description) LIKE lower('%".$term."%')");
		}
	}
	$sqlQuery = "SELECT * FROM movies WHERE (".implode(' AND ', $searchTermName).") OR (".implode(' AND ', $searchTermDesc).") order by (totalrating/totalvotes) desc LIMIT 20";
	$result = mysqli_query($db, $sqlQuery);	
	$bgVar=0;

	mysqli_close($db);
?>
	
	<title>F.W.R. | Search</title>
		
    <!-- Custom styles for this template -->
	<link href="css/recentadditions.css" rel="stylesheet" />
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
		<div class="page-header">
		<form method="GET" action="search.php" autocomplete="off">
            <input type="text" class="form-control" name="query" id="query" pattern="^[A-Za-z0-9].*" title="Start with an Alphabet or Number"
			placeholder="&#xF002; Search Movies ( and Descriptions )..."
			value="<?php echo htmlspecialchars($searchQuery); ?>" style="font-family:Arial, FontAwesome; width:100%;"
			required autofocus  onfocus="this.value = this.value;">
        </form>
		</div>
		
	<div class="wrapper">
	<div class="col-sm-12">
	<div class="row">

<?php 
	if(sizeof($searchTermName)==0||mysqli_num_rows($result)==0){
		echo "
		<h3> No Results Found... Try Limiting your Search Query Length ! </h3>
		";
	}
	else
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

		if($bgVar%4==0||$bgVar%4==2) echo '<div class="col-sm-12"></div>';
?>
	<div class="col-sm-6">
	<div style="padding:10px; 
	<?php 
		if($bgVar%4==0||$bgVar%4==3) echo "background:#f7f7f7; border-top:1px solid silver; border-bottom:1px solid silver;"
	?>">
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
	</div>		
<?php
	$bgVar++;
	}
?>		
</div>
</div>
</div>		
   		
<?php include 'templates/base2.php'; ?>
	</body>
</html>		