<?
define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql_del = 	"Delete FROM contactpersion WHERE Name=:cpname";
$db->query($sql_del);
$db->bind(":cpname", $_GET['cpname'], PDO::PARAM_STR);	
$db->execute();	
?>