<?
//if we got something through $_POST
if (isset($_GET['search'])) {
	define('TRO_ADS',true);
	include('../../init.php');
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql = "SELECT * FROM travelAgentSpotlight WHERE Name LIKE :name";
	$db->query($sql);
	$db->bind(':name', '%' . $_GET['search'] . '%', PDO::PARAM_STR);
	$db->execute();
	$row = $db->resultset();

    // get results
   if(count($row)) {
		echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>Travel Agent Spotlight</div>";
	echo "<table class='table' id='salesTeamList'>";
	echo "<thead><th>#</th><th>Name</th><th>Supplier</th><th>Banner Type</th><th>Start</th><th>End</th></thead>";
	$i = 1;
	$j = 0;
	echo "<tbody>";
	while($j<count($row)){

		echo "<tr>";
			echo "<th scope='row'>$i</th>";

			echo "<td class='nameDel'>";
			echo "{$row[$j]['Name']}";
			echo "</td>";
			
			//supplierName
    		$supplierID = $row[$j]['SupplierID'];
			$sql_supplier = "select Name from supplier where SupplierID = :supplierID";
			$db->query($sql_supplier);
			$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
			$db->execute();
			$row_supplier=$db->single();
    		$supplierName = $row_supplier['Name'];
			echo "<td>";
			echo "$supplierName";
			echo "</td>";

			echo "<td>";
			echo "{$row[$j]['BannerType']}";
			echo "</td>";

			echo "<td >";
			echo "{$row[$j]['StartDate']}";
			echo "</td>";
			
			echo "<td >";
			echo "{$row[$j]['EndDate']}";
			echo "</td>";


			echo "<td>";
    		echo "<a href='travelAgentSpotlight-edit.php?name={$row[$j]['Name']}'>";
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