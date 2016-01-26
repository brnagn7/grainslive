<?php
error_reporting(0);
include_once("db.php");

header("Content-type: text/xml; charset=utf-8"); 

$id = isset($_REQUEST['id'])?$_REQUEST['id']:"";


$mm = 0;

$qqqq = mysql_query("select * from `".$itable."` where pid = '".$id."' order by id ");

$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";

$xml .= "<list>\r\n";


while( $songs = mysql_fetch_assoc($qqqq) )
{
	
$mp3sid = $songs['id'];

$mp3pid = $songs['pid'];

$mp3p = $songs['image'];						
	
$mp3s = $songs['song'];

$mp3prev = $songs['preview'];  
 
$mp3t = $songs['title']; 

$mp3a = $songs['artist'];

$mp3d = $songs['download'];

$mp3b = $songs['buynow'];


  $xml .= "\r\n<item>\r\n";

    $xml .= "<title><![CDATA[".$mp3t."]]></title>\r\n";

	$xml .= "<artist><![CDATA[".$mp3a."]]></artist>\r\n";

	$xml .= "<song><![CDATA[".$mp3s."]]></song>\r\n";

    $xml .= "<image><![CDATA[".$mp3p."]]></image>\r\n";
	
	$xml .= "<download>".$mp3d."</download>\r\n";

  $xml .= "</item>\r\n\r\n";



$mm++; }


$xml .= "</list>\r\n";	

echo $xml;

?>