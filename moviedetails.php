<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; 
	$id = ( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) ? intval( $_GET['id'] ) : 0;
	if ( $id != 0 ){
		include('config.php');
		
		/* Get the movie*/
		$sql = "SELECT * FROM movies where id = '$id'";
		$result = mysqli_query($db, $sql);
		   if(mysqli_num_rows($result)==0){
				$id=0;
		   }
		   else{
			$row = mysqli_fetch_assoc($result);
			$author=$row['author'];
			$totalRatings=$row['totalrating'];
			$totalVotes=$row['totalvotes'];
			$result=mysqli_fetch_array(mysqli_query($db,"SELECT name from users where id='$author'"));
			$trailerEMBED=$row['trailer'];
			$addedBY = $result[0];
							
			   $currentID=$_SESSION['id'];
			   $myVote=0;

			   if(isset($_POST['rating'])){
					$myVote=$_POST['rating'];
					$sqlAddRate="INSERT into votes (userid,movieid,rate) VALUES ($currentID,$id,$myVote)";
					$db->query($sqlAddRate);
					
					//update current rating
					$totalRatings += $myVote;
					$totalVotes += 1;
					$sqlUpdateRatings="Update movies SET totalrating='$totalRatings',totalvotes='$totalVotes' WHERE id='$id'";
					$db->query($sqlUpdateRatings);
				}else{
					$ratingResult=mysqli_query($db,"SELECT rate from votes where userid='$currentID' AND movieid='$id'");
					if(mysqli_num_rows($ratingResult)!=0){
						$fetchedArr=mysqli_fetch_array($ratingResult);
						$myVote=$fetchedArr[0];
					}
				}
				
				$overallRating=round($totalRatings/$totalVotes,0,PHP_ROUND_HALF_DOWN);
		   }
		   
		mysqli_close($db);		
	}
?>
		<title>F.W.R.</title>
		
    <!-- Custom styles for this template -->
	<style>
	.comment{
		padding:10px;
		margin:0;
	}
	</style>
	
	</head>

	<body>
<?php include 'templates/base1.php'; 
	if($id==0){
		?>
		<h1>"Content you are looking for does not exist...or may have been deleted !"<br>(Quit Snooping Around.)</h1>
		</script>
		<?php
	}
	else{
?>
	<h1 class="page-header" style="margin-bottom:5px;"><?php echo $row['name']; ?></h1>
  		  <div class="well" style="text-align:left; font-weight:bold;">
			Added by : <?php echo $addedBY;?> <span style="float:right;">Time Added : <?php echo date('H:i a , d/m/Y',strtotime($row['time']));?></span>
		  </div>

<div id="movieMain" style="background:#E5E4E2; padding:10px; border-radius:3%;">
<div class="row">
  <div class="col-sm-5 vcenter">
    <div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo $trailerEMBED; ?>" allowfullscreen="1" style="border:1px solid;"></iframe>
	</div>
  </div>
  
  <div class="col-sm-offset-1 col-sm-2 vcenter" style="text-align:center; background:gold; border-radius:50%;">
  <h1 style="font-family:serif; color:blue;">Overall Rating :</h1>
  <h2 style="font-family:comic sans ms;"><?php echo $overallRating; ?></h2>
  </div>
  
  <div class="col-sm-offset-1 col-sm-2 vcenter" style="text-align:center; background:orange; border-radius:50%;">  
  <h1 style="font-family:serif; color:blue;">Your Rating :</h1>
  <?php if($myVote==0) { ?>
  <form method="POST" action="">
  <input type="number" min="1" max="100" class="form-control" id="rating" name="rating" placeholder="1 to 100" required>
  <button type="submit" class="btn btn-success">Submit</button>
  </form>
  <?php } 
  else {
  ?>
  <h2 style="font-family:comic sans ms;"><?php echo $myVote; ?></h2>
  <?php } ?>
  </div>
</div>

<div id="desc" style="font-size:20px; margin-top:10px; padding:5px; background:lightblue;">
	<i><h3 style="margin-top:0;"> <u>Description</u> : </h3></i>
	<?php echo nl2br(htmlspecialchars($row['description'])) ?>
</div>
</div>

<div id="comments">
	<h4 style="text-align:center">Comments Section</h4>
	<div class="well comment">Comment 1</div>
	<div class="well comment">Comment 1</div>
	<div class="well comment">Comment 1</div>
	<div class="well">Comment Now...</div>

</div>
	
<?php 
	}
	include 'templates/base2.php'; 
?>
	</body>
</html>