<?php

require_once 'vendor/autoload.php';
  
// init configuration
$clientID = '186072748607-2adocaoukr4eoe8gcd4nh9e9aocd9rda.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://compsci.asmsa.org/sewardn/sso/backtest.php';
   
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
  
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  print_r($google_account_info);
  //set session to let you know they are logged in
  //add entry to user db if need
  //redirect to main page

  
  
  } else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?>



