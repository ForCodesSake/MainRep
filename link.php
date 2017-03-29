<!DOCTYPE html> 
<html lang="en"> 
  <head> 
  <?php  
  include 'templates/commonHead.php';  
  include('config.php');
  $video=0;
  $name=$_GET['movie'];
  $curl= curl_init();
  $url="https://www.youtube.com/results?search_query=".str_replace(" ","+",$name)."+movie+official+trailer";

  curl_setopt($curl, CURLOPT_URL ,$url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER ,true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

  $result=curl_exec($curl);

  preg_match_all('!<a href=(.*?) class="yt-uix-tile-link .*? title=.*? dir="ltr">!',$result,$match);
  $a=$match[1];
  $c="";
  foreach ($a as $b){ 
     $c=$b;
	 break;
  }
  $a=$c;
  $video=1;
?> 
  <title>F.W.R. | All Movies</title> 
     
    <!-- Custom styles for this template --> 
  <link href="css/recentadditions.css" rel="stylesheet" /> 
   
  </head> 
 
  <body> 
<?php include 'templates/base1.php'; ?> 
     <center>
 <?php if($video==1){?>
  <div class="col-sm-5 vcenter">
	<center><h1>Trailer for <?php echo $_GET['movie']?></h1></center>
    <div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" width="100%" scrolling="no" height="500" src="<?php echo"https://www.youtube.com/embed/".substr($a,10,strlen($a)-2)?>" allowfullscreen="1" style="border:1px solid;"></iframe>
	</div>
  </div>
   </center>
 <?php }?>
   <br><br><br><br>
   <center><h2 style="color:blue;">To Add <?php echo $_GET['movie']?> ... Trailer Link is Below</h2></center>
   <center><h2><?php echo "https://www.youtube.com".substr($a,1,strlen($a)-2)?></h2></center>
   		
<?php include 'templates/base2.php'; ?>     
  </body> 
</html>