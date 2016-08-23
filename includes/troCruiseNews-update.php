<?php
define('TRO_ADS',true);
include('../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
//supplierID
$sql = "select * from supplier where Name = :supplierName";
$db->query($sql);
$db->bind(":supplierName", $_POST['supplierName'], PDO::PARAM_STR);
$db->execute();
$row=$db->single();
$supplierID = $row['SupplierID'];

/***********************************google calendar update*************************************/
$sql = "select * from TROC where BannerID = :ID";
$db->query($sql);
$db->bind(":ID", $_POST['ID'], PDO::PARAM_STR);
$db->execute();
$row = $db->single();
$eventId = $row['GoogleCalId'];
//$calendarId = '04c9q7jjvihsp1o5rt5u6d2jm4@group.calendar.google.com';
$calendarId = 'gdpfiud0dh0td5f082hmni0424@group.calendar.google.com';
$title = $_POST['supplierName'];
$details = 'banner type: ' . $_POST['bannerType'] . "\n" . 'ID: ' . $_POST['AdId'];
$satrt = $_POST['startDate'];
list($month, $day, $year) = preg_split('[/]', $satrt);
$start = $year . "-" . $month . "-" . $day . 'T00:00:00';
		
$end =  $_POST['endDate'];
list($month, $day, $year) = preg_split('[/]', $end);
$end = $year . "-" . $month . "-" . ($day+1) . 'T00:00:00';
include('tro-google-calendar-update.php');
/**********************************************************************************************/

$sql = "UPDATE TROC
            SET Name = :name,
				 SupplierID = :supplierID,
				 BannerType = :bannerType,
				 StartDate = :startDate,
				 EndDate = :endDate,
				 BannerCode = :bannerCode,
                 AdId = :AdId
            WHERE BannerID = :ID";
			
$db->query($sql);

$db->bind(":ID", $_POST['ID'], PDO::PARAM_INT);
$db->bind(":name", $_POST['name'], PDO::PARAM_STR);
$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
$db->bind(":bannerType", $_POST['bannerType'], PDO::PARAM_STR);
$db->bind(":startDate", $_POST['startDate'], PDO::PARAM_STR);
$db->bind(":endDate", $_POST['endDate'], PDO::PARAM_STR);
$db->bind(":bannerCode", $_POST['bannerCode'], PDO::PARAM_STR);
$db->bind(":AdId", $_POST['AdId'], PDO::PARAM_STR);

$db->execute();


header("Location:".BASE_URL."troCruiseNews-list.php");

?>
