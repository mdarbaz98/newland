<?php
function getDBTRAEX() 
{
	$dbhost="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
	$dbuser="root";
	$dbpass="Iamawesome8425";
	$dbname="onegloba_tra_order";
	
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