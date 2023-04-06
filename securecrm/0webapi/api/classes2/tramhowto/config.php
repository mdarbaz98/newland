<?php
function getTRAMHOWTO() 
{
	$dbhost="162.214.198.68";
	$dbuser="onegloba_trama";
	$dbpass="n8uQNnLU8Gxw";
	$dbname="onegloba_tramadol-howto";
	
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
