<?php
function getDBTRAOLCOD() 
{
	$dbhost="localhost";
	$dbuser="onegloba_trama";
	$dbpass="n8uQNnLU8Gxw";
	$dbname="onegloba_buytramaOC_order";
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	return $conn;
}
/* DATABASE CONFIGURATION END */

/* API key encryption 
function apiToken($session_uid)
{
$key=md5(SITE_KEY.$session_uid);
return hash('sha256', $key);
}*/



?>