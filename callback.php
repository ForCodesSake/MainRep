<?php

session_start();
require_once( 'Facebook/autoload.php' );

include 'config.php';
$fb = new Facebook\Facebook([
  'app_id' => '116978748849582',
  'app_secret' => '702a786ad8e9ebecd390eb38b06102ba',
  'default_graph_version' => 'v2.5',
]);  
  
$helper = $fb->getRedirectLoginHelper();  
  
try {  
  $accessToken = $helper->getAccessToken();  
} catch(Facebook\Exceptions\FacebookResponseException $e) {  
  // When Graph returns an error  
  
  echo 'Graph returned an error: ' . $e->getMessage();  
  exit;  
} catch(Facebook\Exceptions\FacebookSDKException $e) {  
  // When validation fails or other local issues  
 
  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
  exit;  
}  
 
 
try {
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
//  print_r($response);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'ERROR: Graph ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'ERROR: validation fails ' . $e->getMessage();
  exit;
}
$me = $response->getGraphUser();
//print_r($me);
$fbname=$me->getProperty('name');
$fbfirst=$me->getProperty('first_name');
$fblast=$me->getProperty('last_name');
$fbemail=$me->getProperty('email');
$parts = explode('@', $fbemail);
$email2 = $parts[0];
$sql = "INSERT INTO users (name,email,username,password)VALUES ('$fbname','$fbemail','$email2','$email2')";
	$db->query($sql);
 $_SESSION['login_user'] = $email2;
  header("location: dashboard.php");
?>