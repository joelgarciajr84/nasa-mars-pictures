<?php
header("Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'
    xmlns:w='http://tempuri.org'
	xmlns:wfw='http://wellformedweb.org/CommentAPI/'
	xmlns:dc='http://purl.org/dc/elements/1.1/'
	xmlns:atom='http://www.w3.org/2005/Atom'
	xmlns:sy='http://purl.org/rss/1.0/modules/syndication/'
	xmlns:slash='http://purl.org/rss/1.0/modules/slash/'>
<channel>
<title>NASA PHOTOS</title>
<link>https://marspictures.herokuapp.com/</link>
<description>Nasa Photos</description>
<atom:link href='https://marspictures.herokuapp.com/feed.php' rel='self' type='application/rss+xml' />
<language>en-us</language>";
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
$rssfeed = '';
foreach ($images as $image) {
    for ($i=0; $i < count($image); $i++) {
        /*$ImageToShow[$i] = array(
        "id"            =>  $image[$i]->id,
        "sol"           =>  $image[$i]->sol,
        'camera_name'   =>  $image[$i]->camera->name,
        'img_src'       =>  $image[$i]->img_src,
        'earth_date'    =>  date("d/m/Y",strtotime($image[$i]->earth_date)),
        'rover_name'    =>  $image[$i]->rover->name
    );*/
    $rssfeed .= '<item>';
    $rssfeed .= '<title>' . $image[$i]->id. '</title>';
    $rssfeed .= '<guid>' . $image[$i]->img_src. '</guid>';
    $rssfeed .= '<w:id>' . $image[$i]->id. '</w:id>';
    $rssfeed .= '<w:sol>' . $image[$i]->sol. '</w:sol>';
    $rssfeed .= '<w:camera_name>' . $image[$i]->camera->name . '</w:camera_name>';
    $rssfeed .= '<w:img_src>' . $image[$i]->img_src . '</w:img_src>';
    $rssfeed .= '<w:earth_date>' . date("d/m/Y",strtotime($image[$i]->earth_date)) . '</w:earth_date>';
    $rssfeed .= '<w:rover_name>' . $image[$i]->rover->name. '</w:rover_name>';
    $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($image[$i]->earth_date)) . '</pubDate>';
    $rssfeed .= '</item>';
    }
    //$feedoutput = $xml->generateValidXmlFromArray($ImageToShow);
}
$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

   echo $rssfeed;
?>
