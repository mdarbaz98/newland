<?php
function getDBGPMZ() 
{
	$dbhost="162.214.198.68";
	$dbuser="onegloba_glomedz";
	$dbpass="Kumarakshay@195";
	$dbname="onegloba_globalmedz";
    // $dbname="onegloba_demo2";
    // $dbpass="Sandeep@123";
	
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
