<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$urlLink = $_POST['reqLink'];
	// $urlLink = "http://www.imdb.com/title/tt1431045/";
	
	include_once("simple_html_dom.php");
	error_reporting(E_ERROR | E_PARSE);
	
	$html = file_get_html($urlLink);
	
	$mvNi = preg_replace('/\s+/',' ',$html->find('.title_wrapper h1', 0)->plaintext);
	$mvN = str_replace("&nbsp;"," ",$mvNi);
	
	$html->find('#titleStoryLine p .nobr', 0)->innertext='';
	$mvD = preg_replace('/\s+/',' ',$html->find('#titleStoryLine p', 0)->plaintext);
	
//	$mvTo = 'http://www.imdb.com'.$html->find('.slate a', 0)->href;
	$imp = str_replace(" ","+",$mvN);
	$url="https://www.youtube.com/results?search_query=".$imp."+Movie+Trailer";
	$html=file_get_html($url);
	$mvTid=substr($html->find('.yt-lockup-title a',0)->href,-11); 
	$mvTe="https://www.youtube.com/embed/".$mvTid;
	$mvT="https://www.youtube.com/watch?v=".$mvTid;	
	//echo $mvN."<br>";
	//echo $mvD."<br>";
	//echo $url."<br>";
	
	//random
	$outArray["msg"]="hi";
	$outArray["link"]=$urlLink;	
	//important
	$outArray[0]=$mvN;
	$outArray[1]=$mvD;
	$outArray[2]=$mvT;
	$outArray[3]=$mvTe;
	
	echo json_encode($outArray);
	$html->clear();
}
else echo "Hi !! Waddya need bru ?";

?>