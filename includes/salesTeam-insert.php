<?php
define('TRO_ADS',true);
include('../init.php');
//include('init.php');

$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);


$sql = "INSERT INTO salesTeam (FirstName,LastName,Email,CellPhone,HomePhone,Fax,Street,City,Zip,State,Country,CommissionRate) VALUES
(:firstname,:lastname,:email,:cellphone,:homephone,:fax,:street,:city,:zip,:state,:country,:commissionRate)";
$db->query($sql);

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


?>