<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$insert = INCLUDES_URL.'/emailBroadcast-insert.php';
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
$addScript[] = templateAddScript(JS_URL."/emailBroadcast-validation.js");

$pageTitle = "Email Broadcast";
include('templates/header.php');
?>
<?
	
	//ID
	$ID = '';	
	//Campaign Name
	$campaignName = '';
	//Supplier Name
	$supplierName = '';
	//Broadcast Type
	$broadcastType = '';
	//Server Account
	$serverAccount = '';
	//Broadcast Date
	$broadcastDate = '';
	//Instruction
	$instruction = '';
	
	$action = $insert;
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
