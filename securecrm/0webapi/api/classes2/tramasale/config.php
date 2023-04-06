<?php
function getDBTRASALE() 
{
	$dbhost="162.214.198.68";
	$dbuser="onegloba_ts_user";
	$dbpass="Ew8VXkGrllBx";
	$dbname="onegloba_tra_sale_order";
	
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
