<?php
define('TRO_ADS',true);
include('../init.php');
//include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$sql = "UPDATE salesTeam
            SET FirstName = :firstname,
            	LastName = :lastname,
            	Email = :email,
            	CellPhone = :cellphone,
            	HomePhone = :homephone,
            	Fax = :fax,
				Street = :street,
				City = :city,
				Zip = :zip,
				State = :state,
				Country = :country,
				CommissionRate = :commissionRate
            WHERE ID = :ID";
$db->query($sql);

$db->bind(":ID", $_POST['ID'], PDO::PARAM_INT);
$db->bind(":firstname", $_POST['firstname'], PDO::PARAM_STR);
$db->bind(":lastname", $_POST['lastname'], PDO::PARAM_STR);
$db->bind(":email", $_POST['email'], PDO::PARAM_STR);
$db->bind(":cellphone", $_POST['cellphone'], PDO::PARAM_STR);
$db->bind(":homephone", $_POST['homephone'], PDO::PARAM_STR);
$db->bind(":fax", $_POST['fax'], PDO::PARAM_STR);
$db->bind(":street", $_POST['street'], PDO::PARAM_STR);
$db->bind(":city", $_POST['city'], PDO::PARAM_STR);
$db->bind(":zip", $_POST['zip'], PDO::PARAM_STR);
$db->bind(":state", $_POST['state'], PDO::PARAM_STR);
$db->bind(":country", $_POST['country'], PDO::PARAM_STR);
$db->bind(":commissionRate", $_POST['commissionRate'], PDO::PARAM_STR);
$db->execute();


header("Location:".BASE_URL."salesTeam-list.php");
exit;

?>