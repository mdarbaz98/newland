<?php
$db_host="localhost"; 
// $db_user="root";	
// $db_password="";	
// $db_name="onegloabal-new";	
// $db_name="oneglobal2";
// $db_host="162.214.198.68"; 
// $db_user="globa7ox_oneglobalbrandnew";	
// $db_password="#[JZYJ,N?[mV";	
// $db_name="globa7ox_oneglobalbrandnew";

$db_user="globa7ox_globalProdAll";
$db_name="globa7ox_globalProdAll";
$db_password="CxqD-Cm8m.^K";
try
{
	$conn=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

$insertUser = $conn->prepare("INSERT INTO userdemo(name) VALUE(?)");
$insertUser->execute(['Mehtab']);

?>