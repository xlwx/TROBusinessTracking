<?
define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$sql = "Delete FROM bannerAds WHERE Name=:name";
$db->query($sql);
$db->bind(":name", $_GET['name'], PDO::PARAM_STR);
$db->execute();

?>