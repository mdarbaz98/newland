<?php
    $uploadImage = $_FILES['demo']['name'];
    $uploadImageTmp = $_FILES['demo']['tmp_name'];
    $uploadImageSize = $_FILES['demo']['size'];
    $totalUploadImage =  count($_FILES['demo']['name']);
    $ext = array("jpg", "png", "webp", "JPEG", "jpeg", "JPG", "PNG", "WEBP");
    $status = "";
    for($i=0; $i<$totalUploadImage; $i++) {
        
        $uploadImageExt = pathinfo($_FILES['demo']['name'][$i], PATHINFO_EXTENSION);
        if(in_array($uploadImageExt, $ext)){
            if(move_uploaded_file($_FILES['demo']['tmp_name'][$i], 'onglobaladmincrm/assets/images/products/'.$_FILES['demo']['name'][$i])){
                $status = "Upload";
            }else {
                $status = "NotUpload";
            }
        }else {
            echo "Please Add Valid Image";
        }
    }
    if($status=="Upload"){
        echo "Done";
    }else if($status=="NotUpload") {
        echo "Error";
    }else {
        echo "";
    }
    
    // move_uploaded_file($uploadImageTmp, $uploadImage);
    // echo $totalUploadImage;
?>