<?php
function getDBOC() 
{
	$dbhost="localhost";
	$dbuser="onegloba_oc_ord";
	$dbpass="KaFxcOdUaSb5";
	$dbname="onegloba_oc_order";
	
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