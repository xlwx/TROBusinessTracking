<?php
session_start();
//if we got something through $_POST
if (isset($_GET['search'])) {
	define('TRO_ADS',true);
	include('../../init.php');
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql = "SELECT * FROM bannerAds WHERE Name LIKE :name";
	$db->query($sql);
	$db->bind(':name', '%' . $_GET['search'] . '%', PDO::PARAM_STR);
	$db->execute();
	$row = $db->resultset();

    // get results
   if(count($row)) {
		echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Sales Team Member</div>";
	echo "<table class='table' id='salesTeamList'>";
	echo "<thead><th>#</th><th>Name</th><th>Value($)</th><th>Run Period(week)</th><th>Available Units</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='nameDel'>";
			echo "{$row[$j]['Name']}";
			echo "</td>";

			echo "<td align='left'>";
			echo "{$row[$j]['Value']}";
			echo "</td>";

			echo "<td align='left'>";
			echo "{$row[$j]['RunPeriod']}";
			echo "</td>";

			echo "<td align='left'>";
			echo "{$row[$j]['AvailableUnits']}";
			echo "</td>";

			if( $_SESSION['admin'] === 'yes'){
				echo "<td>";
    			echo "<a href='bannerAds-edit.php?name={$row[$j]['Name']}'>";
				echo "<input type='button' name='btnEdit' value='edit' id='btnEdit$i' class='btn btn-primary' />";
				echo "</a>";
				echo "&nbsp&nbsp&nbsp<input type='button' name='btnDel' value='del' id='btnDel$i' class='btn btn-danger' />";
				echo "</td>";
				echo "<script> ".
				 	 "$('#btnDel$i').bind('click',delRow);" .
				 	 "</script>";
            }
			$i++;
			$j++;

		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";

	} else {
    	echo "no result";
	}
}
?>