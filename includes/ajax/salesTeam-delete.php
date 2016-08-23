<?
define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$sql = "Delete FROM salesTeam WHERE FirstName= :firstname and CellPhone=:cellphone";
$db->query($sql);
$db->bind(":firstname", $_GET['firstname'], PDO::PARAM_STR);
$db->bind(":cellphone", $_GET['cellphone'], PDO::PARAM_STR);
$db->execute();

?>