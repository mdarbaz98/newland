<?php
//ob_start("ob_gzhandler");
error_reporting(0);
// session_start();

/* DATABASE CONFIGURATION */
define('DB_SERVER', 'newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Iamawesome8425');
define('DB_DATABASE', 'onegloba_drugsunit');
// define('DB_PASSWORD', 'Sandeep@123');
// define('DB_DATABASE', 'onegloba_demo2');


function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	return $conn;
}
/* DATABASE CONFIGURATION END */

/* API key encryption */
function apiToken($session_uid)
{
$key=md5(SITE_KEY.$session_uid);
return hash('sha256', $key);
}



?>