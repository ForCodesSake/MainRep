<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; 
include('config.php'); 
  /* Get all movies*/ 
  $sql = "SELECT * FROM movies WHERE time>= DATE(NOW()) - INTERVAL 7 DAY ORDER BY (totalrating/totalvotes) DESC LIMIT 5";
  $sql3= "SELECT * FROM movies ORDER BY time DESC LIMIT 5";
	$result3 = mysqli_query($db, $sql3);
    $result = mysqli_query($db, $sql);	
  mysqli_close($db); 
?>
		<title>F.W.R.</title>
		
    <link href="css/recentadditions.css" rel="stylesheet" /> 
	
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
		
<div class="col-xs-6">
<h2 class="sub-header">This Week's Top 5</h2>
<div class="table-responsive">   
<table class="table table-striped">                
<tbody>
<?php  
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC) ){ 
	$currMovId= $row['id'];	
    $getmovie = $row['name']; 
	$getTime = $row['time']; 
	$getTrailer=$row['trailer'];
    $YTid=substr($getTrailer,-11);
	$YTthumbnail="http://img.youtube.com/vi/".$YTid."/mqdefault.jpg";$totalRatings=$row['totalrating']; 
	$totalVotes=$row['totalvotes']; 
	$overallRating=round($totalRatings/$totalVotes,0,PHP_ROUND_HALF_DOWN);
?>
<tr>
<td>
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
  </td>
  </tr>
<?php 
  } 
?>
</tbody>
</table>
</div>
</div>

<div class="col-xs-6">
<h2 class="sub-header">Recently Added</h2>
<div class="table-responsive">   
<table class="table table-striped">	
<?php  
  while($row = mysqli_fetch_array($result3,MYSQLI_ASSOC) ){ 
	$currMovId= $row['id'];	
    $getmovie = $row['name']; 
	$getTime = $row['time']; 
	$getTrailer=$row['trailer'];
    $YTid=substr($getTrailer,-11);
	$YTthumbnail="http://img.youtube.com/vi/".$YTid."/mqdefault.jpg";$totalRatings=$row['totalrating']; 
	$totalVotes=$row['totalvotes']; 
	$overallRating=round($totalRatings/$totalVotes,0,PHP_ROUND_HALF_DOWN);
?> 
<tr>
<td>
  
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
  </td>
  </tr>
<?php 
  } 
?>
</table>
</div>
</div>

<?php include 'templates/base2.php'; ?>
	</body>
</html>