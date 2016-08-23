<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$update = INCLUDES_URL.'/emailBroadcast-update.php';

//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
$addStyleSheet[] = templateAddStyleSheet("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/bootstrap-datepicker.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/fullcalendar.css");
//$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/fullcalendar.print.css");
$addScript[] = templateAddScript("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js");
$addScript[] = templateAddScript(JS_URL."/bootstrap-datepicker.min.js");
$addScript[] = templateAddScript(JS_URL."/moment.min.js");
$addScript[] = templateAddScript(JS_URL."/fullcalendar.min.js");
$addScript[] = templateAddScript(JS_URL."/emailBroadcast-validation.js");

$pageTitle = "Email Broadcast Edit";
include('templates/header.php');
?>
	
<?
	$db->query("select * from emailBroadcast where CampaignName = :campaignName");
	$db->bind(":campaignName", $_GET['campaignName'], PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	
	
	//ID
	$ID = $row['ID'];	
	//Campaign Name
	$campaignName = $row['CampaignName'];
	//Supplier Name
	$supplierIDs = $row['CampaignSupplier'];
	$suppliers = explode(',',$supplierIDs);
	$supplierName = array();
	foreach ($suppliers as $supplier){
		$sql_name = "select * from supplier where SupplierID = :supplier";
		$db->query($sql_name);
		$db->bind(":supplier", $supplier, PDO::PARAM_STR);
		$db->execute();
		$row_name = $db->single();
		array_push($supplierName,$row_name['Name']);
	}
	$supplierName = implode(',',$supplierName);
	//Broadcast Type
	$broadcastType = $row['BroadcastType'];
	//Server Account
	$serverAccount = $row['ServerAccount'];
	//Broadcast Date
	$broadcastDate = $row['BroadcastDate'];
	//Instruction
	$instruction = $row['Instruction'];
	
	$action = $update;
	$edit = 'emailBroadcast-edit.php';
	$getBookingInfo = 'emailBroadcast-getBookingInfo.php';
	$getDate = 'emailBroadcast-getDate.php';
	
	include('templates/emailBroadcast_template.php');
	

?>

<script>
	$('.list-search').hide();
</script>	
<?
include('templates/footer.php');
?>