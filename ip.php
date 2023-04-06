<?php   
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

echo getHostByName(getHostName());
    echo "<br>";
    $people_json = file_get_contents('https://ipwhois.app/json/'.$user_ip);

    $decoded_json = json_decode($people_json, false);

    echo "<pre>";
    print_r($decoded_json);
    echo "</pre>";
    
    
    
?>

<iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $decoded_json->latitude; ?>,<?php echo $decoded_json->longitude; ?>&hl=en&z=14&amp;output=embed"></iframe>