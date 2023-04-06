<?php
function getDBDP() 
{
	$dbhost="162.214.198.68";
	$dbuser="onegloba_dg_user";
	$dbpass="D88lJbsa42Ds";
	$dbname="onegloba_drugstore_order";
	
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
