# Using Google Calendar api for TRO Ads system

## Useful Links
1.[Setup](https://developers.google.com/api-client-library/php/start/get_started)

2.[Sample](https://developers.google.com/api-client-library/php/auth/service-accounts)

3.[Blog](https://mytechscraps.wordpress.com/2014/05/15/accessing-google-calendar-using-the-php-api/)

## Setup 
1.[sign up](https://accounts.google.com/ServiceLogin?sacu=1&continue=https%3A%2F%2Fwww.google.com%2F%3Fgws_rd%3Dssl&hl=en#identifier) the TRO google account
### usr: tro2016calendar@gmail.com
### psw: trotrotro

2.Create a project in [Google Developers Console](https://console.developers.google.com/apis/dashboard?project=tro-calendar&duration=PT1H), enable google calendar api in api manager.

3.[Install the library](https://developers.google.com/api-client-library/php/start/installation)(already installed in the server)

## Create a Service Account
In (Google Developer Console)(https://console.developers.google.com/apis/credentials?project=tro-calendar) select your project, then ‘API’s & Auth’, then ‘Credentials’, then ‘Create New Client ID’ and choose ‘Service Account’.  You will be prompted to save the private key for the id. Make sure you do save it since it can’t be downloaded later (although you can generate new keys).

## Share the calendar
Log in to the Calendar using the normal web GUI. Locate the calendar on the left panel under ‘My Calendars’, hover over it to reveal the dropdown arrow, then select ‘Share this Calendar’.  Under the ‘Share with specific people’ section, enter the Email Address from the previous step and check it has enough access for your intended use.

## sample code
<?php
/*	
	$calendarId
	$title
	$details
	$start
	$end
	
*/

//require_once realpath(dirname(__FILE__).'/google-api-php-client/src/Google/autoload.php');
require_once __DIR__ . '/vendor/autoload.php';

//$calendarId = '8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com';
$client_email = 'tro-calendar@tro-calendar.iam.gserviceaccount.com';
$private_key = file_get_contents('TRO-Calendar-PrivateKey.p12');
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

$service = new Google_Service_Calendar($client);
$event = new Google_Service_Calendar_Event(array(
  //'id' => $calId;
  'summary' => $title,
  'description' => $details,
  'start' => array(
    'date' => $start
  ),
  'end' => array(
    'date' => $end
  ),
  
));

$event = $service->events->insert($calendarId, $event);

?>