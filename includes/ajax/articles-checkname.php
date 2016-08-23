<?
define('TRO_ADS',true);
include('../../init.php');
//include('init.php');
$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$sql = "select Name from articles where Name=:name";
$db->query($sql);
$db->bind(":name", $_POST['username'], PDO::PARAM_STR);
$db->execute();
 
if($db->single()) {
    echo 'false';

} else {
    echo 'true';
}

?>