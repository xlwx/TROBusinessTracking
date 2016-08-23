<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$update = INCLUDES_URL.'/troCruiseNews-update.php';

//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
$addStyleSheet[] = templateAddStyleSheet("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/bootstrap-datepicker.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/fullcalendar.css");
$addScript[] = templateAddScript("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js");
$addScript[] = templateAddScript(JS_URL."/bootstrap-datepicker.min.js");
//$addScript[] = templateAddScript(JS_URL."/countries.js");
$addScript[] = templateAddScript(JS_URL."/troCruiseNews-validation.js");
$addScript[] = templateAddScript(JS_URL."/moment.min.js");
$addScript[] = templateAddScript(JS_URL."/fullcalendar.min.js");

$pageTitle = "TRO CruiseNews Edit";
include('templates/header.php');
?>

<?
	$sql="select * from TROC where Name = :name";
	$db->query($sql);
	$db->bind(":name", $_GET['campaignName'], PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();
	
	$name = $_GET['campaignName'];
	$bannerID = $row['BannerID'];
	$bannerType = $row['BannerType'];
	$startDate = $row['StartDate'];
	$endDate = $row['EndDate'];
	$bannerCode = $row['BannerCode'];
	$AdId = $row['AdId'];
	$supplierID = $row['SupplierID'];
	//supplierName
	$sql = "select * from supplier where SupplierID = :supplierID";
	$db->query($sql);
	$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();
	$supplierName = $row['Name'];
	

	$action = $update;

	$edit = 'troCruiseNews-edit.php';
	$getBookingInfo = 'troCruiseNews-getBookingInfo.php';
	$getDate = 'troCruiseNews-getDate.php';
	include('templates/troCruiseNews_template.php');
	
?>
<script>
	$('.list-search').hide();
</script>
	
<?
include('templates/footer.php');
?>