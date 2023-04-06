<?php
    session_start();
    require_once "include/database.php";
    $unicode = $_GET['unicode'];
    $getLogin=$conn->prepare("SELECT * FROM ogcustomer WHERE uniqueloginid=?");
    $getLogin->execute([$unicode]);
    $count = $getLogin->rowCount();
    if($count>0){
        while($row=$getLogin->fetch(PDO::FETCH_ASSOC)){
            $useremail = $row['email'];
            $name = $row['fname'];
            $newUserId = $row['userid'];
            $_SESSION['IS_LOGIN']=true;
            $_SESSION['NAME']=$name;
            $_SESSION['EMAIL']=$useremail;
            $_SESSION['USER_ID']=$newUserId;
            setcookie("userID",$newUserId,time()+31556926 ,'/');
            header('location: account');
        }
    }else {
        header('location: ');
    }
?>