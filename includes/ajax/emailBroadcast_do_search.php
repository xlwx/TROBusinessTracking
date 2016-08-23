<?php

if (isset($_GET['search'])) {
	define('TRO_ADS',true);
	include('../../init.php');
	$db = new pdo_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	$sql = "SELECT * FROM emailBroadcast WHERE CampaignName LIKE :name";
	$db->query($sql);
	$db->bind(':name', '%' . $_GET['search'] . '%', PDO::PARAM_STR);
	$db->execute();
	$row = $db->resultset();

    // get results
   if(count($row)) {
		echo "<div class='panel panel-default'>";
		echo "<div class='panel-heading'>Email Broadcast</div>";
		echo "<table class='table' id='broadcast'>";
		echo "<thead><th>#</th><th>Campaign Name</th><th>Supplier Name</th><th>Broadcast Date</th><th>Broadcast Type</th><th>Server Account</th></thead>";
		$i = 1;
		$j = 0;
		echo "<tbody>";
		while($j<count($row)){

			echo "<tr>";
				echo "<th scope='row'>$i</th>";

				echo "<td class='campaignName'>";
				echo "{$row[$j]['CampaignName']}";
				echo "</td>";
				
		
				$supplierIDs = $row[$j]['CampaignSupplier'];
				$suppliers = explode(',',$supplierIDs);

				$supplierName = array();
				foreach ($suppliers as $supplier){
					$sql_name = "select * from supplier where SupplierID = :supplier";
					$db->query($sql_name);
					$db->bind(":supplier", $supplier, PDO::PARAM_STR);
					$db->execute();
					$row_name=$db->single();
					array_push($supplierName,$row_name['Name']);
				}

				$supplierName = implode(',',$supplierName); 
				echo "<td>";
				echo "$supplierName";
				echo "</td>";
				
				echo "<td>";
				echo "{$row[$j]['BroadcastDate']}";
				echo "</td>";
				
				echo "<td>";
				echo "{$row[$j]['BroadcastType']}";
				echo "</td>";
				
				echo "<td>";
				echo "{$row[$j]['ServerAccount']}";
				echo "</td>";
				
		
				echo "<td>";
				echo "<a href='emailBroadcast-edit.php?campaignName={$row[$j]['CampaignName']}'>";
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