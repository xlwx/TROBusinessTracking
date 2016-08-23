<?
define('TRO_ADS',true);
include('init.php');
$update = INCLUDES_URL.'/articles-update.php';
$addScript[] = templateAddScript(JS_URL."/articles-edit-validation.js");
$pageTitle = "SponsorAds Edit";
include('templates/header.php');
?>
<?
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql="select * from articles where Name = :name";
	$db->query($sql);
	$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();
	
	$ID = $row['ID'];
	$name = $row['Name'];
	$units = $row['NumberOfUnit'];
	$value = $row['Value'];
	$action = $update;
	include('templates/articles_template.php');	
?>
<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>
