<?php
		define('TRO_ADS',true);
		include('../../init.php');
		$db = new pdo_Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);

		$sql="select * from Travelgram where Name = :campaignName";
		$db->query($sql);
		$db->bind(":campaignName",$_GET['campaignName'], PDO::PARAM_STR);
		$db->execute();
		$row=$db->single();
		
		//ID
		$ID = $row['BannerID'];	
		//Campaign Name
		$campaignName = $row['Name'];
		//Supplier Name
		$supplierID = $row['SupplierID'];
		$sql_supplier = "select Name from supplier where SupplierID = :supplierID";
		$db->query($sql_supplier);
		$db->bind(":supplierID",$supplierID, PDO::PARAM_STR);
		$db->execute();
		$row_supplier=$db->single();
		$supplierName = $row_supplier['Name'];
		// Banner Type
		$bannerType = $row['BannerType'];
		//Date
		$startDate = $row['StartDate'];
		$endDate = $row['EndDate'];
		
		echo "$supplierName-" . "$bannerType-" . "$startDate-" . "$endDate-";

?>