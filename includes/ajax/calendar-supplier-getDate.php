<?php
	define('TRO_ADS',true);
	include('../../init.php');
	//require  ('utils.php');
	$db = new pdo_Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);
	$supplierID=$_GET['supplierID'];
	$sql="select * from booking where  SupplierID = :supplierID";
	$db->query($sql);
	$db->bind(":supplierID", $supplierID, PDO::PARAM_STR);
	$db->execute();
	$row=$db->resultset();
	
	$j = 0;
	//$events="";
	$timezone = null;
	$events = array();
	while($j<count($row)){
		$start = $row[$j]['StartDate'];
		list($month, $day, $year) = preg_split('[/]', $start);
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
