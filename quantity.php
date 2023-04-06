<?php 
    require_once "include/database.php";
    $strength = $_POST['strength'];
    $productName = $_POST['productName'];
    $productImage = $_POST['productImage'];
    $userid = $_COOKIE["userID"];
    $type = substr($_POST['type'],0);
    $select_strength=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode = '$strength'");	
    $select_strength->execute();
    while($row=$select_strength->fetch(PDO::FETCH_ASSOC)){
        $strength_amount = $row['strengthName'] ;
    }
    $select_stmt=$conn->prepare("SELECT * FROM ogquantity WHERE strengthCode = '$strength'");	
    $select_stmt->execute();
    $quantityRowCount=$select_stmt->rowCount();
    if($quantityRowCount > 0) {
        while($row=$select_stmt->fetch(PDO::FETCH_ASSOC)){
            $qtyCode = $row['quantityCode'];
            $getStatus=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode = '$qtyCode' && userId = '$userid'");
            $getStatus->execute();
            
            $getStatus = $getStatus->fetch(PDO::FETCH_ASSOC);
            if($getStatus) {
                $status = 'activeQty';
            }
            else {
                $status='dd';
            }
            $total_p = $row['quantity'] * $row['price'];
            if(($row['quantity'] * $row['price']) > 400) {
                $class = "";
            }
            else {
                $class = "";
            }
            $output1 = "
                <label class='switch'>
                    <input type='radio' class='{$status} listQuantity' id='quantity' data-product-name='{$productName}' data-product-image='{$productImage}' data-product-type='{$type}' data-strength-id='{$strength}' data-strength='{$strength_amount}' data-quantity-id='{$row['quantityCode']}' data-quantity='{$row['quantity']}' data-price='{$row['price']}' data-product-code='{$row['productCode']}' name='quantity' onChange='quantity(this)' value='{$row['quantity']}'>
                    <span class='sliders {$class}'>
                        <span class='qty'>{$row['quantity']} <small>{$type}</small></span>
                        <span class='price'>$".$row['price']."/{$type}<span class='total_p'>$ {$total_p}</span></span> 
                ";   
                $option = "<span class='fship'>FREE SHIPPING</span><i class='fa-solid fa-truck f-ship sliderss'></i>";
                $output2 = "     
                    </span>
                </label>
            ";

            if(($row['quantity'] * $row['price']) > 250) {
                $output = $output1.$option.$output2;
            }
            else {
                $output = $output1.$output2;
            }
            echo $output;
        }
    }else {
        echo "Quantity Not Found For This Strength";
    }

?>