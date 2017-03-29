<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; 

	function convertYoutube($string) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"https://www.youtube.com/embed/$2",
		$string
	);
	}

   if($_SERVER["REQUEST_METHOD"] == "POST") {
		include('config.php');
   
		$mvNM = mysqli_real_escape_string($db,$_POST['movieName']);
		$mvDSC= mysqli_real_escape_string($db,$_POST['description']);
		$trLNK= mysqli_real_escape_string($db,$_POST['trailerLink']);
		$trLNK= convertYoutube($trLNK);
		$author= $_SESSION['id'];
		$mvRT = mysqli_real_escape_string($db,$_POST['rating']);
		if(!($mvNM==""||$mvDSC==""||$trLNK==""||$mvRT=="")){
		$sql = "INSERT INTO movies (name,description,trailer,author,totalrating) VALUES ('$mvNM','$mvDSC','$trLNK','$author','$mvRT')";
		$db->query($sql);
		$lastID = mysqli_insert_id($db);
		$sql = "INSERT INTO votes (userid,movieid,rate) VALUES ('$author','$lastID','$mvRT')";
		$db->query($sql);
		mysqli_close($db);
		}
	}
?>
		<title>F.W.R. | Add Movies</title>
		
    <!-- Custom styles for this template -->
	<style>
	#movieAlert{
	  float: bottom;
	  width: 50%;
	  margin: 0;
	  align-content: center;
	}
	</style>	
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>
	
	<div id="movieAlert" class="alert alert-success fade in" style="display:none;">
				<a href="#" class="close" onclick="$('.alert').hide()">&times;</a>
				<form class="feedback" >Movie Submitted Successfully !</form>
	</div>
		
    <h1 class="page-header">Add Movies</h1>
		  
	<div class="container col-sm-10">
	  <h3 style="color:blue; font-family:serif;">* IMDB Movie-Page Url (eg. <a href="http://www.imdb.com/title/tt1431045/" target="blank">Click Me!</a>) *</h3>
	  <form class="form-horizontal" id="demoForm" role="form" action="" method="POST" autocomplete="off">
		<div class="form-group">
		  <label class="control-label col-sm-2">IMDB link :</label>
		  <div class="col-sm-8">
			<input type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Valid IMDB Movie Page Link...">
		  </div>
		  <div class="col-sm-2" id="imdbValid" style="font-size:24px;"></div>
		</div>
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-2">
			<button type="submit" class="btn btn-success">Fill Automatically !</button>
		  </div>
		  <div class="col-sm-8" id="comm">
		  </div>
		</div>
	  </form>
  	  <h3 style="color:blue; font-family:serif;">Fill/Change Manually</h3>
	  <form class="form-horizontal" id="addMovieForm" role="form" action="" method="POST" autocomplete="off">
		<div class="form-group">
		  <label class="control-label col-sm-2">Name :</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="movieName" name="movieName" pattern="^[A-Za-z0-9].*" title="Start with an Alphabet or Number" placeholder="What's the name ?" required autofocus>
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2">Description :</label>
		  <div class="col-sm-10">
			<textarea rows="5" class="form-control" id="description" name="description" placeholder="Tell Me Something about it..." required autofocus></textarea>
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2">Trailer link :</label>
		  <div class="col-sm-8">
			<input type="text" class="form-control" id="trailerLink" name="trailerLink" placeholder="Show me the trailer on Youtube..." required autofocus>
		  </div>
		  <div class="col-sm-2" id="youtubeValid" style="font-size:24px;"></div>
		  <div class="col-sm-offset-2 col-sm-6" id="mvTrailer"></div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2">Rating(%) :</label>
		  <div class="col-sm-2">
			<input type="number" min="1" max="100" class="form-control" id="rating" name="rating" placeholder="1 to 100" required autofocus>
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-success">Submit</button>
		  </div>
		</div>
	  </form>
	</div>
	
<?php include 'templates/base2.php'; ?>
	
	<script>
		var validYT=0;
		function ytVidId(url) {
			var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
			return (url.match(p)) ? RegExp.$1 : false;
		}

		$('#trailerLink').bind("change keyup input",myFunc);
		function myFunc(){
			var url = $('#trailerLink').val();
			if (ytVidId(url) !== false) {
				$('#youtubeValid').html('<i class="fa fa-check" aria-hidden="true" style="color:green;"> Valid !</i>');
				validYT=1;
			} else {
				$('#youtubeValid').html('<i class="fa fa-times" aria-hidden="true" style="color:red;"> Invalid !</i>');
				validYT=0;
			}
		};
		$('#addMovieForm').submit(function(event){
			if (validYT==0) {
				event.preventDefault();
				alert('Invalid Youtube Link !');
			}
		})
	</script>
	<script>
		var validDC=0;
		function imdbId(url) {
			var p = /^(?:https?:\/\/)?(?:www\.)?imdb\.com\/title\/(?=((\w){9}))(?:\S+)?$/;
			return (url.match(p)) ? RegExp.$1 : false;
		}

		$('#demoLink').bind("change keyup input", function() {
			var url = $(this).val();
			if (imdbId(url) !== false) {
				$('#imdbValid').html('<i class="fa fa-check" aria-hidden="true" style="color:green;"> Valid !</i>');
				validDC=1;
			} else {
				$('#imdbValid').html('<i class="fa fa-times" aria-hidden="true" style="color:red;"> Invalid !</i>');
				validDC=0;
			}
		});
	</script>
<script type="text/javascript">
		$(document).ready(function()
		{	
			$(document).on('submit', '#demoForm', function()
			{
				if(validDC){
				$('#comm').html("<h5 style='color:darkblue;'>Please Wait ! Magic Stuff Happening in the Background * Abra Ka Dabra *</h5>");

				var urlKey = "http://www.imdb.com/title/"+imdbId($('#demoLink').val());
				var data = "reqLink = "+urlKey;

				//call scraper
				$.post("iScy.php",{reqLink:urlKey},
					function(data){
					var data_array = $.parseJSON(data);
					showData(data_array);
				});
				}
				else{
					$('#comm').html("");
				}				
				return false;
			});
		});
		
	function showData(arr){
		$('#movieName').val(arr[0]);		
		$('#description').val(arr[1]);
		var tBox = "<div class=\"embed-responsive embed-responsive-16by9\"><iframe class=\"embed-responsive-item\" src=\"" 
					+arr[3]+
					"\" allowfullscreen=\"1\" style=\"border:1px solid;\"></iframe></div>";
		$('#mvTrailer').html(tBox);
		$('#trailerLink').val(arr[2]);
		myFunc();
		$('#comm').html("<h4 style='color:darkgreen;'><i class=\"fa fa-check\" aria-hidden=\"true\" style=\"color:green;\"> Done ! </h4>");
	}	
</script>
<?php	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		?><script>
		$("#movieAlert").show();
		window.setTimeout(function(){$("#movieAlert").hide(1500);},3000);
		</script><?php
	}
?>
	
	</body>
</html>