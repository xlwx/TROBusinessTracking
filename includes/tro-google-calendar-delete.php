<?php
/*	
	$calendarId
	$eventId
	
*/

/*
//require_once realpath(dirname(__FILE__).'/google-api-php-client/src/Google/autoload.php');
require_once __DIR__ . '/vendor/autoload.php';
//require_once '../vendor/autoload.php';
//$calendarId = '8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com';
$client_email = 'tro-calendar@tro-calendar.iam.gserviceaccount.com';
$private_key = file_get_contents('../TRO-Calendar-PrivateKey.p12');
$scopes = array('https://www.googleapis.com/auth/calendar');
$credentials = new Google_Auth_AssertionCredentials(
	$client_email,
	$scopes,
	$private_key

);    


$client = new Google_Client();
//$client->setCache(new Google_Cache_File('/home/httpd/www/dev.travelresearchonline.com/public_html/tmp'));

$client->setAssertionCredentials($credentials);
if ($client->getAuth()->isAccessTokenExpired()) {
  $client->getAuth()->refreshTokenWithAssertion();
}

*/

include('tro-google-calendar-init.php');
$service = new Google_Service_Calendar($client);

$service->events->delete($calendarId, $eventId);


?>