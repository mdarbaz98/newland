<?php
//ob_start("ob_gzhandler");
error_reporting(0);
// session_start();

/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'onegloba_duser');
define('DB_PASSWORD', '5EmCvIJGhfLE');
define('DB_DATABASE', 'onegloba_drugsunit');
define("BASE_URL", "https://globalpharmameds.com/0webapi/api/");
define("SITE_KEY", 'yourSecretKey');


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