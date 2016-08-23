<?php
define('TRO_ADS',true);
include('../init.php');
//include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$sql = "UPDATE supplier
            SET Name = :name,
				 Street = :street,
				 City = :city,
				 Zip = :zip,
				 State = :state,
				 Country = :country,
				 Phone = :phone,
				 Fax = :fax,
				 Email = :email,
				 Website = :website,
				 Facebook = :facebook,
				 Twitter = :twitter,
				 LinkedIn = :linkedin,
				 YouTube = :youtube,
				 Pinterest = :pinterest
            WHERE SupplierID = :supplierID";

$db->query($sql);
$db->bind(":supplierID", $_POST['supplierID'], PDO::PARAM_INT);
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

$rowCount = $_POST['rowCount'];
for($num = 1; $num < $rowCount+1 ; $num++) {

	if( isset($_POST['cpname' . $num]))
	{
    	$cpID = $_POST['cpID' . $num];
        $cpname = $_POST['cpname' . $num];
    	$cpphone = $_POST['cpphone' . $num];
        $cpemail = $_POST['cpemail' . $num];      
        $cpfax = $_POST['cpfax' . $num];
    
    	if(isset($_POST['cpID' . $num])){
        	     	
        	$sql = "UPDATE contactpersion
                    SET 
					 Name = :cpname,
                     Phone = :cpphone,
                     Email = :cpemail,
                     Fax = :cpfax
                    WHERE ContactPersionID=:cpID";
       		$db->query($sql);
			$db->bind(":cpID", $cpID, PDO::PARAM_INT);
			$db->bind(":cpname", $cpname, PDO::PARAM_STR);
			$db->bind(":cpphone",$cpphone, PDO::PARAM_STR);
			$db->bind(":cpemail", $cpemail, PDO::PARAM_STR);
			$db->bind(":cpfax", $cpfax, PDO::PARAM_STR);
			$db->execute();		
        }else{
			$sql = "INSERT INTO contactpersion (Name,Email,Phone,Fax,SupplierID) VALUES (:cpname,:cpemail,:cpphone,:cpfax,:supplierID)";
        	$db->query($sql);
			$db->bind(":supplierID", $_POST['supplierID'], PDO::PARAM_INT);
			$db->bind(":cpname", $_POST['cpname' . $num], PDO::PARAM_STR);
			$db->bind(":cpphone", $_POST['cpphone' . $num], PDO::PARAM_STR);
			$db->bind(":cpemail", $_POST['cpemail' . $num], PDO::PARAM_STR);
			$db->bind(":cpfax", $_POST['cpfax' . $num], PDO::PARAM_STR);
			$db->execute();
		}
		
	}
    
}

header("Location:".BASE_URL."supplier-list.php");

?>