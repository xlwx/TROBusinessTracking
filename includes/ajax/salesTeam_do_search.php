<?php
//if we got something through $_POST
if (isset($_GET['search'])) {
	define('TRO_ADS',true);
	include('../../init.php');
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql = "SELECT * FROM salesTeam WHERE FirstName LIKE :name OR LastName LIKE :name ";
	$db->query($sql);
	$db->bind(':name', '%' . $_GET['search'] . '%', PDO::PARAM_STR);
	$db->execute();
	$row = $db->resultset();

    // get results
   if(count($row)) {
		echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Sales Team Member</div>";
	echo "<table class='table' id='salesTeamList'>";
	echo "<thead><th>#</th><th>FirstName</th><th>LastName</th><th>Email</th><th>CellPhone</th><th>Action</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='firstname'>";
			echo "{$row[$j]['FirstName']}";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['LastName']}";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['Email']}";
			echo "</td>";

			echo "<td class='cellphone'>";
			echo "{$row[$j]['CellPhone']}";
			echo "</td>";


			echo "<td>";
    		echo "<a href='salesTeam-edit.php?firstname={$row[$j]['FirstName']}&cellphone={$row[$j]['CellPhone']}'>";
			echo "<input type='button' name='btnEdit' value='edit' id='btnEdit$i' class='btn btn-primary' />";
			echo "</a>";
			echo "&nbsp&nbsp&nbsp<input type='button' name='btnDel' value='del' id='btnDel$i' class='btn btn-danger' />";
			echo "</td>";
			echo "<script> ".
				 "$('#btnDel$i').bind('click',delRow);" .
				 "</script>";
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