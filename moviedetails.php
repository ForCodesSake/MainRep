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
				//fav stuff
				$resFav=mysqli_query($db,"SELECT * from favourites where userid='$currentID' and movieid='$id'");
				$addedToFav=mysqli_num_rows($resFav);
				
				//getComments
				$commentsRaw=mysqli_query($db,"SELECT * from comments where base='$id' order by time");
				$distinctUsers=mysqli_query($db,"Select id,name from users where id in(SELECT DISTINCT author FROM comments where base='$id')");
				$nameArray=array();
				while($rowDiff = mysqli_fetch_array($distinctUsers,MYSQLI_ASSOC)){
					$dictID=$rowDiff['id'];
					$nameArray[$dictID]=$rowDiff['name'];
				}
				//get ratings
				$RatingsRaw=mysqli_query($db,"SELECT userid,rate from votes where movieid='$id' order by rate DESC");
				$votingUsers=mysqli_query($db,"SELECT id,name from users where id in (SELECT userid from votes where movieid = '$id')");
				$votingNameArray=array();
				while($rowVoters = mysqli_fetch_array($votingUsers,MYSQLI_ASSOC)){
					$voterID = $rowVoters['id'];
					$votingNameArray[$voterID]=$rowVoters['name'];
				}
				
				//set Rating
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
	<div class="row">
	<div class="col-sm-6">
	<i><h3 style="margin-top:0;">>>><u>Description</u> : </h3></i>
	</div>
	<div class="col-sm-6" style="text-align:right">
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#VotesModal">Check Votes</button>
    <button type="button" class="btn btn-danger" id="favBtn"><?php echo ($addedToFav==0)?"<i class=\"fa fa-heart\" aria-hidden=\"true\"></i> Add to ":"<i class=\"fa fa-heartbeat\" aria-hidden=\"true\"></i> Remove from "; ?>Favourites</button>
	</div>
	</div>
	<?php echo nl2br(htmlspecialchars($row['description'])) ?>
</div>
</div>

<!-- Votes Modal -->
  <div class="modal fade" id="VotesModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="text-align:center;">Movie Name</h3><br>
		  <h5 style="text-align:center; margin:0;">Overall Rating : 69</h5>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
		  <tr><th>Name</th><th>Rating</th></tr>
<?php
	while($rowVoteData = mysqli_fetch_array($RatingsRaw,MYSQLI_ASSOC)){
		$voterRate=$rowVoteData['rate'];
		$voterUserId=$rowVoteData['userid'];
		$voterName=$votingNameArray[$voterUserId];
?>		  
		  <tr><td><?php echo $voterName; ?></?php></td><td><?php echo $voterRate; ?></?php></td></tr>
<?php
	}
?>		  
		  </table>
        </div>
      </div>
      
    </div>
  </div>

<div id="comments" style="border:2px solid; padding 5px;">

	<h4 style="text-align:center"><b>*** <u>Comments Section</u> ***</b></h4>
	
<?php
	while($rowCOM = mysqli_fetch_array($commentsRaw,MYSQLI_ASSOC)){
		$commentDATA=$rowCOM['comment'];
		$commentTime=$rowCOM['time'];
		$cmntAuthor=$rowCOM['author'];
		$commentName=$nameArray[$cmntAuthor];
?>	
	<div class="well comment">
	<div class="row">
	<div class="col-sm-2 userData" style="font-size:12px; border-right:2px solid;"><?php echo $commentName;?><br><?php echo date('H:i a , d/m/Y',strtotime($commentTime));?></div>
	<div class="col-sm-10 commentData"><?php echo nl2br(htmlspecialchars($commentDATA)); ?></div>
	</div>
	</div>
<?php
	}
?>
	
	<div class="well" id="cmntNOW" style="padding:5px; margin:0;">
	<form class="form-horizontal" autocomplete="off" id="commentForm">	
	<div class="col-sm-10" style="padding:0;">
	<input type="text" class="form-control" id="commentNEW" maxlength="300" pattern="^[A-Za-z0-9].*" title="Start with an Alphabet or Number" placeholder="Comment..." required>
	</div>
	<button type="submit" class="btn btn-success" id="cmntBTN">Comment Now !</button>
	</form>
	</div>

</div>
	
<?php 
	}
	include 'templates/base2.php'; 
?>
<script>
$('#favBtn').click(function(){
		$.post("movieDetailsHelper.php",{set:1,favMovId:<?php echo $id;?>},  
		function(result){
			window.location.reload(true);
		});	
});

$('#commentForm').submit(function(e){
	e.preventDefault();
	var comment=$('#commentNEW').val();
	$.post("movieDetailsHelper.php", { set:2,newCom: comment,baseMovId:<?php echo $id;?>},  
		function(result){
			$('#commentNEW').val('');
			window.location.reload(true);			
		});
});
</script>
	</body>
</html>