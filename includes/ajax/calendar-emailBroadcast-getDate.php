<?php
	define('TRO_ADS',true);
	include('../../init.php');
	//require  ('utils.php');
	$db = new pdo_Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);
	$supplierID=$_GET['supplierID'];
	$broadcastType = $_GET['broadcastType'];
	$serverAccount = $_GET['serverAccount'];
	$sql="select * from emailBroadcast where  CampaignSupplier = :supplierID OR BroadcastType = :broadcastType OR ServerAccount = :serverAccount";
	$db->query($sql);
	$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
	$db->bind(":broadcastType", $broadcastType, PDO::PARAM_STR);
	$db->bind(":serverAccount", $serverAccount, PDO::PARAM_STR);
	$db->execute();
	$row=$db->resultset();
	//$events="";
	$j = 0;
	$timezone = null;
	$events = array();
	while($j<count($row)){
		$start = $row[$j]['BroadcastDate'];
		list($month, $day, $year) = preg_split('[/]', $start);
		$start = $year . "-" . $month . "-" . $day;
		
		
		$events[] = array(
			'title' => $row[$j]['CampaignName'],
			'start' => $start,
        	'end' => $start,
        	'id' => '1'
		);
    	
    	$j++;
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
