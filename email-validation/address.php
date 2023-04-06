<?php
    function encodeValue($s) {
        return htmlentities($s, ENT_COMPAT|ENT_QUOTES,'ISO-8859-1', true); 
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://us-autocomplete-pro.api.smartystreets.com/lookup?auth-id=0e80ed32-9fa9-b0d8-f6b1-aa97cd3891b1&auth-token=rndRljNmyw2UzO45Uf38&search=".encodeValue($_POST['address'])."&selected=&license=us-autocomplete-pro-cloud",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $addressArray = array();
    $resData = json_decode($response,true);
    foreach($resData['suggestions'] as $x){
        $address = $x['street_line']." ".$x['city'].", ".$x['state']." ".$x['zipcode'];
        array_push($addressArray,$address);
        // echo $x['suggestions'].$x['street_line'].$x['city'].", ".$x['state'].$x['zipcode'];
    }
    $jsonData = json_encode($addressArray, JSON_PRETTY_PRINT);
    echo $jsonData;
    //https://www.encodedna.com/javascript/practice-ground/default.htm?pg=bind_select_element_with_json_array_in_javascript