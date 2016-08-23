<?
define('TRO_ADS',true);
include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$insert = INCLUDES_URL.'/travelAgentSpotlight-insert.php';

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
$addStyle[] = templateAddStyle($addCSS);
$addStyleSheet[] = templateAddStyleSheet("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/bootstrap-datepicker.min.css");
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/fullcalendar.css");
$addScript[] = templateAddScript("//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js");
$addScript[] = templateAddScript(JS_URL."/bootstrap-datepicker.min.js");
$addScript[] = templateAddScript(JS_URL."/moment.min.js");
$addScript[] = templateAddScript(JS_URL."/fullcalendar.min.js");
//$addScript[] = templateAddScript(JS_URL."/troCruiseNews-validation.js");


$pageTitle = "Travel Agent Spotlight";
include('templates/header.php');
?>
<?
	$name = '';
	$bannerID = '';
	$bannerType = '';
	$startDate = '';
	$endDate = '';
	$bannerCode = '';
	$supplierName = '';
	$AdId = '';
	$action = $insert;
	$edit = 'travelAgentSpotlight-edit.php';
	$getBookingInfo = 'travelAgentSpotlight-getBookingInfo.php';
	$getDate = 'travelAgentSpotlight-getDate.php';
	

	include('templates/troCruiseNews_template.php');

?>

<script>

$('#bannerType').append('<option val="leaderboard">leaderboard</option>');

$('#sp').text('only 2 per issue');
$('#ca').text('4-8 per issue');
</script>

<script>
	$('.list-search').hide();
</script>	
<?
include('templates/footer.php');
?>