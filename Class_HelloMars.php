<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class  HelloMars 
{
	function __construct(){
		$this->rovers = array(
			"curiosity" => 'Curiosity',
			"opportunity"=>'Opportunity',
			"spirit"=>'Spirit'
			);
		$this->date = date('Y-m-d');
		$this->apikey =  "HnEJExm3EhGjyVLh2OKoo5wDdLSbTNATfBgFHo9m";
		$this->baseurl ="https://api.nasa.gov/mars-photos/api/v1/rovers/";
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