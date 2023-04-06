<?php
$db_host="newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
// $db_user="root";
// $db_password="";
// $db_name="onegloabal-new";
// $db_name="oneglobal2";
// $db_host="162.214.198.68";
// $db_user="globa7ox_oneglobalbrandnew";
// $db_password="#[JZYJ,N?[mV";
// $db_name="globa7ox_oneglobalbrandnew";

$db_user="root";
$db_name="global";
$db_password="Iamawesome8425";
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
