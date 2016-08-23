<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$insert = INCLUDES_URL.'/booking-insert.php';
$addCSS = "
	body {
		margin: 40px 10px;
		padding: 0;
		font-family: \"Lucida Grande\",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

";

//$addJS = "";

$addStyle[] = templateAddStyle($addCSS);
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

$pageTitle = "Booking Form";
include('templates/header.php');
?>

<?

	
	//ID
	$ID = '';
	
	//Campaign Name
	$campaignName = '';
	$supplierName = '';
	
	// Inventory Type
	$inventoryType = 'bannerAds';
	
	// Inventory Name
	$unitName = '';
	
	//date
	$startDate = '';
	$endDate = '';
	
	//website
	$website = 'TRO';
	//sales member first name
	$salesMemberName = '';
	$size = '';
	$AdId = '';
	$website = '';	
	$action = $insert;
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