<?php
function getDBSTRIPEPAY() 
{
	$dbhost="162.214.198.68";
	$dbuser="onegloba_user87";
	$dbpass="HP+_rm%l#gs%";
	$dbname="onegloba_paygatway";
	
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
