<?php 
require_once 'vendor/autoload.php';
session_start();

//init variables
$clientID = "992258582545-macdim4ud077k5bi9upi2c9ausi72oje.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = 'https://compsci.asmsa.org/stallingsj22/assignment08/index.php';

//create client request to access google api
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

//auth code from Google OAuth flow
if(isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);


//get profile info
$google_oauth = new Google_Service_Oauth2($client);
$google_account_info = $google_oauth->userinfo->get();
$email = $google_account_info->email;
$name = $google_account_info->name;

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;


print_r($google_account_info);


}

else {
    header("Location: ".$client->createAuthURl());
}


?>