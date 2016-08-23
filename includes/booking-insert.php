<?
define('TRO_ADS',true);
include('../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

//supplierID
$sql = "select * from supplier where Name = :supplierName";
$db->query($sql);
$db->bind(":supplierName", $_POST['supplierName'], PDO::PARAM_STR);
$db->execute();
$row=$db->single();
$supplierID = $row['SupplierID'];

//inventory ID
$inventoryType = $_POST['inventoryType'];
if($inventoryType == 'bannerAds'){
	$sql = "select * from bannerAds where Name = :inventoryUnit_ba";
	$db->query($sql);
	$db->bind(":inventoryUnit_ba", $_POST['inventoryUnit_ba'], PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();
	$inventoryID = $row['BannerID'];
	$unit = $_POST['inventoryUnit_ba'];
}else{
	$sql = "select * from articles where Name = :inventoryUnit_sa";
	$db->query($sql);
	$db->bind(":inventoryUnit_sa", $_POST['inventoryUnit_sa'], PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();
	$inventoryID = $row['ID'];
	$unit = $_POST['inventoryUnit_sa'];
}

/********************************back up to google calendar***********************************/

//$calendarId = '8l2dj5ierr04er1uj8tos3lppo@group.calendar.google.com';
$calendarId = 'a8bejd0033t591ho95updb1btk@group.calendar.google.com';

$title = $_POST['supplierName'];
$details = 'type: ' . $inventoryType ."\n" . 'unit: ' . $unit . "\n" . 'size: ' . $_POST['size'] . "\n" . 'ID: ' . $_POST['AdId'] . "\n" . 'Website: ' . $_POST['website'];
$satrt = $_POST['startDate'];
list($month, $day, $year) = preg_split('[/]', $satrt);
$start = $year . "-" . $month . "-" . $day;
		
$end =  $_POST['endDate'];
list($month, $day, $year) = preg_split('[/]', $end);
$end = $year . "-" . $month . "-" . ($day+1);

include('tro-google-calendar-insert.php');
// google calendar Id
$googleCalId = $event->getId();
/*********************************************************************************************/

//salesMember ID
$sql = "select * from salesTeam where FirstName = :salesMember";
$db->query($sql);
$db->bind(":salesMember", $_POST['salesMember'], PDO::PARAM_STR);
$db->execute();
$row=$db->single();
$salesMemberID = $row['ID'];


$sql = "INSERT INTO booking (CampaignName,SupplierID,InventoryType,InventoryID,StartDate,EndDate,SalesMemberID,GoogleCalId,Size,AdId,Website) VALUES (:campaignName,:supplierID,:inventoryType,:inventoryID,:startDate,:endDate,:salesMemberID,:googleCalId,:size,:adId,:website)";
$db->query($sql);

$db->bind(":campaignName", $_POST['campaignName'], PDO::PARAM_STR);
$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
$db->bind(":inventoryType", $_POST['inventoryType'], PDO::PARAM_STR);
$db->bind(":inventoryID", $inventoryID, PDO::PARAM_STR);
$db->bind(":startDate", $_POST['startDate'], PDO::PARAM_STR);
$db->bind(":endDate", $_POST['endDate'], PDO::PARAM_STR);
$db->bind(":salesMemberID", $salesMemberID, PDO::PARAM_STR);
$db->bind(":googleCalId", $googleCalId, PDO::PARAM_STR);
$db->bind(":size", $_POST['size'], PDO::PARAM_STR);
$db->bind(":adId", $_POST['AdId'], PDO::PARAM_STR);
$db->bind(":website", $_POST['website'], PDO::PARAM_STR);
$db->execute();

header("Location:".BASE_URL."booking-list.php");
exit;
?>