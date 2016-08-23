<?php
define('TRO_ADS',true);
include('../init.php');

$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);


$sql = "INSERT INTO bannerAds (Name,Value,RunPeriod,AvailableUnits) VALUES (:name,:value,:runPeriod,:availableUnits)";
$db->query($sql);

$db->bind(":name", $_POST['name'], PDO::PARAM_STR);
$db->bind(":value", $_POST['value'], PDO::PARAM_STR);
$db->bind(":runPeriod", $_POST['runPeriod'], PDO::PARAM_STR);
$db->bind(":availableUnits", $_POST['availableUnits'], PDO::PARAM_STR);


$db->execute();


//header("Location: list.php");


?>