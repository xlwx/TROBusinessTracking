<?
define('TRO_ADS',true);
include('init.php');
$update = INCLUDES_URL.'/salesTeam-update.php';
//$addStyle[] = templateAddStyle($addCSS);
//$addJavaScript[] = templateAddJavaScript($addJS);
$addStyleSheet[] = templateAddStyleSheet(CSS_URL."/grid.css");
//$addScript[] = templateAddScript("//code.jquery.com/ui/1.11.4/jquery-ui.min.js");
$addScript[] = templateAddScript(JS_URL."/countries.js");
$addScript[] = templateAddScript(JS_URL."/salesTeam-validation.js");
//$addScript[] = templateAddScript(JS_URL."/supplier-edit-validation.js");

$pageTitle = "SalesTeam Edit";
include('templates/header.php');
?>

<?
	
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql="select * from salesTeam where FirstName = :firstname and CellPhone= :cellphone";
	$db->query($sql);
	$db->bind(":firstname", $_GET['firstname'], PDO::PARAM_STR);
	$db->bind(":cellphone", $_GET['cellphone'], PDO::PARAM_STR);
	$db->execute();
	$row=$db->single();	
	

	$ID = $row['ID'];
	$firstname = $row['FirstName'];
	$lastname = $row['LastName'];
	$email = $row['Email'];
	$cellphone = $row['CellPhone'];
	$homephone = $row['HomePhone'];
	$fax = $row['Fax'];
	$street = $row['Street'];
	$city = $row['City'];
	$zip = $row['Zip'];
	$state = $row['State'];
	$country = $row['Country'];
	$commissionRate = $row['CommissionRate'];

	$action = $update;
	include('templates/salesTeam_template.php');

?>
<script>
	if('<?echo $admin;?>' === 'no'){
    	$('#commissionRate').attr('readonly', 'readonly');
    }	
</script>
<script>
	$('.list-search').hide();
</script>
<?
include('templates/footer.php');
?>