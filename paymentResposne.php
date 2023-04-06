<?php
# PHP Example for Payment Request 
require_once "include/database.php";

$inv = $_GET['inv'];

$getOrder = $conn->prepare('SELECT * FROM orderdetails WHERE orderid=?');
$getOrder->execute([$inv]);
while($row=$getOrder->fetch(PDO::FETCH_ASSOC)){
    $productStatus = $row['productStatus'];
}

$productStatus = str_replace('Pending', 'Processed', $productStatus);



$updateOrder = $conn->prepare('UPDATE orderdetails SET paymentlink=?, productStatus=? WHERE orderid=?');
$updateOrder->execute(['Processed', $productStatus, $inv]);

?>