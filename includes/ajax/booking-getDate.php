<?php
	define('TRO_ADS',true);
	include('../../init.php');
	//require  ('utils.php');
	$db = new pdo_Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);
	
	$inventoryName=$_GET['inventoryName'];
	$inventoryType=$_GET['inventoryType'];	
	//inventory ID
	if($inventoryType == 'bannerAds'){
		$sql = "select * from bannerAds where Name = :inventoryName";	
		$db->query($sql);
		$db->bind(":inventoryName", $inventoryName, PDO::PARAM_STR);
		$db->execute();
		$row=$db->single();
		$inventoryID = $row['BannerID'];
	}else{
		$sql = "select * from articles where Name = :inventoryName";
		$db->query($sql);
		$db->bind(":inventoryName", $inventoryName, PDO::PARAM_STR);
		$db->execute();
		$row=$db->single();
		$inventoryID = $row['ID'];
	}
	
	$sql="select * from booking where  InventoryType = :inventoryType and InventoryID = :inventoryID";
	
	$db->query($sql);
	$db->bind(":inventoryType", $inventoryType, PDO::PARAM_STR);
	$db->bind(":inventoryID", $inventoryID, PDO::PARAM_STR);
	$db->execute();
	$row=$db->resultset();
		
	$j = 0;
	//$events="";
	$timezone = null;
	$events = array();
	while($j<count($row)){
		$satrt = $row[$j]['StartDate'];
		list($month, $day, $year) = preg_split('[/]', $satrt);
		$start = $year . "-" . $month . "-" . $day;
		
		$end = $row[$j]['EndDate'];
		list($month, $day, $year) = preg_split('[/]', $end);
		$end = $year . "-" . $month . "-" . $day;
		
		$events[] = array(
			'title' => $row[$j]['CampaignName'],
			'start' => $start,
			'end' => $end,
        	'id' => '1'
		);
		$j++;
		//$events = $events . "{title:'" . $row['CampaignName'] . "'," . " type:'important'," . "startsAt: '" . $row['StartDate'] . "'," .  
    //"endsAt:'" . $row['EndDate'] . "'},";
    
	}
	foreach ($events as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);

	// If the event is in-bounds, add it to the output
	
	$output_arrays[] = $event->toArray();
	
	}
	
	echo json_encode($events);
	//echo $events;
?>
