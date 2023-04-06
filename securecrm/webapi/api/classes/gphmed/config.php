<?php
function getDBGPMZ() 
{
	$dbhost="localhost";
	$dbuser="onegloba_glomedz";
	$dbpass="Kumarakshay@195";
	$dbname="onegloba_globalmedz";
	
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