<?
define('TRO_ADS',true);
include('../../init.php');
//include('../classes/googleCalendar.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "SELECT * FROM booking WHERE CampaignName=:campaignName";
$db->query($sql);
$db->bind(":campaignName", $_GET['campaignName'], PDO::PARAM_STR);
$db->execute();
$row = $db->single();
$eventId = $row['GoogleCalId'];
/************************Delete google calendar***********************/

//$calendarId = '8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com';
$calendarId = 'a8bejd0033t591ho95updb1btk@group.calendar.google.com';
include('../tro-google-calendar-delete.php');
/*********************************************************************/

$sql = "DELETE FROM booking WHERE CampaignName=:campaignName";
$db->query($sql);
$db->bind(":campaignName", $_GET['campaignName'], PDO::PARAM_STR);
$db->execute();
?>