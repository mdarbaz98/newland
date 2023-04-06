<?php
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');
        
        header("Access-Control-Allow-Headers: X-Requested-With");
    include('database.php');
    foreach($_POST as $x=>$y){
        if(empty($y)){
            die($x);
        }
    }
    $phone = str_replace(' ','', ( str_replace('+','',$_POST['codepin']).''.str_replace('-','',$_POST['phone']) ));
    $insertData = $conn->prepare('INSERT INTO customerCases(web, type, page, name, email, phone, message) VALUES (?,?,?,?,?,?,?)');
    $insertData->execute([$_POST['web'], $_POST['type'], $_POST['page'], $_POST['username'], $_POST['email'], $phone, $_POST['message']]);

    $mailjetApiKey = 'a6e20f63603953cd9ca2349265d2304b';
    $mailjetApiSecret = '4a228283087d8e09a63a01a990576bc3';
    $messageData = [
            'Messages' => [
                    [
                            'From' => [
                                    'Email' => 'contact@painosoma.com',
                                    'Name' => 'Painosoma Contact'
                            ],
                            'To' => [
                                    [
                                            'Email' => ' '.$_POST['email'].' ',
                                            'Name' => ' '.$_POST['username'].' '
                                    ]
                            ],
                            'Subject' => 'Painosoma inquiry',
                            'TextPart' => '',
                            'HTMLPart' => 'We have recived your inquiry'
                    ]
            ]
    ];
    $jsonData = json_encode($messageData);
    $ch = curl_init('https://api.mailjet.com/v3.1/send');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
    ]);
    $response = json_decode(curl_exec($ch));
    
    //Send Text Message=============================
    $post_data = [
        'username'=>'Newlands Pharmacy', 
        'key'=>'Newlands Pharmacy@2022', 
        'method'=>'http', 
        'to'=>$phone, 
        'message'=>'Dear Customer, We have recived your inquiry from painosoma', 
        'senderid'=>'mycompany'];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/http/v2/send.php" );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $postResult = curl_exec($ch);
    if (curl_errno($ch)) {
        // print curl_error($ch);
    }
    curl_close($ch);

    //Send Whatsapp Message=============================
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance5491/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "token=mp15jsuyuzvpfrhz&to=".$phone."&body=Dear Customer, We have recived your inquiry from painosoma&priority=0&referenceId=",
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
      
    curl_close($curl);
    
    if ($err) {
      //   echo "cURL Error #:" . $err;
    } else {
      //   echo $response;
    }

if($_POST['web']=='SOMA') {
            $web = 'painosoma-popup';
    }elseif($_POST['web']=='PAS') {
            $web = 'practicalanxietysolutions-popup';
    }

    $collect[] = array( //customised inputs
        "Full Name" => $_POST['username'],
        "Enter your email Address" => $_POST['email'],
        "Contact Number" => $phone,
        "Enter Note" => $_POST['message'],
        "form_id" => uniqid(),
        "form_name" => $web
    );

$content = json_encode($collect);

$url = "https://hook.eu1.make.com/3y7skw7nnre84dnm4kdgpkmahbpmrmt5";    

$curl = curl_init($url);
// curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'content-Type: application/json',
        'Content-Length: ' . strlen($content))
);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ( $status != 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}

curl_close($curl);

$response = json_decode($json_response, true);

 echo "done";

?>
