<?
define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "SELECT * FROM emailBroadcast WHERE CampaignName=:campaignName";
$db->query($sql);
$db->bind(":campaignName", $_GET['campaignName'], PDO::PARAM_STR);
$db->execute();
$row = $db->single();
$eventId = $row['GoogleCalId'];
/************************Delete google calendar***********************/
//$googleCal = new googleCalendar('8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com');
//$googleCal.delete($googleId);
//$calendarId = 'l4hbkt5cfq6rpktjb6vbtbeot0@group.calendar.google.com';
$calendarId = '98jsrnbpcu6ibjh8f4gice0j5s@group.calendar.google.com';
include('../tro-google-calendar-delete.php');
/*********************************************************************/

$sql = "Delete FROM emailBroadcast WHERE CampaignName=:campaignName";
$db->query($sql);
$db->bind(":campaignName", $_GET['campaignName'], PDO::PARAM_STR);

$db->execute();

?>