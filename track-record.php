<?php
    
    function get_data_from_api($code) {

        
        $auth_array = array(
                "Authorization:",
                "Bearer"
        );
        
        $new_token = implode(" ", $auth_array);
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://shipit-api.herokuapp.com/api/carriers/usps/".$code,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => array(
            $new_token,
            "Content-Type: application/json",
            "cache-control: no-cache"
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        $data = json_decode($response, true);
        
        echo "<div class='statusList'>";
        // do something with the data
        $i = count($data['activities']);
        foreach($data['activities'] as $dataSep){
            
            echo "
                <div class='statusItem'>
                    <p>".$i."</p>
                    <div class='statusSubItem'>
                        <p>".date('l, F jS, Y', strtotime($dataSep['timestamp']))."</p>
                        <p>".$dataSep['details']."</p>
                    </div>
                </div>
            ";
            $i--;
        }
        echo "</div>";
        // print_r($data['activities'][0]['details']);
        
    }
    
    get_data_from_api('EM776103477IN');
    
    
?>