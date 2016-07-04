
<!DOCTYPE html> 
<html lang="en"> 
  <head> 
<?php include 'templates/commonHead.php';  
 
   if($_SERVER["REQUEST_METHOD"] == "POST") { 
     
    include('config.php'); 
    
    $mvNM = mysqli_real_escape_string($db,$_POST['movieName']); 
    $mvDSC= mysqli_real_escape_string($db,$_POST['description']); 
    $trLNK= mysqli_real_escape_string($db,$_POST['trailerLink']); 
		$a=substr($trLNK,32,43);
		$string1="https://www.youtube.com/embed/";
		$string1=$string1.$a;
		$trLNK=$string1;
    $author= $_SESSION['id']; 
    $mvRT = mysqli_real_escape_string($db,$_POST['rating']); 
    if(!($mvNM==""||$mvDSC==""||$trLNK==""||$mvRT=="")) 
    { 
    $sql = "INSERT INTO movies (name,description,trailer,author,rating) VALUES ('$mvNM','$mvDSC','$trLNK','$author','$mvRT')"; 
    $db->query($sql); 
    $lastID = mysqli_insert_id($db); 
    $sql = "INSERT INTO votes (userid,movieid,rate) VALUES ('$author','$lastID','$mvRT')"; 
    $db->query($sql); 
    mysqli_close($db); 
    } 
  } 
?> 
    <title>F.W.R.</title> 
     
    <!-- Custom styles for this template --> 
  <style> 
  #movieAlert{ 
    float: bottom; 
    width: 50%; 
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
    <h2 style="color:blue; font-family:serif;">* Movie Details *</h2> 
    <br> 
    <form class="form-horizontal" id="addMovieForm" role="form" action="" method="POST"> 
    <div class="form-group"> 
      <label class="control-label col-sm-2">Name :</label> 
      <div class="col-sm-10"> 
      <input type="text" class="form-control" id="movieName" name="movieName" placeholder="What's the name ?" required autofocus> 
      </div> 
    </div> 
    <div class="form-group"> 
      <label class="control-label col-sm-2">Description :</label> 
      <div class="col-sm-10"> 
      <input type="textarea" class="form-control" id="description" name="description" placeholder="Tell Me Something about it..." required autofocus> 
      </div> 
    </div> 
    <div class="form-group"> 
      <label class="control-label col-sm-2">Trailer link :</label> 
      <div class="col-sm-8"> 
      <input type="text" class="form-control" id="trailerLink" name="trailerLink" placeholder="Show me the trailer on Youtube..." required autofocus> 
      </div> 
      <div class="col-sm-2" id="youtubeValid" style="font-size:24px;"></div> 
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
 
    $('#trailerLink').bind("change keyup input", function() { 
 
      var url = $(this).val(); 
      if (ytVidId(url) !== false) { 
        $('#youtubeValid').html('<i class="fa fa-check" aria-hidden="true" style="color:green;"> Valid !</i>'); 
        validYT=1; 
      } else { 
        $('#youtubeValid').html('<i class="fa fa-times" aria-hidden="true" style="color:red;"> Invalid !</i>'); 
        validYT=0; 
      } 
    }); 
    $('#addMovieForm').submit(function(event){ 
      if (validYT==0) { 
        event.preventDefault(); 
      } 
    }) 
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