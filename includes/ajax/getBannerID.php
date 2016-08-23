<?

define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

//supplierID
$sql = "select * from bannerAds where Name = :bannerName";
$db->query($sql);
$db->bind(":bannerName", $_GET['bannerName'], PDO::PARAM_STR);
$db->execute();
$row=$db->single();
$supplierID = $row['BannerID'];

echo $supplierID;
?>