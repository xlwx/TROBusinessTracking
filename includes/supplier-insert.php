<?
define('TRO_ADS',true);
include('../init.php');
//include('init.php');

$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);


$sql = "INSERT INTO supplier (Name,Street,City,Zip,State,Country,Phone,Fax,Email,Website,Facebook,Twitter,LinkedIn,YouTube,Pinterest) VALUES (:name,:street,:city,:zip,:state,:country,:phone,:fax,:email,:website,:facebook,:twitter,:linkedin,:youtube,:pinterest)";
$db->query($sql);

$db->bind(":name", $_POST['name'], PDO::PARAM_STR);
$db->bind(":street", $_POST['street'], PDO::PARAM_STR);
$db->bind(":city", $_POST['city'], PDO::PARAM_STR);
$db->bind(":zip", $_POST['zip'], PDO::PARAM_STR);
$db->bind(":state", $_POST['state'], PDO::PARAM_STR);
$db->bind(":country", $_POST['country'], PDO::PARAM_STR);
$db->bind(":phone", $_POST['phone'], PDO::PARAM_STR);
$db->bind(":fax", $_POST['fax'], PDO::PARAM_STR);
$db->bind(":email", $_POST['email'], PDO::PARAM_STR);
$db->bind(":website", $_POST['website'], PDO::PARAM_STR);
$db->bind(":facebook", $_POST['facebook'], PDO::PARAM_STR);
$db->bind(":twitter", $_POST['twitter'], PDO::PARAM_STR);
$db->bind(":linkedin", $_POST['linkedin'], PDO::PARAM_STR);
$db->bind(":youtube", $_POST['youtube'], PDO::PARAM_STR);
$db->bind(":pinterest", $_POST['pinterest'], PDO::PARAM_STR);
$db->execute();

$supplierID = $db->lastInsertId();
$rowCount = $_POST['rowCount'];
for($num = 1; $num < $rowCount+1 ; $num++) {

	if( isset($_POST['cpname' . $num]) )
	{
    	$cpID = $_POST['cpID' . $num];
        $cpname = $_POST['cpname' . $num];
    	$cpphone = $_POST['cpphone' . $num];
        $cpemail = $_POST['cpemail' . $num];      
        $cpfax = $_POST['cpfax' . $num];
    
		$sql = "INSERT INTO contactpersion (Name,Phone,Email,Fax,SupplierID) VALUES (:cpname,:cpphone,:cpemail,:cpfax,:supplierID)";
		$db->query($sql);	
		$db->bind(":cpname", $cpname, PDO::PARAM_STR);
		$db->bind(":cpphone", $cpphone, PDO::PARAM_STR);
		$db->bind(":cpemail", $cpemail, PDO::PARAM_STR);
		$db->bind(":cpfax", $cpfax, PDO::PARAM_STR);
    	$db->bind(":supplierID", $supplierID, PDO::PARAM_INT);
		$db->execute();
	}
}

header("Location:".BASE_URL."supplier-list.php");
?>