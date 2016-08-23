<?
define('TRO_ADS',true);
include('init.php');
$update = INCLUDES_URL.'/supplier-update.php';
//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/grid.css");
//$addScript[] = templateAddScript("//code.jquery.com/ui/1.11.4/jquery-ui.min.js");
$addScript[] = templateAddScript(JS_URL."/countries.js");
$addScript[] = templateAddScript(JS_URL."/supplier-validation.js");
//$addScript[] = templateAddScript(JS_URL."/supplier-edit-validation.js");

$pageTitle = "Supplier Edit";
include('templates/header.php');
?>
                                 
	

<?php
	$name=$_GET['name'];
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql="select * from supplier where Name = :name";
	$db->query($sql);
	$db->bind(":name", $name, PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();		
	
   

	$supplierID = $row['SupplierID'];
	$name = $row['Name'];
	$street = $row['Street'];
	$city = $row['City'];
	$zip = $row['Zip'];
	$state = $row['State'];
	$country = $row['Country'];
	$phone = $row['Phone'];
	$fax = $row['Fax'];
	$email = $row['Email'];
	$website = $row['Website'];
	$facebook = $row['Facebook'];
	$twitter = $row['Twitter'];
	$linkedin = $row['LinkedIn'];
	$youtube = $row['YouTube'];
	$pinterest = $row['Pinterest'];
	
	$action = $update;
	include('templates/supplier_template.php');

?>
<script>
	if('<?echo $admin;?>' === 'no'){
    	$('#formID input').attr('readonly', 'readonly');
    	$('.btn').hide();
    }
</script>
<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>