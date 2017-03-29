<!DOCTYPE html> 
<html lang="en"> 
  <head> 
  <?php  
  include 'templates/commonHead.php';  
  include('config.php'); 
   
     error_reporting(E_ERROR | E_PARSE);
   
  /* Get fav movies*/
      
	$a=array();
	$arr=array();

$currUser=$_SESSION['id'];
$sql = "SELECT * FROM movies where id in (SELECT movieid from favourites where userid='$currUser') ";    
$result = mysqli_query($db, $sql);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
  $name=$row['name'];
  $all=explode(" ",$name);
  $actual="";
  $i=0;
  while($all[$i]){
  if($all[$i][0]=='(')break;
  $actual.='+'.$all[$i];
  $i++;
  }
  
  $curl= curl_init();
  $url="https://www.tastekid.com/like/".$actual;
    
  curl_setopt($curl, CURLOPT_URL ,$url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER ,true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

  $resultX=curl_exec($curl);
  $movies=array();

  preg_match_all('!<span class="tk-Resource-title">(.*?)<\/span>!',$resultX,$match);
  $movies['name']=$match[1];
  $a=array_merge($a,$match[1]);
  array_push($arr,$name);
}
$a=array_unique($a); 
?> 
  <title>F.W.R. | Reccomendations</title> 
     
    <!-- Custom styles for this template --> 
  <link href="css/recentadditions.css" rel="stylesheet" /> 
   
  </head> 
 
  <body> 
<?php include 'templates/base1.php'; ?> 
     
 <center><h1 class="page-header">Movie You'd Probably Like</h1></center> 
   
  <div class="wrapper"> 
  <div class="col-sm-12"> 
  <div class="row"> 
 
<?php  
	$i=0;
  foreach ($a as $b){ 
     if (in_array($b, $arr)||$i%11==0){
	 }else{
?> 
  <div class="col-sm-6">
  <div style="padding:10px;">  
      <div class="row" style="margin-bottom:10px;"> 
        <a href=<?php echo "link.php?movie=".str_replace(" ","+",$b)?>><center><h4 style="margin-top:0;"><?php echo ($b) ?> </h4></center></a> 
      </div>
  	</div>		
  </div> 
<?php
	 }
	$i++;
  } 
?>     
  </div> 
  </div> 
  </div>
<br/><br/>  
<center><h5 class="page-footer">Click On the Movie For Trailer</h5></center> 
  
<?php include 'templates/base2.php'; ?>
     
  </body> 
</html>