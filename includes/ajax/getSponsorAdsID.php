<?

define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

//supplierID
$sql = "select * from articles where Name = :sponsorName";
$db->query($sql);
$db->bind(":sponsorName", $_GET['sponsorName'], PDO::PARAM_STR);
$db->execute();
$row=$db->single();
$sponsorID = $row['ID'];

echo $sponsorID;
?>