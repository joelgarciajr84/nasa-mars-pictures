<?php
//header('Content-Type: application/xml');
header('Content-Type: application/rss+xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>';

require 'rover.php';
$Mars = new HelloMars();
$xml = new XMLSerializer();

$images = json_decode(

    $Mars->getPictures(
        '2015-10-04',
        'curiosity'
    )
);
$ImageToShow = array();
foreach ($images as $image) {
    for ($i=0; $i < count($image); $i++) {
        $ImageToShow[$i] = array(
        "id"            =>  $image[$i]->id,
        "sol"           =>  $image[$i]->sol,
        'camera_name'   =>  $image[$i]->camera->name,
        'img_src'       =>  $image[$i]->img_src,
        'earth_date'    =>  date("d/m/Y",strtotime($image[$i]->earth_date)),
        'rover_name'    =>  $image[$i]->rover->name
    );

    }
    $feedoutput = $xml->generateValidXmlFromArray($ImageToShow);
}
echo $feedoutput;
