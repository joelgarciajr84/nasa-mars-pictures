<?php
class  HelloMars
{

	function __construct()
	{

		$this->rovers = array(
			"curiosity" => 'Curiosity',
			"opportunity"=>'Opportunity',
			"spirit"=>'Spirit'
			);
			$this->date = date('Y-m-d');
			$this->apikey =  "qolE0aT3OI1tsmNFSvBJM72MPDZOYlF9IARTMDi6";
			$this->baseurl ="https://api.nasa.gov/mars-photos/api/v1/rovers/";

	}

	public function CheckConnection(){
	    $connected = @fsockopen("www.google.com", 80);
	    if (!$connected){
			$connStatus = false;

	    }else{
	        $connStatus = true;

		}
		return $connStatus;
	}

	public function getPictures($date,$rover){
		$this->date = $date;
		$this->rover = $rover;
		if (!empty($this->date) && !empty($this->rover)) {
			$this->data = file_get_contents($this->baseurl.$this->rover.'/photos?earth_date='.$this->date.'&api_key='.$this->apikey);
		}else{
			return "error";
		}

		return $this->data;

	}

}
