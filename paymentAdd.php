<?php
# PHP Example for Payment Request 
include('env.php');
require_once "include/database.php";
$inv = $_POST['invoice'];

$getOrder = $conn->prepare('SELECT * FROM orderdetails WHERE orderid=?');
$getOrder->execute([$inv]);
while($row=$getOrder->fetch(PDO::FETCH_ASSOC)){
    $total = $row['total'];
    $dcharge = $row['dcharge'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
}

$json_string = json_encode(array(
    "api_mode" => "live",
    "order" => array(
        "amount"=>base64_encode(($total)),
        "currency"=>base64_encode("USD"), //3 digit currency code
        "note"=>base64_encode("Toys"),
        "merchant_reference_no"=>base64_encode($inv)
    ),
    "customer" => array(
        "first_name"=>base64_encode($fname),
        "middle_name"=>base64_encode(" "),
        "last_name"=>base64_encode($lname),
        "email"=>base64_encode($email),
        "phone"=>base64_encode($phone),
        "gender"=>base64_encode("male"), // male | female 
        "lang"=>base64_encode(""),
        "ip_address"=>base64_encode("")
    ),
    "customer_address" => array(
        "country" => base64_encode("USA") //3 digit country code
    ),
    "callback_url" => base64_encode("http://".$INFO_WEBSITE_NAME ."/paymentResposne.php?inv=".$inv),
    "notification_url" => base64_encode("")
));


$StringToSign = md5($json_string);

$signature = hash_hmac('sha256', $StringToSign, 'u0e1en07qraq3n4x3dt1gl0iw1663866911zi7397lkvzkhthvhj0p4luveh30691');


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.howtopay.com/api/v2/create/payment_request',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $json_string,
  CURLOPT_HTTPHEADER => array(
    'cache-control: no-cache',
    'Content-Type: application/json',
    'htp-authorization: HTPAPIv2Auth qht40-16638-02669oe-30691:'.$signature,
    'htp-apiversion: HTPAPIv2',
    'htp-timestamp: '.time(),
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo "<pre>";
// print_r();
$paymentLink = json_decode($response, true)['data']['payment_link'];

$updateOrder = $conn->prepare('UPDATE orderdetails SET paymentlink=? WHERE orderid=?');
$updateOrder->execute([$paymentLink, $inv]);

echo str_replace('https://id.howtopay.com/', '', $paymentLink);