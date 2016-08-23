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

/********************************back up to google calendar***********************************/
//pass
//include('base32hex.php');
//$calId = $db -> lastInsertId();
//$calId = Base32Hex::encode($calId);
//print_r($calId);
//$calendarId = '558rp02l805pfl2uj9nu1i5evg@group.calendar.google.com';
$calendarId = '4g4ilt3occ8hdlch7lvresmfpk@group.calendar.google.com';
$title = $_POST['supplierName'];
$details = 'banner type: ' . $_POST['bannerType'] . "\n" . 'ID: ' . $_POST['AdId'];
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

$sql = "INSERT INTO Travelgram (Name,SupplierID,BannerType,StartDate,EndDate,BannerCode,GoogleCalId,AdId) VALUES (:name,:supplierID,:bannerType,:startDate,:endDate,:bannerCode,:googleCalId,:AdId)";
$db->query($sql);

$db->bind(":name", $_POST['name'], PDO::PARAM_STR);
$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
$db->bind(":bannerType", $_POST['bannerType'], PDO::PARAM_STR);
$db->bind(":startDate", $_POST['startDate'], PDO::PARAM_STR);
$db->bind(":endDate", $_POST['endDate'], PDO::PARAM_STR);
$db->bind(":bannerCode", $_POST['bannerCode'], PDO::PARAM_STR);
$db->bind(":googleCalId", $googleCalId, PDO::PARAM_STR);
$db->bind(":AdId", $_POST['AdId'], PDO::PARAM_STR);
$db->execute();


header("Location:".BASE_URL."troTravelgram-list.php");
exit;
?>