<?
define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "SELECT * FROM TROC WHERE Name=:name";
$db->query($sql);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();
$row = $db->single();
$eventId = $row['GoogleCalId'];
/************************Delete google calendar***********************/
//$googleCal = new googleCalendar('8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com');
//$googleCal.delete($googleId);
//$calendarId = '04c9q7jjvihsp1o5rt5u6d2jm4@group.calendar.google.com';
$calendarId = 'gdpfiud0dh0td5f082hmni0424@group.calendar.google.com';
include('../tro-google-calendar-delete.php');
/*********************************************************************/

$sql = "Delete FROM TROC WHERE Name=:name";
$db->query($sql);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();

?>