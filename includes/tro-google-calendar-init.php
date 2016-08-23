<?php

require_once __DIR__ . '/vendor/autoload.php';
$client_email = 'trocalendar@tro-calendar-1384.iam.gserviceaccount.com';
$private_key = file_get_contents('TRO-Calendar-PrivateKey.p12');
$scopes = array('https://www.googleapis.com/auth/calendar');
$credentials = new Google_Auth_AssertionCredentials(
	$client_email,
	$scopes,
	$private_key

);    


$client = new Google_Client();

$client->setAssertionCredentials($credentials);
if ($client->getAuth()->isAccessTokenExpired()) {
  $client->getAuth()->refreshTokenWithAssertion();
}

?>