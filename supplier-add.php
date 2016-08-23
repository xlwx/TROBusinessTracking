<?
define('TRO_ADS',true);
include('init.php');
$insert = INCLUDES_URL.'/supplier-insert.php';

//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/grid.css");
//$addScript[] = templateAddScript("//code.jquery.com/ui/1.11.4/jquery-ui.min.js");
$addScript[] = templateAddScript(JS_URL."/countries.js");
$addScript[] = templateAddScript(JS_URL."/supplier-validation.js");
//$addScript[] = templateAddScript(JS_URL."/supplier-edit-validation.js");

$pageTitle = "Supplier";
include('templates/header.php');
?>

<?php
	
	$supplierID = '';
	$name = '';
	$street = '';
	$city = '';
	$zip = '';
	$state = '';
	$country = '';
	$phone = '';
	$fax = '';
	$email = '';
	$website = '';
	$facebook = '';
	$twitter = '';
	$linkedin = '';
	$youtube = '';
	$pinterest = '';
	$action = $insert;
	include('templates/supplier_template.php');
	
?>
<script>
	$('.list-search').hide();
</script>	
	
<?
include('templates/footer.php');
?>	
