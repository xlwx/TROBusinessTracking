<?
define('TRO_ADS',true);
include('../../init.php');
//include('init.php');

$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);


$sql_find = "SELECT * FROM supplier WHERE Name=:name";
$db->query($sql_find);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();

$row=$db->single();
$supplierID = $row['SupplierID'];

$sql_del = 	"Delete FROM contactpersion WHERE SupplierID=:supplierID";
$db->query($sql_del);
$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);	
$db->execute();	

$sql_del = "Delete FROM supplier WHERE Name=:name";
$db->query($sql_del);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();
?>