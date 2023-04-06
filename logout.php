<?php
include('include/database.php');  
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
session_start();
session_destroy();
$id = uniqid();
setcookie("userID",$id,time()+31556926 ,'/');
$insertUser=$conn->prepare("INSERT INTO ogcustomer(userid, cookieUser) VALUE('".$id."', 'yes')");
$insertUser->execute();
header("Location: ".$actual_link);
exit;
?>