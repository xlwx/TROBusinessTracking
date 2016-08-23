<?php
require_once __DIR__ . '/vendor/autoload.php';

class googleCalendar{
	
	//required for google calendar api
	private $calendarId; 
	private $client_email = 'tro-calendar@tro-calendar.iam.gserviceaccount.com';;
	private $private_key = file_get_contents('TRO-Calendar-PrivateKey.p12');;
	private $scopes = array('https://www.googleapis.com/auth/calendar');;
	private $credentials;
	
	private $client;
	private $service;
	
	public function __construct($calendarId){
		$this->calendarId = $calendarId;
		$this->credentials = new Google_Auth_AssertionCredentials(
			$this->client_email,
			$this->scopes,
			$this->private_key
		);
		$this->client = new Google_Client();
		$this->client->setAssertionCredentials($credentials);
		if ($this->client->getAuth()->isAccessTokenExpired()) {
		  $this->client->getAuth()->refreshTokenWithAssertion();
		}

		$this->service = new Google_Service_Calendar($this->client);
	}
	
	public function insert($title,$details,$start,$end){
		$event = new Google_Service_Calendar_Event(array(
		  'summary' => $title,
		  'description' => $details,
		  'start' => array(
			'date' => $start
		  ),
		  'end' => array(
			'date' => $end
		  ),
		  
		));

		$event = $this->service->events->insert($this->calendarId, $event);
		return $event->getId();
	}
	
	public function delete($eventId){
		$this->service->events->delete($this->calendarId, $eventId);
	}
}



?>