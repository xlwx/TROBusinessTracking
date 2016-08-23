<?php
session_start();
//if we got something through $_POST
if (isset($_GET['search'])) {
	define('TRO_ADS',true);
	include('../../init.php');
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	
	$sql = "SELECT Name FROM supplier WHERE Name LIKE :name";
	$db->query($sql);
	$db->bind(':name', '%' . $_GET['search'] . '%', PDO::PARAM_STR);
	$db->execute();
	$row = $db->resultset();
    // get results
   if(count($row)) {

	echo "<table class='table' id='supplierList'>";
		$i = 1;
		
		for($j=0;$j<count($row);$j++){
			
			echo "<tr>";
				
				echo "<td>";
				echo "<a href='". BASE_URL ."/supplier-edit.php?name={$row[$j]['Name']}' class='list-group-item'>";
				echo "{$row[$j]['Name']}";
				echo "</a>";
				echo "</td>";
				if( $_SESSION['admin'] === 'yes'){
					echo "<td>";
					echo "<input type='button' name='btnDel' value='del' id='btnDel$i' class='btn btn-danger' />";
					echo "</td>";
					echo "<script> ".
					 	 "$('#btnDel$i').bind('click',delRow);" .
					 	 "</script>";
                }
				$i++;

			echo "</tr>";
		}
		
		echo "</table>";

	} else {
    	echo "no result";
	}
}
?>