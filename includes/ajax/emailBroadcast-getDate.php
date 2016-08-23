<?php
	define('TRO_ADS',true);
	include('../../init.php');
	//require  ('utils.php');
	$db = new pdo_Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);
	$broadcastType=$_GET['broadcastType'];
	
	
	$sql="select * from emailBroadcast where  BroadcastType = :broadcastType";
	$db->query($sql);
	$db->bind(":broadcastType", $broadcastType, PDO::PARAM_STR);
	$db->execute();
	$row=$db->resultset();
	
	$j = 0;
	$timezone = null;
	$events = array();
	while($j < count($row)){
		$satrt = $row[$j]['BroadcastDate'];
		list($month, $day, $year) = preg_split('[/]', $satrt);
		$start = $year . "-" . $month . "-" . $day;
		
		
		$events[] = array(
			'title' => $row[$j]['CampaignName'],
			'start' => $start,
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
