<?php
define('TRO_ADS',true);
include('../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$ID = $_POST['ID'];

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

/***********************************google calendar update*************************************/
$sql = "select * from emailBroadcast where ID = :ID";
$db->query($sql);
$db->bind(":ID", $_POST['ID'], PDO::PARAM_STR);
$db->execute();
$row = $db->single();
$eventId = $row['GoogleCalId'];
//$calendarId = 'l4hbkt5cfq6rpktjb6vbtbeot0@group.calendar.google.com';
$calendarId = '98jsrnbpcu6ibjh8f4gice0j5s@group.calendar.google.com';
$title=$_POST['supplierName'];
$details = 'broadcast type: ' . $broadcastType . "\n" . 'server account: ' . $serverAccount;
$satrt = $_POST['broadcastDate'];
list($month, $day, $year) = preg_split('[/]', $satrt);
$start = $year . "-" . $month . "-" . $day . 'T00:00:00';
		
$end =  $_POST['broadcastDate'];
list($month, $day, $year) = preg_split('[/]', $end);
$end = $year . "-" . $month . "-" . ($day+1) . 'T00:00:00';
include('tro-google-calendar-update.php');
/**********************************************************************************************/


$sql = "UPDATE emailBroadcast
            SET CampaignName = :campaignName,
				CampaignSupplier = :supplierID,
				BroadcastType = :broadcastType,
				BroadcastDate = :broadcastDate,
				ServerAccount = :serverAccount,
				Instruction = :instruction
            WHERE ID = :ID";

$db->query($sql);

$db->bind(":ID", $_POST['ID'], PDO::PARAM_STR);
$db->bind(":campaignName", $_POST['campaignName'], PDO::PARAM_STR);
$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
$db->bind(":broadcastDate", $_POST['broadcastDate'], PDO::PARAM_STR);
$db->bind(":broadcastType", $_POST['broadcastType'], PDO::PARAM_STR);
$db->bind(":serverAccount", $_POST['serverAccount'], PDO::PARAM_STR);
$db->bind(":instruction", $_POST['instruction'], PDO::PARAM_STR);

$db->execute();

header("Location:".BASE_URL."emailBroadcast-list.php");
exit;
?>
