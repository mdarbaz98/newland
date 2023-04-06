<?php

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.debounce.io/v1/?email=".$email."&api=62d4fb4f84663",
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

        $resData = json_decode($response,true);
        echo $resData['debounce']['reason'];
    }

    if(isset($_POST['phone'])) {
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.numlookupapi.com/v1/validate/".$code.$phone."?apikey=6C3qvPzuU9wYd5GllqDWIOnY8Xbm4u9rRaaj8zzI",
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

        $resData = json_decode($response,true);
        
        echo $resData['valid'];
    }

    if(isset($_POST['zipcode'])){
        function getZipInfo($zip){
            if(isset(getAddress($zip, 'us')['results'][$zip][0]['city_en'])){
                echo json_encode(array(
                    "city" => getAddress($zip, 'us')['results'][$zip][0]['city_en'],
                    "state" => getAddress($zip, 'us')['results'][$zip][0]['state_en'],
                    "country" => getAddress($zip, 'us')['results'][$zip][0]['country_code']
    
                ));
    
            }elseif(isset(getAddress($zip, 'uk')['results'][$zip][0]['city_en'])){
    
                echo json_encode(array(
                    "city" => getAddress($zip, 'us')['results'][$zip][0]['city_en'],
                    "state" => getAddress($zip, 'us')['results'][$zip][0]['state_en'],
                    "country" => getAddress($zip, 'us')['results'][$zip][0]['country_code']
    
                ));
    
            }elseif(isset(getAddress($zip, 'in')['results'][$zip][0]['city_en'])){
    
                echo json_encode(array(
                    
                    "city" => getAddress($zip, 'in')['results'][$zip][0]['city_en'],
                    "state" => getAddress($zip, 'in')['results'][$zip][0]['state_en'],
                    "country" => getAddress($zip, 'in')['results'][$zip][0]['country_code']
    
                ));
    
            }else {
    
                echo "error";
    
            }
    
        }
        function getAddress($zip, $country) {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.zipcodebase.com/api/v1/search?apikey=b41ebb80-02a8-11ed-8712-573f961d1a74&codes=$zip&country=$country",
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
    
            $resData = json_decode($response,true);
    
            return $resData;
            // print_r($resData['results'][$zip][0]['city_en']);
        }
        
        getZipInfo($_POST['zipcode']);
    }