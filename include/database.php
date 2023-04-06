<?php
error_reporting(0);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
if (strpos($actual_link, 'newlandpharmacy') OR strpos($actual_link, 'oneglobalpharma') OR strpos($actual_link, 'oneglobalpharma')) {
	$db_host="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com"; 
	$db_user="root";
	$db_name="global";
	$db_password="Iamawesome8425";
}elseif(strpos($actual_link, 'localhost')) {
	$db_host="localhost"; 
	$db_user="root";
	$db_name="global";
	$db_password="";
}else {
	$db_host="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com"; 
	$db_user="root";
	$db_name="global";
	$db_password="Iamawesome8425";
}
try
{
	$conn=new PDO("mysql:host={$db_host};dbname={$db_name};port=3306",$db_user,$db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

?>
