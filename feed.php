<?php
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>Mars Photos Feed</title>';
$rssfeed .= '<id>Unique Photo ID</id>';
$rssfeed .= '<link>https://marspictures.herokuapp.com</link>';
$rssfeed .= '<description>Mars PhotosRSS feed</description>';
$rssfeed .= '<language>en-us</language>';
$rssfeed .= '<copyright>Copyright (C) 2009 mywebsite.com</copyright>';


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
