<?php
define('TRO_ADS',true);
include('../init.php');
//include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "UPDATE bannerAds
            SET Name = :name,
				 Value = :value,
				 RunPeriod = :runPeriod,
				 AvailableUnits = :availableUnits
            WHERE BannerID = :ID";
$db->query($sql);

$db->bind(":ID", $_POST['ID'], PDO::PARAM_INT);
$db->bind(":name", $_POST['name'], PDO::PARAM_STR);
$db->bind(":value", $_POST['value'], PDO::PARAM_STR);
$db->bind(":runPeriod", $_POST['runPeriod'], PDO::PARAM_STR);
$db->bind(":availableUnits", $_POST['availableUnits'], PDO::PARAM_STR);

$db->execute();


header("Location:".BASE_URL."bannerAds-list.php");
exit;

?>