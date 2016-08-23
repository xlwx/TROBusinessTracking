<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$update = INCLUDES_URL.'/booking-update.php';

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
$addScript[] = templateAddScript(JS_URL."/booking-validation.js");

$pageTitle = "Booking Edit";
include('templates/header.php');
?>
	
<?

	$db->query("select * from booking where CampaignName = :campaignName");
	$db->bind(":campaignName", $_GET['campaignName'], PDO::PARAM_STR);
	$db->execute();
	$row = $db->single();
	
	//ID
	$ID = $row['ID'];
	
	//Campaign Name
	$campaignName = $row['CampaignName'];

	//Supplier Name
	$supplierID = $row['SupplierID'];
	$sql_supplier = "select Name from supplier where SupplierID = :supplierID";
	$db->query($sql_supplier);
	$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
	$db->execute();
	$row_supplier = $db->single();
	$supplierName = $row_supplier['Name'];
	
	// Inventory Type
	$inventoryType = $row['InventoryType'];
	
	// Inventory Name
	$unitID = $row['InventoryID'];
	if($row['InventoryType'] == 'bannerAds'){
		$sql_unit = "select Name from bannerAds where BannerID = :unitID";
	}else{
		$sql_unit = "select Name from articles where ID = :unitID";
	}
	$db->query($sql_unit);
	$db->bind(":unitID", $unitID, PDO::PARAM_STR);
	$db->execute();
	$row_unit = $db->single();
	$unitName = $row_unit['Name'];
	
	//date
	$startDate = $row['StartDate'];
	$endDate = $row['EndDate'];
	
	//sales member first name
	$salesMemberID = $row['SalesMemberID'];
	$sql_salesmember = "select * from salesTeam where ID = :salesMemberID";
	$db->query($sql_salesmember);
	$db->bind(":salesMemberID", $salesMemberID, PDO::PARAM_STR);
	$db->execute();
	$row_salesmember = $db->single();
	$salesMemberName = $row_salesmember['FirstName'];

	$size = $row['Size'];
	$AdId = $row['AdId'];
	$website = $row['Website'];	

	$action = $update;
	$edit = 'booking-edit.php';
	$getBookingInfo = 'booking-getBookingInfo.php';
	$getDate = 'booking-getDate.php';
	
	include('templates/booking_template.php');
?>

<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>