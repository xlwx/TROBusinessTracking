<?
define('TRO_ADS',true);
include('init.php');
$insert = INCLUDES_URL.'/salesTeam-insert.php';

//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/grid.css");
//$addScript[] = templateAddScript("//code.jquery.com/ui/1.11.4/jquery-ui.min.js");
$addScript[] = templateAddScript(JS_URL."/countries.js");
$addScript[] = templateAddScript(JS_URL."/salesTeam-validation.js");
//$addScript[] = templateAddScript(JS_URL."/supplier-edit-validation.js");

$pageTitle = "SalesTeam Member";
include('templates/header.php');
?>
<?
	$ID = '';
	$firstname = '';
	$lastname = '';
	$email = '';
	$cellphone = '';
	$homephone = '';
	$fax = '';
	$street = '';
	$city = '';
	$zip = '';
	$state = '';
	$country = '';
	$commissionRate = '';
	$action = $insert;
	include('templates/salesTeam_template.php');
?>
<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>