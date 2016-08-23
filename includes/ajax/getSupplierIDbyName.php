<?

define('TRO_ADS',true);
include('../../init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

//supplierID
$sql = "select * from supplier where Name = :supplierName";
$db->query($sql);
$db->bind(":supplierName",$_GET['supplierName'], PDO::PARAM_STR);
$db->execute();
$row=$db->single();
$supplierID = $row['SupplierID'];

if($supplierID){
	echo $supplierID;
}else{
	echo '-1';
}

?>