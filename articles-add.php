<?
define('TRO_ADS',true);
include('init.php');
$insert = INCLUDES_URL.'/articles-insert.php';

//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
//$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/grid.css");
//$addScript[] = templateAddScript("//code.jquery.com/ui/1.11.4/jquery-ui.min.js");
//$addScript[] = templateAddScript(JS_URL."/countries.js");
$addScript[] = templateAddScript(JS_URL."/articles-validation.js");
//$addScript[] = templateAddScript(JS_URL."/supplier-edit-validation.js");

$pageTitle = "SponsorAds Add";
include('templates/header.php');
?>
<?
	$name = '';
	$units = '500';
	$value = '';
	$ID = '';
	$action = $insert;
	include('templates/articles_template.php');
?>
<script>
	$('.list-search').hide();
</script>	
<?
include('templates/footer.php');
?>