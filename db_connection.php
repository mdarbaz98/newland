<?php
session_start();
session_regenerate_id(true);
// change the information according to your database
$db_connection = mysqli_connect("162.214.198.68","onegloba_oneglobalbrandnew","#[JZYJ,N?[mV","onegloba_oneglobalbrandnew");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}