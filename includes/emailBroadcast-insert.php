<?
define('TRO_ADS',true);
include('../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$campaignName = $_POST['campaignName'];
$broadcastType = $_POST['broadcastType'];
$serverAccount = $_POST['serverAccount'];
$broadcastDate = $_POST['broadcastDate'];
$instruction = $_POST['instruction'];

$supplierName = $_POST['supplierName'];
$suppliers = explode(',',$supplierName);
$supplierID = array();
foreach ($suppliers as $supplier){

	$sql = "select * from supplier where Name = :supplier";
	$db->query($sql);
	$db->bind(":supplier", $supplier, PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	array_push($supplierID,$row['SupplierID']);
}
$supplierID = implode(',',$supplierID);

/********************************back up to google calendar***********************************/
//pass
//include('base32hex.php');
//$calId = $db -> lastInsertId();
//$calId = Base32Hex::encode($calId);
//print_r($calId);
//$calendarId = 'l4hbkt5cfq6rpktjb6vbtbeot0@group.calendar.google.com';
$calendarId = '98jsrnbpcu6ibjh8f4gice0j5s@group.calendar.google.com';
$title = $_POST['supplierName'];
$details = 'broadcast type: ' . $broadcastType . "\n" . 'server account: ' . $serverAccount;
$satrt = $_POST['broadcastDate'];
list($month, $day, $year) = preg_split('[/]', $satrt);
$start = $year . "-" . $month . "-" . $day;
		
$end =  $_POST['broadcastDate'];
list($month, $day, $year) = preg_split('[/]', $end);
$end = $year . "-" . $month . "-" . ($day+1);

include('tro-google-calendar-insert.php');
// google calendar Id
$googleCalId = $event->getId();
/*********************************************************************************************/

$sql = "INSERT INTO emailBroadcast (CampaignName,CampaignSupplier,BroadcastDate,BroadcastType,ServerAccount,Instruction,GoogleCalId) VALUES (:campaignName,:supplierID,:broadcastDate,:broadcastType,:serverAccount,:instruction,:googleCalId)";
$db->query($sql);

$db->bind(":campaignName", $_POST['campaignName'], PDO::PARAM_STR);
$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
$db->bind(":broadcastDate", $_POST['broadcastDate'], PDO::PARAM_STR);
$db->bind(":broadcastType", $_POST['broadcastType'], PDO::PARAM_STR);
$db->bind(":serverAccount", $_POST['serverAccount'], PDO::PARAM_STR);
$db->bind(":instruction", $_POST['instruction'], PDO::PARAM_STR);
$db->bind(":googleCalId", $googleCalId, PDO::PARAM_STR);

$db->execute();


header("Location:".BASE_URL."emailBroadcast-list.php");


?>
