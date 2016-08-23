<?
define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "SELECT * FROM Travelgram WHERE Name=:name";
$db->query($sql);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();
$row = $db->single();
$eventId = $row['GoogleCalId'];
/************************Delete google calendar***********************/
//$googleCal = new googleCalendar('8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com');
//$googleCal.delete($googleId);
//$calendarId = '558rp02l805pfl2uj9nu1i5evg@group.calendar.google.com';
$calendarId = '4g4ilt3occ8hdlch7lvresmfpk@group.calendar.google.com';
include('../tro-google-calendar-delete.php');
/*********************************************************************/

$sql = "Delete FROM Travelgram WHERE Name=:name";
$db->query($sql);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();

?>