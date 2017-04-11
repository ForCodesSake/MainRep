<?php
session_start();
require_once( 'Facebook/autoload.php' );
 
$fb = new Facebook\Facebook([
  'app_id' => '116978748849582',
  'app_secret' => '702a786ad8e9ebecd390eb38b06102ba',
  'default_graph_version' => 'v2.5',
]);
 
$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
 
$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://localhost/myphpfiles/MainRep/callback.php', $permissions);
header("location: ".$loginUrl);
?>