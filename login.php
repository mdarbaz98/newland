<?php
require_once "db_connection.php";

// if(isset($_SESSION['login_id'])){
//     header('Location: home.php');
//     exit;
// }

require 'google-api/vendor/autoload.php';

$client = new Google_Client();

$client->setClientId('85132697221-32lgsbms26m1at5039476kuesme75q7u.apps.googleusercontent.com');
$client->setClientSecret('_ylTHKwc2r3vLg93BtkdfopW');
$client->setRedirectUri('login.php');

$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $gender = $google_account_info->gender;
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

        $get_user = mysqli_query($db_connection, "SELECT `google_id` FROM `users` WHERE `google_id`='$id'");
        if(mysqli_num_rows($get_user) > 0){

            $_SESSION['login_id'] = $id; 
            header('Location: home.php');
            exit;

        }
        else{

            $insert = mysqli_query($db_connection, "INSERT INTO `users`(`google_id`,`name`,`email`,`profile_image`,`gender`) VALUES('$id','$full_name','$email','$profile_pic','$gender')");

            if($insert){
                $_SESSION['login_id'] = $id; 
                print_r($google_account_info);
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        header('Location: login.php');
        exit;
    }
    
else: 
    // Google Login Url = $client->createAuthUrl(); 
?>


<?php endif; ?>