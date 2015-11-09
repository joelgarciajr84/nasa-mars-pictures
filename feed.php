<?php
header("Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title>NASA PHOTOS</title>
<link>https://marspictures.herokuapp.com/</link>
<description>Nasa Photos</description>
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
    $rssfeed .= '<id>' . $image[$i]->id. '</id>';
    $rssfeed .= '<sol>' . $image[$i]->sol. '</sol>';
    $rssfeed .= '<camera_name>' . $image[$i]->camera->name . '</camera_name>';
    $rssfeed .= '<img_src>' . $image[$i]->img_src . '</img_src>';
    $rssfeed .= '<earth_date>' . date("d/m/Y",strtotime($image[$i]->earth_date)) . '</earth_date>';
    $rssfeed .= '<rover_name>' . $image[$i]->rover->name. '</rover_name>';
    $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($image[$i]->earth_date)) . '</pubDate>';
    $rssfeed .= '</item>';
    }
    //$feedoutput = $xml->generateValidXmlFromArray($ImageToShow);
}
$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

   echo $rssfeed;
?>
