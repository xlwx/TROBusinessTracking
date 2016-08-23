<?php
		define('TRO_ADS',true);
		include('../../init.php');
		$db = new pdo_Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);

		$sql="select * from emailBroadcast where CampaignName = :campaignName";
		$db->query($sql);
		$db->bind(':campaignName',$_GET['campaignName'],PDO::PARAM_STR);
		$db->execute();
		$row = $db->single();

		//ID
		$ID = $row['ID'];	
		//Campaign Name
		$campaignName = $row['CampaignName'];
		
		//Supplier Name
		$supplierIDs = $row['CampaignSupplier'];
		$suppliers = explode(',',$supplierIDs);
		$supplierName = array();
		foreach ($suppliers as $supplier){
			$sql_name = "select * from supplier where SupplierID = :supplier";
        	$db->query($sql_name);
			$db->bind(':supplier',$supplier,PDO::PARAM_STR);
			$db->execute();
			$row_name = $db->single();
			array_push($supplierName,$row_name['Name']);
		}
		$supplierName = implode(',',$supplierName); 
		
		// Broadcast Type
		$broadcastType = $row['BroadcastType'];
		//Account
		$broadcastAccount = $row['ServerAccount'];
		//Date
		$broadcastDate = $row['BroadcastDate'];
		
		echo "$supplierName-" . "$broadcastType-" . "$broadcastAccount-" . "$broadcastDate-";

?>
