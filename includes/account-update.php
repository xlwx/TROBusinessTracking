<?php
define('TRO_ADS',true);
include('../init.php');
//include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "UPDATE User
            SET UserName = :username,
				 Password = :password
            WHERE ID = :ID";
$db->query($sql);

$db->bind(":ID", $_POST['ID'], PDO::PARAM_INT);
$db->bind(":username", $_POST['username'], PDO::PARAM_STR);
$db->bind(":password", md5($_POST['password']), PDO::PARAM_STR);


$db->execute();


header("Location:".BASE_URL."coverpage.php");
exit;

?>